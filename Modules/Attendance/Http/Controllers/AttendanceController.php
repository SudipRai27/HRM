<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\AttendanceHelperController;
use Modules\Attendance\Entities\Attendance;
use Modules\User\Entities\User;
use Session;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getUserCheckIn()
    {
        $helper_controller = new HelperController;
        $attendance_controller = new AttendanceHelperController;

        $current_user_id = $helper_controller->getCurrentUserId();
        /*$attendance_time = $attendance_controller->checkTimeForOfficeHours();*/
        $check_leave = $attendance_controller->checkLeaveRequestForToday($current_user_id);
        $check_attendance = $attendance_controller->checkAttendanceRecordForToday($current_user_id);


        /*if($attendance_time == 'false')
        {
            Session::flash('error-msg', 'Attendance cannot be done after 5PM');
            return redirect()->back();
        }*/
        if($check_leave == 'leave')
        {
            Session::flash('error-msg', 'Your leave has been approved for today so you cannot check in.'); 
            return redirect()->back();
        }


        if($check_attendance == 'true')
        {
            Session::flash('error-msg', 'You have already checked in and your attendance is already created.');
            return redirect()->back();
        }

        
        $current_date = date('Y-m-d');       
        $current_time = date('h:i A');
        
        
        Attendance::create([
            'user_id' => $current_user_id,
            'attendance_date' => $current_date,
            'attendance_time' => $current_time,
            'attendance' => 'present',            
            ]);
        Session::flash('success-msg', 'Checked in and attendance created successfully');
        return redirect()->back();

    }

    public function getUserCheckOut()
    {
        $helper_controller = new HelperController;   
        $current_user_id = $helper_controller->getCurrentUserId();

        $attendance_controller = new AttendanceHelperController;
        $check_leave = $attendance_controller->checkLeaveRequestForToday($current_user_id);
        $check_attendance_check_in_time = $attendance_controller->checkAttendanceCheckInTime($current_user_id);
        $check_attendance_check_out_time = $attendance_controller->checkAttendanceCheckOutTime($current_user_id);
        

        if($check_leave == 'leave')
        {
            Session::flash('error-msg', 'Your leave has been approved for today so you cannot check out.'); 
            return redirect()->back();
        }

        if($check_attendance_check_in_time == 'false')
        {
            Session::flash('error-msg', 'You have not checked in today so you cannot check out.');
            return redirect()->back();
        }

        if(strlen($check_attendance_check_out_time) > 0)
        {
            Session::flash('error-msg', 'You have already checked out for today.');
            return redirect()->back();
        }        

        $today = Carbon::now()->format('Y-m-d');
        $current_time = date('h:i A');
        $attendance_today = Attendance::where('user_id', $current_user_id)
                                    ->where('attendance_date', $today)
                                    ->first();

        $attendance_today->attendance_check_out_time =  $current_time;
        $attendance_today->save();
        Session::flash('success-msg', 'Checked Out Attendance successfully');
        return redirect()->back();
        
                    
    }

    public function getListUserAttendance()
    {
        $today = Carbon::now()->format('Y-m-d');
        $users = User::all();
        $todays_attendance = [];
        $i = 0;
        foreach($users as $user=> $d)
        {   
            
            $attendance_today = Attendance::where('user_id', $d->id)->where('attendance_date', $today)->first();
            if(count($attendance_today))
            {
                $todays_attendance[$d->id]['name'] = $d->name;
                $todays_attendance[$d->id]['attendance'] = $attendance_today->attendance;
                $todays_attendance[$d->id]['attendance_time'] = $attendance_today->attendance_time;
                $todays_attendance[$d->id]['attendance_check_out_time'] = $attendance_today->attendance_check_out_time;
            }
            else
            {
                $todays_attendance[$d->id]['name'] = $d->name;
                $todays_attendance[$d->id]['attendance'] = 'absent';
                $todays_attendance[$d->id]['attendance_time'] = '';
                $todays_attendance[$d->id]['attendance_check_out_time'] = '';
            }                     

        }


         
        /*$attendance_records = DB::table('attendance')
                                ->join('users','users.id', '=', 'attendance.user_id')
                                ->select('users.name', 'attendance.attendance_time', 'attendance', 'rfid')
                                ->where('attendance_date', $today)
                                ->get();*/

        return view('attendance::list-attendance')->with('todays_attendance', $todays_attendance);
    }

    public function getListUserAttendanceHistory(Request $request)
    {
        $user = User::select('name', 'id')->get();
        /*$attendance_records = [];
        $start_date = '';
        $end_date = '';
        $user_id = '';

        if($request->has('start_date') && $request->has('end_date') && $request->has('user_id'))
        {
            $controller = new HelperController;
            if(date($request->start_date == 'dd/mm/yyyy'))
            {
                $start_date = $controller->changeDateFormatfromSlashToHyphen($request->start_date);    
            }
            else
            {
                $start_date = $request->start_date;
            }

            if(date($request->end_date == 'd/m/y'))
            {
                $end_date = $controller->changeDateFormatfromSlashToHyphen($request->end_date);    
            }
            else
            {
                $end_date = $request->end_date;
            }

            
            
            
            if($start_date == $end_date)
            {
                $attendance_records = DB::table('attendance')
                                ->join('users','users.id', '=', 'attendance.user_id')
                                ->select('users.name', 'attendance.attendance_time', 'attendance', 'rfid')
                                ->where('attendance_date', $start_date)
                                ->where('users.id', $request->user_id)                                
                                ->get();                                
            }
            else
            {   
                $attendance_records = DB::table('attendance')
                                ->join('users','users.id', '=', 'attendance.user_id')
                                ->select('users.name', 'attendance.attendance_time', 'attendance', 'rfid')
                                ->whereBetween('attendance_date', [$start_date, $end_date])
                                ->where('users.id', $request->user_id)
                                ->get();                                
            }
        } */


        return view('attendance::list-select-attendance-history')->with('user', $user);
    }

}
