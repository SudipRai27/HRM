<?php

namespace Modules\DailyReport\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DailyReport\Entities\DailyReport;
use Carbon\Carbon;
use DB;
use Session;
use App\Http\Controllers\HelperController;
use Modules\User\Entities\User;
use File;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public $file_path;

    public function __construct()
    {
        $this->file_path = 'daily_report_files/';
    }

    public function getListDailyReport()
    {        
        $today = Carbon::now()->format('Y-m-d'); 
        $controller = new HelperController;
        $user_type = $controller->checkUserType();
        if($user_type == 'superadmin')
        {
            $daily_report = DB::table('daily_report')
                        ->join('users','users.id','=','daily_report.user_id')
                        ->select('users.name','daily_report.*')
                        ->orderBy('created_at','DESC')
                        ->where('date',$today)
                        ->get();
        }
        else
        {
            $daily_report = DB::table('daily_report')
                        ->join('users','users.id','=','daily_report.user_id')
                        ->select('users.name','daily_report.*')
                        ->orderBy('created_at','DESC')
                        ->where('date',$today)
                        ->where('user_id', $controller->getCurrentUserId())
                        ->get();   
        }
        
        

        return view('dailyreport::list')->with('daily_report', $daily_report);
                                        
    }

    public function getCreateDailyReport()
    {
        $users = DB::table('users')->select('name','id')->get();  
        return view('dailyreport::create')->with('users', $users);
    }

    public function postCreateDailyReport(Request $request)
    {
        $controller = new HelperController;
        $user_type = $controller->checkUserType();        
        $input = request()->all();  

        if($user_type == 'superadmin')
        {
            $request->validate([
                'user_id' => 'required', 
                'date' => 'required', 
                'work_done' => 'required', 
                'remaining_work' => 'required',
                'date' => 'required|date_format:"m/d/Y'

                ]);            
                      
        }
        else
        {
            $request->validate([

                'date' => 'required', 
                'work_done' => 'required', 
                'remaining_work' => 'required', 
                'date' => 'required|date_format:"m/d/Y'
                ]);
                        
            $input['user_id'] = $controller->getCurrentUserId();
        }

        if($request->hasFile('file')) 
        {
            $name = uniqid() . $request->file->getClientOriginalName();
            $ext = $request->file->getClientOriginalExtension();
            $request->file->move(public_path(). '/'. $this->file_path, $name,$ext);
            $input['file'] = $name;
        }   

        $formatted_date = $controller->changeDateFormatfromSlashToHyphen($request->date);
        $check_daily_report = $controller->checkDailyReport($formatted_date, $input['user_id']);

        if($check_daily_report == 'yes')
        {
            Session::flash('error-msg', 'Daily Report already exists for the given date. Pleas try again..');
            return redirect()->back()->withInput();
        }

        $input['date'] = $formatted_date;
        $input['time'] = date('h:i A');    
        DailyReport::create($input);
        Session::flash('success-msg', 'Created Successfully');
        return redirect()->back();
    }

    public function getDeleteReport($id)
    {
        $report = DailyReport::findorfail($id);
        $file_path = public_path().'/'. $this->file_path . $report->file;

        if(File::exists($file_path))
        {
            File::delete($file_path); 
        }

        $report->delete();
        Session::flash('success-msg', 'Deleted Successfully');
        return redirect()->back();
    }

    public function getEditReport($id)
    {
        $daily_report = DailyReport::findorfail($id);
        $users = DB::table('users')->select('id', 'name')->get();
        return view('dailyreport::edit')->with('daily_report', $daily_report)
                                        ->with('users', $users);
    }

    public function postEditReport(Request $request, $id)
    {
        $controller = new HelperController;
        $user_type = $controller->checkUserType();    
        $daily_report = DailyReport::findorfail($id);    
        $input = request()->all();  

        if($user_type == 'superadmin')
        {
            $request->validate([
                'user_id' => 'required', 
                'date' => 'required', 
                'work_done' => 'required', 
                'remaining_work' => 'required',
                'date' => 'required|date_format:"m/d/Y'

                ]);            
                      
        }
        else
        {
            $request->validate([

                'date' => 'required', 
                'work_done' => 'required', 
                'remaining_work' => 'required', 
                'date' => 'required|date_format:"m/d/Y'
                ]);
                        
            $input['user_id'] = $controller->getCurrentUserId();
        }

        if($request->hasFile('file')) 
        {
            $file_path = public_path().'/'. $this->file_path . $daily_report->file;
            if(File::exists($file_path))
            {
                File::delete($file_path); 
            }


            $name = uniqid() . $request->file->getClientOriginalName();
            $ext = $request->file->getClientOriginalExtension();
            $request->file->move(public_path(). '/'. $this->file_path, $name,$ext);
            $input['file'] = $name;
        }  

        $formatted_date = $controller->changeDateFormatfromSlashToHyphen($request->date);
        /*$check_daily_report = $controller->checkDailyReport($formatted_date, $input['user_id']);*/
/*
        if($check_daily_report == 'yes')
        {
            Session::flash('error-msg', 'Daily Report already exists for the given date. Pleas try again..');
            return redirect()->back()->withInput();
        }*/

        $input['date'] = $formatted_date;
        $input['time'] = date('h:i A');    
        $daily_report->update($input);
        Session::flash('success-msg', 'Updated Successfully');
        return redirect()->back();
    }

    public function getViewReport($id)
    {
        $daily_report = DailyReport::findorfail($id);
        return view('dailyreport::view')->with('daily_report', $daily_report);   
    }

    public function getDownloadReportFile($id)
    {

        $daily_report = DailyReport::where('id', $id)->select('file')->first();
        $file_path = public_path().'/'. $this->file_path . $daily_report->file;
    
        return response()->download($file_path);
        /*return response()->file($file_path);*/
    }

    public function getreportHistory()
    {
        $user = User::select('name', 'id')->get();
        return view('dailyreport::report-history')->with('user', $user);
    }
}
