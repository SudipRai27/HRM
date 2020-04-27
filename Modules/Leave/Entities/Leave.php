<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['user_id', 'start_date', 'end_date', 'description', 'status', 'status_updated_date_time'];

    protected $table = 'leave';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
