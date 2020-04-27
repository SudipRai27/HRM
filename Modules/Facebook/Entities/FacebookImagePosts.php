<?php

namespace Modules\Facebook\Entities;

use Illuminate\Database\Eloquent\Model;

class FacebookImagePosts extends Model
{
    protected $fillable = ['image', 'message', 'created_by'];

    protected $table = 'facebook_image_post';

    protected $guarded = ['id','created_at', 'updated_at'];
}
