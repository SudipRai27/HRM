<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = ['department_name', 'description'];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
