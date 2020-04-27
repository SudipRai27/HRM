<?php
namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
USE Request;

class HelperController extends Controller
{

    public function removeGlobal($type)
    {
        if(Session::has($type))
            Session::forget($type);
    }
	   
    public function checkUserType()
    {
        if(auth()->guard('superadmin')->check())
        {
            $user_type = 'superadmin';
        }
        else
        {
            $user_type = 'user';
        }

        return $user_type;

    }

    public function getUserRoleId()
    {
        if(auth()->guard('user')->check())
        {
            $user_id = auth()->guard('user')->id();
            $role_id = DB::table('user_roles')
                        ->where('user_id', $user_id)
                        ->pluck('role_id')[0];
            
        }

        return $role_id;
    }

    public function changeDateFormatfromSlashToHyphen($date)
    {
        $new_date = explode("/", $date);
        $formatted_date = $new_date[2].'-'.$new_date[0].'-'.$new_date[1];
        return $formatted_date;
    }

    public function changeDateFormatfromHyphenToSlash($date)
    {
        $new_date = explode("-", $date);
        $formatted_date = $new_date[1].'/'.$new_date[2].'/'.$new_date[0]; 
        return $formatted_date;
    }

    public function getCurrentUserId()
    {
        $current_user_id = auth()->guard('user')->id();
        return $current_user_id;
    }

    public function checkStartDate($start_date)
    {
        //check whether leave request date is in the past
        $today = Carbon::now()->format('Y-m-d');
        if($start_date < $today)
        {
            $status = 'true';
        }
        else
        {
            $status = 'false';
        }

        return $status;
    }        
    
    public function getUserNameFromUserId($user_id)
    {
        $user_name = DB::table('users')
                        ->where('id', $user_id)
                        ->select('name')
                        ->first();

        return $user_name->name;                        
    }

    public function checkDailyReport($date, $user_id)
    {
        $daily_report = DB::table('daily_report')
                            ->where('date', $date)
                            ->where('user_id', $user_id)
                            ->first();

        if(count($daily_report))
        {
            $record = 'yes';
        }
        else
        {
            $record = 'no';
        }

        return $record;
    }

    public function getCreatedBy()
    {
        $user_type = $this->checkUserType();

        if($user_type == 'superadmin')
        {
            $current_user = DB::table('superadmin')
                            ->where('id', auth()->guard('superadmin')->id())
                            ->first();

        }
        else
        {
            $current_user = DB::table('users')
                            ->where('id', auth()->guard('user')->id())
                            ->first();
        }
        
        return $current_user->name;
    }
}

