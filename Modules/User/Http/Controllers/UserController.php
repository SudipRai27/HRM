<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\User\Entities\User;
use Auth;
use DB;
use File;
use Modules\User\Entities\UserRoles;
use Modules\User\Entities\Roles;
use Modules\Department\Entities\Department;
use Modules\User\Entities\UserDetails;
use Modules\Job\Entities\Job;
use Excel;
use Hash;
use App\Http\Controllers\HelperController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    protected function guard()
    {
        return auth()->guard('user');
    }

    public function getRegister()
    {   
        $roles = Roles::pluck('role_name', 'id');
        $department_list = Department::pluck('department_name', 'id');
        return view('user::register')->with('roles', $roles)
                                     ->with('department_list', $department_list);
    }

    public function postRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',            
            'address' => 'required', 
            'contact' => 'required', 
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'role_id' => 'required', 
            'department_id' => 'required', 
            'job_id' => 'required', 
            'joining_date' => 'required|date_format:"m/d/Y', 
            'resume'   => 'mimes:doc,pdf,docx,zip'
        ]);

        DB::beginTransaction();

        try {        

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt('password');
            $user->address = $request->address;
            $user->contact = $request->contact;
            $user->gender = $request->gender;
            $user->api_token = str_random(60);


            if($request->hasFile('photo')) 
            {
                $name = uniqid() . $request->photo->getClientOriginalName();
                $ext = $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path().'/images/user_photos',$name,$ext);
                $user->photo = $name;
            }

            $user->save();

            $user_roles = new UserRoles;
            $user_roles->user_id = $user->id;
            $user_roles->role_id = $request->role_id;
            $user_roles->save();

            $controller = new HelperController;
            $formatted_date = $controller->changeDateFormatfromSlashToHyphen($request->joining_date);
            

            $user_details = new UserDetails;
            $user_details->user_id = $user->id;
            $user_details->department_id = $request->department_id;
            $user_details->job_id = $request->job_id;
            $user_details->joining_date = $formatted_date;

            if($request->hasFile('resume')) 
            {
                $name = uniqid() . $request->resume->getClientOriginalName();
                $ext = $request->resume->getClientOriginalExtension();
                $request->resume->move(public_path().'/user_resumes',$name,$ext);
                $user_details->resume = $name;
            }

            $user_details->save();

            DB::commit();
            Session::flash('success-msg', 'Created Successfully');
            return redirect()->back();                              
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('error-msg',$e->getMessage());
        }        

    }

    public function getListUser()
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id','gender','users.created_at')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(6);

        return view('user::list')->with('user', $user);
    }

    public function getUserView($id)
    {   
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id','gender')
                    ->where('user_roles.user_id', $id)
                    ->where('users.id', $id)
                    ->first();

        $user_details = DB::table('user_details')
                        ->join('users', 'users.id', '=', 'user_details.user_id')
                        ->join('department', 'department.id', '=', 'user_details.department_id')
                        ->join('job', 'job.id', '=', 'user_details.job_id')
                        ->select('job_title', 'department_name', 'joining_date', 'resume', 'user_id')
                        ->where('user_details.user_id', $id)
                        ->first();

        return view('user::view-user')->with('user', $user)
                                      ->with('user_details', $user_details);
    }

    public function getEditUser($id)
    {
        $user = User::findorFail($id);
        $roles = Roles::select('role_name', 'id')->get();

        $current_user_role_id = UserRoles::where('user_id', $user->id)
                                          ->pluck('role_id')[0];

        $department_list = Department::pluck('department_name', 'id');

        $current_user_department_id = UserDetails::where('user_id', $user->id)
                                          ->pluck('department_id')[0];

        $job_list = Job::where('department_id', $current_user_department_id)
                        ->select('job_title', 'id')
                        ->get();

        $current_user_job_id = UserDetails::where('user_id', $user->id)
                                    ->where('department_id', $current_user_department_id)
                                    ->pluck('job_id')[0];

        $joining_date = UserDetails::where('user_id', $user->id)
                                    ->pluck('joining_date')[0];
        
        $controller = new HelperController;
        $joining_date = $controller->changeDateFormatfromHyphenToSlash($joining_date);                                   
                                                

        return view('user::edit')->with('user', $user)
                                 ->with('roles', $roles)
                                 ->with('current_user_role_id', $current_user_role_id)
                                 ->with('department_list', $department_list)
                                 ->with('current_user_department_id', $current_user_department_id)
                                 ->with('job_list', $job_list)
                                 ->with('current_user_job_id', $current_user_job_id)
                                 ->with('joining_date', $joining_date);
    }

    public function postEditUser(Request $request, $id)
    {           
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,            
            'address' => 'required', 
            'contact' => 'required', 
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'role_id' => 'required', 
            'department_id' => 'required', 
            'job_id' => 'required', 
            'joining_date' => 'required|date_format:"m/d/Y', 
            'resume'   => 'mimes:doc,pdf,docx,zip'
        ]);

        DB::beginTransaction();

        try {        

            $user = User::findorFail($id); 
            $user->name = $request->name;
            $user->email = $request->email;            
            $user->address = $request->address;
            $user->contact = $request->contact;
            $user->gender = $request->gender;          

            if($request->hasFile('photo')) 
            {
                $image_path = public_path().'/images/user_photos/'.$user->photo;
                if(File::exists($image_path))
                {
                    File::delete($image_path);
                }

                $name = uniqid() . $request->photo->getClientOriginalName();
                $ext = $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path().'/images/user_photos',$name,$ext);
                $user->photo = $name;
            }

            $user->save();

            $user_roles = UserRoles::where('user_id', $id)->first();
            $user_roles->role_id = $request->role_id;
            $user_roles->save();

            $controller = new HelperController;
            $formatted_date = $controller->changeDateFormatfromSlashToHyphen($request->joining_date);

            $user_details =  UserDetails::where('user_id', $id)->first();
            $user_details->user_id = $user->id;
            $user_details->department_id = $request->department_id;
            $user_details->job_id = $request->job_id;
            $user_details->joining_date = $formatted_date;

            if($request->hasFile('resume')) 
            {
                $resume_path = public_path().'/user_resumes/'.$user_details->resume;
                if(File::exists($resume_path))
                {
                    File::delete($resume_path);
                }

                $name = uniqid() . $request->resume->getClientOriginalName();
                $ext = $request->resume->getClientOriginalExtension();
                $request->resume->move(public_path().'/user_resumes',$name,$ext);
                $user_details->resume = $name;
            }

            $user_details->save();

            DB::commit();
            Session::flash('success-msg', 'Updated Successfully');
            return redirect()->back();                              
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('error-msg',$e->getMessage());
        }        
    }

    public function getUserDelete($id)
    {
        $user_roles = UserRoles::where('user_id',$id)->delete();

        $user = User::findorFail($id); 
        $image_path = public_path().'/images/user_photos/'.$user->photo;

        if(File::exists($image_path))
        {
            File::delete($image_path);
        }

        $user_details =  UserDetails::where('user_id', $id)->first();
        $resume_path = public_path().'/user_resumes/'.$user_details->resume;

        if(File::exists($resume_path))
        {
            File::delete($resume_path);
        }


        $user->delete();

        Session::flash('success-msg', 'User Deleted Successfully'); 
        return redirect()->back();  
    }

    public function getDownloadCV($id)
    {
        $user_details = UserDetails::where('user_id', $id)->select('resume')->first();
        $resume_path = public_path().'/user_resumes/'.$user_details->resume;
        /*return response()->download($resume_path);*/
        return response()->file($resume_path);
    }

    public function getUserLogin()
    {
        return view('user::login');
    }

    public function postUserLogin(Request $request)
    {
        $auth = auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);

        if($auth) 
        {
            return redirect()->route('user-home')->with('success-msg', 'Successfully Logged in');
        }
        else 
        {
            Session::flash('error-msg','Incorrect Credentials');
            return redirect()->back();
        }

    }

    public function getViewProfile($id)
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id', 'password', 'users.created_at')
                    ->where('users.id', $id)
                    ->first();

        return view('user::profile')->with('user', $user);
    }

    public function getUserHome()
    {
        return view('user::dashboard');
    }

    public function getLogout()
    {
        auth()->guard('user')->logout();
        return redirect()->route('user-login')->with('success-msg', 'Logged Out Successfully');
    }

    public function getUserExcel()
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name')
                    ->get();

        if(!$user)
        {
            Session::flash('error-msg', 'No Users Available');
            return redirect()->back();
        }

        Excel::create('User Details', function($excel) use ($user) {
            $excel->sheet('User sheet', function($sheet) use ($user)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Name');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Email');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Address');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('contact');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('User Role');   });
                
                if (!empty($user)) {
                    foreach ($user as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->name); 
                        $sheet->cell('B'.$i, $value->email); 
                        $sheet->cell('C'.$i, $value->address); 
                        $sheet->cell('D'.$i, $value->contact); 
                        $sheet->cell('E'.$i, $value->role_name); 
                        
                    }
                }
            });
        })->download();
    }

    public function postChangePassword(Request $request)
    {   
        $input = request()->all();
        $user_password = User::where('id', $input['current_user_id'])->pluck('password')[0]; 
        if(Hash::check($input['current_password'], $user_password) )
        {
               $user = User::where('id', $input['current_user_id'])->first();
               $user->password = bcrypt($input['new_password']); 
               $user->save();
               Session::flash('success-msg', 'Password Successfully Updated'); 
               return redirect()->back();
        }
        else
        {
            Session::flash('error-msg', 'Your current password do not match');
            return redirect()->back();
        }
        

    }
}
