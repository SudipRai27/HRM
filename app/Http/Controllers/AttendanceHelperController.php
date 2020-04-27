<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use DateTime;
use Modules\Attendance\Entities\Attendance;
use Modules\Leave\Entities\Leave;

class AttendanceHelperController extends Controller
{
    public function checkTimeForOfficeHours()
    {
		$time = Carbon::now();

		//$morning = Carbon::create($time->year, $time->month, $time->day, 22, 0, 0); //set time to 08:00
		$evening = Carbon::create($time->year, $time->month, $time->day, 18, 0, 0); //set time to 18:00

		if($time < $evening ) {

			$status =  'true';
		} 
		else 
		{
			$status =  'false';
		}

		return $status;
    }

    public function checkAttendanceRecordForToday($user_id)
    {	
    	$today = Carbon::now()->format('Y-m-d');
    	
    	$record = DB::table('attendance')
    					->where('user_id', $user_id)
    					->where('attendance_date', $today)
    					->first();

    	if(count($record))
    	{
    		$status = 'true';
    	}
    	else
    	{
    		$status = 'false';
    	}  

    	return $status;

    }

    public function checkAttendanceCheckInTime($user_id)
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $record = DB::table('attendance')
                        ->where('user_id', $user_id)
                        ->where('attendance_date', $today)
                        ->first();

        if(count($record))
        {
            $status = 'true';
        }
        else
        {
            $status = 'false';
        }

        return $status;

    }


    public function checkAttendanceCheckOutTime($user_id)
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $record = DB::table('attendance')
                        ->where('user_id', $user_id)
                        ->where('attendance_date', $today)
                        ->first();
        if(count($record))
        {
            $record = $record->attendance_check_out_time;
        }
        else
        {
            $record = '';
        }                        
        
        return $record;

    }

    public function checkLeaveRequestForToday($user_id)
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $record = DB::table('attendance')
                        ->where('user_id', $user_id)
                        ->where('attendance_date', $today)
                        ->first();   
        if(count($record))
        {
            $attendance = $record->attendance;
        }
        else
        {
            $attendance = '';
        }
        return $attendance;
    }

    public function generateDateRange($start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        $dates = [];

        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function getDaysName($date)
    {
        $date = Carbon::parse($date);
        $day = $date->format('l');
        return $day;
    }

    public function getTotalDaysCount($start_date, $end_date)
    {        
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $interval = $datetime2->diff($datetime1);
        $total_days = $interval->format('%a');
        $total_days = $total_days + 1;
        return $total_days;
    }

    public function checkAttendanceOnLeaveApprovedDay($date_range, $user_id)
    {
        
        $i = 0;
        foreach($date_range as $index => $d)
        {
            $check_attendance = Attendance::where('attendance_date', $d)
                                            ->where('user_id', $user_id)
                                            ->first();
            if(count($check_attendance))
            {
                $i++;
            }                                            
        }
        
        return $i;
    }

    public function checkAttendanceonLeaveCreatedDateRange($start_date, $end_date, $user_id)
    {   
        $date_range = $this->generateDateRange($start_date, $end_date);
        $i = 0;
        $attendance_date = [];
        foreach($date_range as $index => $date)
        {
            $attendance = Attendance::where('attendance_date', $date)
                                        ->where('user_id', $user_id)
                                        ->first();
                                        
        if(count($attendance))
            {
                $attendance_date[$i] = $attendance->attendance_date;
                
            }
            $i++;                                            
        }

        return $attendance;        
    }

    public function checkLeaveRecord($start_date, $end_date, $user_id)
    {
        
        $date_range = $this->generateDateRange($start_date, $end_date);
        $i = 0;
        foreach($date_range as $index => $date)
        {
            $check_leave_record = Leave::where('start_date', $date)
                                        ->orWhere('end_date', $date)
                                        ->where('user_id', $user_id)
                                        ->first();
            if(count($check_leave_record))
            {
                $i++;
            } 

        }

        return $i;

    }

    
}
