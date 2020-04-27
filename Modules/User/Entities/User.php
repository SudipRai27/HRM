<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
  
{
	use Notifiable;
	

    protected $fillable = ['name', 'email', 'password','address', 'contact', 'photo', 'remember_token','api_token', 'gender'];

    protected $table = "users";

    protected $hidden = ['password', 'remember_token', 'api_token'];	
}

