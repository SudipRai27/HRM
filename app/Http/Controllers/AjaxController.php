<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Modules\Job\Entities\Job;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\AttendanceHelperController;
use Modules\Attendance\Entities\Attendance;
use Modules\DailyReport\Entities\DailyReport;
use DB;
use Carbon\Carbon;
use DateTime;

class AjaxController extends Controller
{
	public function getJobListFromDepartmentId(Request $request)
	{
		$department_id = $request->department_id;
		$job_list = Job::where('department_id', $department_id)
						->pluck('job_title','id');
		
		$select = '';
    	$select .= '<option value = ""> Select  </option>';

    	foreach($job_list as $index => $d)
    	{

    		$select.= '<option value = '.$index.'>'.$d.'</option>';
    	}
    	
    	return $select;
	}	

	public function getAttendanceHistoryFromDateAndUserId(Request $request)
	{
		
		$controller = new HelperController;
		$start_date = $controller->changeDateFormatfromSlashToHyphen($request->start_date);
		$end_date = $controller->changeDateFormatfromSlashToHyphen($request->end_date);


		if($start_date == $end_date)
        {
            $attendance_records = DB::table('attendance')
                            ->join('users','users.id', '=', 'attendance.user_id')
                            ->select('users.name', 'attendance.attendance_time', 'attendance', 'attendance_check_out_time', 'attendance_date')
                            ->where('attendance_date', $start_date)
                            ->where('users.id', $request->user_id)
                            ->get();                             
                            
        }
        else
        {   
            $attendance_records = DB::table('attendance')
                            ->join('users','users.id', '=', 'attendance.user_id')
                            ->select('users.name', 'attendance.attendance_time', 'attendance', 'attendance_check_out_time', 'attendance_date')
                            ->whereBetween('attendance_date', [$start_date, $end_date])
                            ->where('users.id', $request->user_id)
                            ->get();
                                                       
        }
        
        $controller = new AttendanceHelperController;
        $total_days = $controller->getTotalDaysCount($start_date, $end_date);
        $date_range = $controller->generateDateRange($start_date, $end_date);        
        
        $temp = [];
        $i = 1;
        $count = count($date_range);

        $saturdays = '';
        $working_days = '';
        $present_days = 0;
        $leave_days = 0;
        $absent_days = 0;


        foreach($date_range as $index => $d)
        {
     		$attendance_result = DB::table('attendance')
	                            ->join('users','users.id', '=', 'attendance.user_id')
	                            ->select('users.name', 'attendance.attendance_time', 'attendance', 'attendance_check_out_time', 'attendance_date')
	                            ->where('attendance_date', $d)
	                            ->where('users.id', $request->user_id)
	                            ->first();    
	                            
	        $days_name = $controller->getDaysName($d);   

		    if($days_name == 'Saturday')
	        {
	        	$saturdays = (int) $saturdays +1;
	        }
	        else
	        {
	        	$working_days = (int) $working_days + 1;
	        }     	        
			
			if(count($attendance_result))
			{				
				$temp[$i]['attendance_time'] = $attendance_result->attendance_time;
    			$temp[$i]['day_name'] = $controller->getDaysName($d);
    			if($temp[$i]['day_name'] == 'Saturday')
    			{
    				$temp[$i]['attendance'] = 'not applicable';
    			}
    			else
    			{
    				$temp[$i]['attendance'] = $attendance_result->attendance;
                    if($temp[$i]['attendance'] == 'present')
                    {
                        $present_days++;
                    }
                    else
                    {
                        $leave_days++;
                    }
    			}
    			$temp[$i]['attendance_check_out_time'] = $attendance_result->attendance_check_out_time;
    			$temp[$i]['date'] = $d;
			}	
			else
			{
				
				$temp[$i]['attendance_time'] = '';        			        			
        		$temp[$i]['day_name'] = $controller->getDaysName($d);
        		if($temp[$i]['day_name'] == 'Saturday')
        		{
        			$temp[$i]['attendance'] = 'not applicable';
        		}
        		else
        		{
        			$temp[$i]['attendance'] = 'absent';
                    $absent_days++;
        		}
        		$temp[$i]['attendance_check_out_time'] = '';        			
        		$temp[$i]['date'] = $d;
			} 

     		$i++;
        }

       

        /*foreach($date_range as $index => $d)
        {
        	foreach ($attendance_records as $key => $value) {
        		if($d == $value->attendance_date)
        		{
        			$temp[$i]['name'] = $value->name;
        			$temp[$i]['attendance_time'] = $value->attendance_time;
        			$temp[$i]['day_name'] = $controller->getDaysName($d);
        			if($temp[$i]['day_name'] == 'Saturday')
        			{
        				$temp[$i]['attendance'] = 'not applicable';
        			}
        			else
        			{
        				$temp[$i]['attendance'] = $value->attendance;
        			}
        			$temp[$i]['attendance_check_out_time'] = $value->attendance_check_out_time;
        			$temp[$i]['date'] = $d;
        			
        		}
        		else
        		{
        			$temp[$i]['name'] = $value->name;
        			$temp[$i]['attendance_time'] = '';        			        			
        			$temp[$i]['day_name'] = $controller->getDaysName($d);
        			if($temp[$i]['day_name'] == 'Saturday')
        			{
        				$temp[$i]['attendance'] = 'not applicable';
        			}
        			else
        			{
        				$temp[$i]['attendance'] = 'absent';
        			}
        			$temp[$i]['attendance_check_out_time'] = '';        			
        			$temp[$i]['date'] = $d;
        		}
        		
        	}
        	$i++;
        }*/
        
        return view('attendance::ajax-views.ajax-attendance-history')->with('attendance_records', $temp)
        															 ->with('saturdays', $saturdays)
        															 ->with('working_days', $working_days)
                                                                     ->with('present_days', $present_days)
                                                                     ->with('leave_days', $leave_days)
                                                                     ->with('absent_days', $absent_days)
                                                                     ->with('total_days', $total_days);

	}

    public function getSearchUser(Request $request)
    {
        $input = $request->input; 

        if($request->ajax())
        {
            $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id','gender','users.created_at')
                    ->where('name','LIKE', '%'.$input.'%')
                    ->orWhere('email','LIKE','%'.$input.'%')
                    ->orderBy('created_at', 'DESC')
                    ->get();
        
        }
        return view('user::ajax-views.ajax-user-list')->with('user', $user);

    }

    public function getLeaveHistoryFromDateUserIdandAttendance(Request $request)
    {
        $input = request()->all();
        $controller = new HelperController;
        $start_date = $controller->changeDateFormatfromSlashToHyphen($input['start_date']);
        $end_date = $controller->changeDateFormatfromSlashToHyphen($input['end_date']);
        $leave_history = Attendance::whereBetween('attendance_date',[$start_date, $end_date])
                                    ->where('attendance', 'leave')
                                    ->where('user_id', $input['user_id'])
                                    ->get()
                                    ->toArray();
        
        $attendance_helper_controller = new AttendanceHelperController;
        $i = 0;
        $temp = [];
        foreach($leave_history as $index => $data)                                    
        {
            $temp[$i]['day_name'] = $attendance_helper_controller->getDaysName($data['attendance_date']);
            if($temp[$i]['day_name'] == 'Saturday')
            {
                $temp[$i]['date'] = $data['attendance_date'];
                $temp[$i]['attendance'] = 'not applicable';
                $temp[$i]['day_name'] = $temp[$i]['day_name'];
            }
            else
            {   
                $temp[$i]['date'] = $data['attendance_date'];
                $temp[$i]['attendance'] = $data['attendance'];
                $temp[$i]['day_name'] = $temp[$i]['day_name'];
            }        
            $i++;
        }

        return view('leave::ajax-views.ajax-leave-history')->with('leave_history', $temp);                  
    }

    public function getLeaveLogsFromUserId(Request $request)
    {
        $leave_logs = DB::table('users')
                        ->join('leave_logs', 'leave_logs.user_id','=','users.id')
                        ->select('name', 'leave_logs.*')
                        ->where('leave_logs.user_id', $request->user_id)
                        ->orderby('created_at','DESC')
                        ->get();
        
        return view('leave::ajax-views.ajax-leave-logs')->with('leave_logs', $leave_logs);                        
    }

    public function getDailyReportHistoryFromDateandUserId(Request $request)
    {

        $controller = new HelperController;
        $start_date = $controller->changeDateFormatfromSlashToHyphen($request->start_date);
        $end_date = $controller->changeDateFormatfromSlashToHyphen($request->end_date);
        $report_history = DailyReport::where('user_id', $request->user_id)
                                    ->whereBetween('date', [$start_date, $end_date])
                                    ->get();
            
        return view('dailyreport::ajax-views.ajax-daily-report-history')->with('report_history', $report_history);
    }

}

