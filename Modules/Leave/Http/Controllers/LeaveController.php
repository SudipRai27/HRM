<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\AttendanceHelperController;
use Modules\Leave\Entities\Leave;
use Modules\Leave\Entities\LeaveLogs;
use Modules\Attendance\Entities\Attendance;
use Session;
use DB;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function getListLeaveRequest(Request $request)
    {
        $controller = new HelperController;
        $user_type = $controller->checkUserType();

        //GETTING RECORDS FOR SINGLE USER WHO IS LOGGED IN AND FOR USER CHOOSEN BY SUPERADMIN
        if($request->has('status'))
        {

            
            if($request->status == 'all')
            {
                $leave_request = DB::table('leave')
                            ->join('users', 'users.id','=','leave.user_id')
                            ->select('users.name', 'leave.*');

                if($user_type == 'user')
                {
                    $leave_request = $leave_request->where('users.id', auth()->guard('user')->id());    
                            
                }
                
                $leave_request = $leave_request->get();
                            
            }
            else
            {

                $leave_request = DB::table('leave')
                            ->join('users', 'users.id','=','leave.user_id')
                            ->select('users.name', 'leave.*')
                            ->where('leave.status', $request->status);

                if($user_type == 'user')
                {
                    $leave_request = $leave_request->where('users.id', auth()->guard('user')->id());
                }

                $leave_request = $leave_request->get();
            }
                    
        }       
        else
        {
            $leave_request = DB::table('leave')
                            ->join('users', 'users.id','=','leave.user_id')
                            ->select('users.name', 'leave.*');

            if($user_type == 'user')
            {
                $leave_request = $leave_request->where('users.id', auth()->guard('user')->id());
            }            
            
            $leave_request = $leave_request->get();                    
        }
                            
        
        return view('leave::list')->with('leave_request', $leave_request)
                                  ->with('status', $request->status);
    }
    
    public function getCreateLeaveRequest()
    {
        $user = User::pluck('name','id');
        return view('leave::create')->with('user', $user);
    }

    public function postCreateLeaveRequestPost(Request $request)
    {
        
        $controller = new HelperController;
        $user_type = $controller->checkUserType();  

        if($user_type == 'superadmin')
        {
            $request->validate([
            'user_id' => 'required', 
            'start_date' => 'required', 
            'end_date' => 'required', 
            'description' => 'required'
            ]);
                                   
        }

        if($user_type == 'user')
        {
            $request->validate([                
            'start_date' => 'required', 
            'end_date' => 'required', 
            'description' => 'required'
            ]);
        }    

        $input = request()->all();          
        $data_to_store_in_leave_table = [];    
        
        //check leave date is in the past or not
        $check_start_date = $controller->checkStartDate($controller->changeDateFormatfromSlashToHyphen($input['start_date']));
        if($check_start_date == 'true')
        {
            Session::flash('error-msg', 'Leave Start Date cannot be in the past... Please try again');
            return redirect()->back()->withInput();
        }    

        try {

            if($user_type == 'superadmin')
            {                                         
                $data_to_store_in_leave_table['user_id'] = $input['user_id'];
                $data_to_store_in_leave_table['start_date'] = $controller->changeDateFormatfromSlashToHyphen($input['start_date']);
                $data_to_store_in_leave_table['end_date'] = $controller->changeDateFormatfromSlashToHyphen($input['end_date']);
                $data_to_store_in_leave_table['description'] = $input['description'];                            
            }

            if($user_type == 'user')
            {                
                $data_to_store_in_leave_table['user_id'] = $controller->getCurrentUserId();
                $data_to_store_in_leave_table['start_date'] = $controller->changeDateFormatfromSlashToHyphen($input['start_date']);
                $data_to_store_in_leave_table['end_date'] = $controller->changeDateFormatfromSlashToHyphen($input['end_date']);
                $data_to_store_in_leave_table['description'] = $input['description'];                                                            
            }

            $attendance_helper_controller = new AttendanceHelperController;

            //check if the leave is created or not for the given dates
            $check_leave_record = $attendance_helper_controller->checkLeaveRecord($controller->changeDateFormatfromSlashToHyphen($input['start_date']), $controller->changeDateFormatfromSlashToHyphen($input['end_date']), $data_to_store_in_leave_table['user_id']);
            
            if($check_leave_record > 0)
            {
                Session::flash('error-msg', 'Leave has already been created for at least one of these selected days. Please try again...');
                return redirect()->back()->withInput();
            }

            //check if attendance is done in the leave selected dates
            $check_attendance_on_leave_create_date_range = $attendance_helper_controller->checkAttendanceonLeaveCreatedDateRange($controller->changeDateFormatfromSlashToHyphen($input['start_date']), $controller->changeDateFormatfromSlashToHyphen($input['end_date']), $data_to_store_in_leave_table['user_id']);

            if(count($check_attendance_on_leave_create_date_range))
            {
                Session::flash('error-msg', 'Leave cannot be created because attendance has been done on at least one of the selected date range, Please try again....');
                return redirect()->back()->withInput();
            }

            Leave::create($data_to_store_in_leave_table);
            Session::flash('success-msg', 'Leave Request Created Successfully. Please Wait For Approval');
            return redirect()->back();
            
        } catch (Exception $e) {
            
            return redirect()->back()->with('error-msg', $e->getMessage());
        }           
    }

    public function getApproveLeaveRequest($id)
    {           
        $leave_request = Leave::findorfail($id);
        if($leave_request->status != 'ongoing')
        {
            Session::flash('error-msg', 'This leave request has already been '.$leave_request->status);
            return redirect()->back();
        }
        
        $controller = new AttendanceHelperController;
        $date_range = $controller->generateDateRange($leave_request->start_date, $leave_request->end_date);

        //check attendance on the leave approved day
        $check_leave = $controller->checkAttendanceOnLeaveApprovedDay($date_range, $leave_request->user_id);

        if($check_leave > 0)
        {
            Session::flash('error-msg', 'Attendance has already been done on the leave requested date so leave cannot be approved. Please reject the request or edit it');
            return redirect()->back();
        }
        

        $this->createLeaveAttendance($date_range, $leave_request->user_id);

        $leave_request->status = 'approved';
        $leave_request->status_updated_date_time = date('Y-m-d h:i A');
        $leave_request->save();
        Session::flash('success-msg', 'Leave Request Approved and Attendance Updated');
        return redirect()->back();

    }

    public function createLeaveAttendance($date_range, $user_id)
    {
        foreach ($date_range as $key => $value) {
            Attendance::create([
                'user_id' => $user_id,
                'attendance_date' => $value, 
                'attendance_time' => '',
                'attendance' => 'leave'
                ]);
        }

        return;
    }

    public function getRejectLeaveRequest($id)
    {
        $leave_request = Leave::findorfail($id);
        if($leave_request->status != 'ongoing')
        {
            Session::flash('error-msg', 'This leave request has already been '.$leave_request->status);
            return redirect()->back();
        }

        $leave_request->status = 'rejected';
        $leave_request->status_updated_date_time = date('Y-m-d h:i A');
        $leave_request->save();
        Session::flash('success-msg', 'Leave Request Rejected');
        return redirect()->back();
    }

    public function getEditLeaveRequest($id)
    {
        $leave_request = Leave::findorfail($id);
        if($leave_request->status != 'ongoing')
        {
            //if approved or rejected the leave request cannot be updated
            Session::flash('error-msg', 'Your leave request has already been '.$leave_request->status .'. So You cannot update!');
            return redirect()->back();
        }

        $user = User::pluck('name','id');
        return view('leave::edit')->with('leave_request', $leave_request)->with('user', $user);
    }

    public function postEditLeaveRequest(Request $request, $id)
    {
        $controller = new HelperController;
        $user_type = $controller->checkUserType(); 

        if($user_type == 'superadmin')
        {
            $request->validate([
            'user_id' => 'required', 
            'start_date' => 'required', 
            'end_date' => 'required', 
            'description' => 'required'
            ]);                                
        }

        if($user_type == 'user')
        {
            $request->validate([                
            'start_date' => 'required', 
            'end_date' => 'required', 
            'description' => 'required'
            ]); 
        }

        $input = request()->all();          
        $data_to_update_in_leave_table = Leave::findorfail($id);            
        //check leave date is in the past or not
        $check_start_date = $controller->checkStartDate($controller->changeDateFormatfromSlashToHyphen($input['start_date']));
        if($check_start_date == 'true')
        {
            Session::flash('error-msg', 'Leave Start Date cannot be in the past. Please try again...');
            return redirect()->back()->withInput();
        }

        try {

            if($user_type == 'superadmin')
            {                                        
                $data_to_update_in_leave_table->user_id = $input['user_id'];
                $data_to_update_in_leave_table->start_date = $controller->changeDateFormatfromSlashToHyphen($input['start_date']);
                $data_to_update_in_leave_table->end_date = $controller->changeDateFormatfromSlashToHyphen($input['end_date']);
                $data_to_update_in_leave_table->description = $input['description'];                            
            }

            if($user_type == 'user')
            {                
                $data_to_update_in_leave_table->user_id = $controller->getCurrentUserId();
                $data_to_update_in_leave_table->start_date = $controller->changeDateFormatfromSlashToHyphen($input['start_date']);
                $data_to_update_in_leave_table->end_date = $controller->changeDateFormatfromSlashToHyphen($input['end_date']);
                $data_to_update_in_leave_table->description = $input['description'];
                                                            
            }

            $attendance_helper_controller = new AttendanceHelperController;

            //check if the leave is created or not for the given dates
            $check_leave_record = $attendance_helper_controller->checkLeaveRecord($controller->changeDateFormatfromSlashToHyphen($input['start_date']), $controller->changeDateFormatfromSlashToHyphen($input['end_date']), $data_to_update_in_leave_table['user_id']);

            if($check_leave_record > 0)
            {
                Session::flash('error-msg', 'Leave has already been created for at least one of these selected days. Please try again...');
                return redirect()->back()->withInput();
            }

            $check_attendance_on_leave_create_date_range = $attendance_helper_controller->checkAttendanceonLeaveCreatedDateRange($controller->changeDateFormatfromSlashToHyphen($input['start_date']), $controller->changeDateFormatfromSlashToHyphen($input['end_date']), $data_to_update_in_leave_table['user_id']);

            //check if attendance is done in the leave selected dates
            if(count($check_attendance_on_leave_create_date_range))
            {
                Session::flash('error-msg', 'Leave cannot be created because attendance has been done on at least one of the selected date range, Please try again....');
                return redirect()->back()->withInput();
            }

            $data_to_update_in_leave_table->save();
            Session::flash('success-msg', 'Leave Request Updated Successfully. Please Wait For Approval');
            return redirect()->back();
            
        } catch (Exception $e) {
            
            return redirect()->back()->with('error-msg', $e->getMessage());
        }           
    }

    public function getViewLeaveRequest($id)
    {
        $leave_request = Leave::where('id', $id)->first();
        return view('leave::view')->with('leave_request', $leave_request);
    }

    public function getLeaveRequestHistory()
    {
        $user = User::select('name','id')->get();        
        return view('leave::leave-history')->with('user', $user);
    }

    public function getDeleteLeaveRequest($id)
    {
        DB::beginTransaction();
        try {

            $leave_request = Leave::findorfail($id);
            if($leave_request->status == 'ongoing')
            {
                Session::flash('error-msg', 'Please Approve Or Reject the leave request before deleting..');
                return redirect()->back();
            }
            $controller = new HelperController;
            $user_name = $controller->getUserNameFromUserId($leave_request->user_id);

            LeaveLogs::create([
                'user_id' => $leave_request->user_id, 
                'date_range' => $leave_request->start_date.' - '.$leave_request->end_date,
                'status' => $leave_request->status,
                'description' => $leave_request->description
                ]);

            $leave_request->delete();

            DB::commit();
            Session::flash('success-msg', 'Leave Request Deleted Successfully');
            return redirect()->back();
            
        } catch (Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error-msg',$e->getMessage());
        }
        
    }

    public function getViewLeaveLogs()
    {   
        /*$leave_logs = DB::table('users')
                            ->join('')
                            ->*/
        $controller = new HelperController;
        $user_id = $controller->getCurrentUserId();                            
        $user = User::select('name', 'id')->get();   
        $leave_logs = DB::table('users')
                        ->join('leave_logs', 'leave_logs.user_id','=','users.id')
                        ->select('name', 'leave_logs.*')
                        ->where('leave_logs.user_id', $user_id)
                        ->orderby('created_at','DESC')
                        ->get();

        return view('leave::leave-logs')->with('user', $user)
                                        ->with('leave_logs', $leave_logs);
    }
}
