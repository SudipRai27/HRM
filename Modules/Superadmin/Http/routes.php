<?php

Route::group(['middleware' => 'web', 'prefix' => 'superadmin', 'namespace' => 'Modules\Superadmin\Http\Controllers'], function()
{

	/// GET REQUEST

    Route::get('/home', [
    	'as' => 'superadmin-home', 
    	'uses' => 'SuperadminController@getDashboard'
    	])->middleware('AuthCheck');

    Route::get('/create', [
    	'as' => 'superadmin-create', 
    	'uses' => 'SuperadminController@getCreate'
    	])->middleware('AuthCheck');


    Route::get('/login', [
    	'as' => 'superadmin-login', 
    	'uses' => 'SuperadminController@getLogin'
    	])->middleware('RedirectIfAuthenticated');


    Route::get('superadmin-logout', [
    	'as' => 'superadmin-logout', 
    	'uses' => 'SuperadminController@getLogout'
    	])->middleware('AuthCheck');

    Route::get('view-profile-superadmin/{id}', [
        'as' => 'view-profile-superadmin', 
        'uses' => 'SuperadminController@getViewProfileSuperadmin'
        ]); 


    ///POST REQUEST

    Route::post('/superadmin-create-post', [
    	'as' => 'superadmin-create-post', 
    	'uses' => 'SuperadminController@postCreate'
    	])->middleware('AuthCheck');


    Route::post('/superadmin-login-post', [
    	'as' => 'superadmin-login-post', 
    	'uses' => 'SuperadminController@postLogin'
    	])->middleware('RedirectIfAuthenticated');;


    Route::post('change-password-superadmin', [
        'as' => 'change-password-superadmin', 
        'uses' => 'SuperadminController@postChangeSuperadminPassword'
        ])->middleware('AuthCheck');
});
