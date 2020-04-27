<?php

namespace Modules\Facebook\Entities;

use Illuminate\Database\Eloquent\Model;

class FacebookPosts extends Model
{
    protected $fillable = ['message', 'link', 'created_by'];

    protected $table = 'facebook_link_post';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
