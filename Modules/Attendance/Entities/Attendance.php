<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'attendance_date', 'attendance', 'rfid', 'attendance_time' , 'attendance_check_out_time'];

    protected $table = 'attendance';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
