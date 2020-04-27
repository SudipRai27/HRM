<?php

namespace Modules\DailyReport\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = ['user_id', 'date', 'time', 'work_done', 'remaining_work', 'todays_learning','suggestions','problems','file'];

    protected $table = 'daily_report';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
