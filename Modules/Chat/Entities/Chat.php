<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Chat extends Model
{
    protected $fillable = ['from', 'to', 'text'];

    protected $table = 'chat';

    public function fromContact() 
    {
    	return $this->hasOne(User::class, 'id', 'from');	
    }
    
}
