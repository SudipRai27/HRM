<?php

namespace Modules\Job\Entities;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['job_title', 'job_description', 'department_id'];

    protected $table = 'job';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
