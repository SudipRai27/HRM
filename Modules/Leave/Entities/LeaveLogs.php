<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveLogs extends Model
{
    protected $fillable = ['id', 'user_id', 'date_range','status','description'];

    protected $table = 'leave_logs';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
