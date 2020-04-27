<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'facebook', 'namespace' => 'Modules\Facebook\Http\Controllers'], function()
{
	//GET ROUTES
    Route::get('create-fb-posts', [
    	'as' => 'create-fb-posts', 
    	'uses' => 'FacebookController@getCreateFacebookPosts', 
    	'module' => 'Facebook', 
    	'permission_type' => 'can_create_fb_link_posts'
    	]);

    Route::get('create-fb-posts-with-image', [
    	'as' => 'create-fb-posts-with-image', 
    	'uses' => 'FacebookController@getCreateFacebookPostswithImage',
    	'module' => 'Facebook', 
    	'permission_type' => 'can_create_fb_image_posts'
    	]);

    Route::get('list-fb-post', [
        'as' => 'list-fb-post', 
        'uses' => 'FacebookController@getListFacebookPosts', 
        'module' => 'Facebook', 
        'permission_type' => 'can_view_fb_posts'
        ]);

    Route::get('view-facebook-post/{id}/{post_type}',[
        'as' => 'view-facebook-post', 
        'uses' => 'FacebookController@getViewFacebookPosts', 
        'module' => 'Facebook', 
        'permission_type' => 'can_view_fb_posts'
        ]);

    Route::get('delete-facebook-post/{id}/{post_type}',[
        'as' => 'delete-facebook-post', 
        'uses' => 'FacebookController@getDeleteFacebookPost', 
        'module' => 'Facebook', 
        'permission_type' => 'can_delete_fb_posts'
        ]);

    //POST ROUTES

    Route::post('create-fb-posts-with-link', [
    	'as' => 'create-fb-posts-with-link', 
    	'uses' => 'FacebookController@postCreateFacebookPostswithLinks', 
    	'module' => 'Facebook', 
    	'permission_type' => 'can_create_fb_link_posts' 
    	]);

    Route::post('create-posts-fb-with-image', [
    	'as' => 'create-posts-fb-with-image', 
    	'uses' => 'FacebookController@postCreateFacebookPostswithImages', 
    	'module' => 'Facebook', 
    	'permission_type' => 'can_create_fb_image_posts'
    	]);
});
