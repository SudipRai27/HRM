<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
	
    protected $table = "user_details";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['user_id', 'department_id', 'job_id', 'joining_date', 'resume'];
    
}

