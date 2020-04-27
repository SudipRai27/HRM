<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{

	//GET ROUTES

    Route::get('user-view/{id}', [
        'as' => 'user-view', 
        'uses' => 'UserController@getUserView', 
        'module' => 'User', 
        'permission_type' => 'can_view_individual_user',  
        ])->middleware(['AuthCheck', 'Permission']);

    Route::get('view-profile/{id}', [
        'as' => 'view-profile', 
        'uses' => 'UserController@getViewProfile', 
        'module' => 'User', 
        'permission_type' => 'can_view_profile'
        ])->middleware(['AuthCheck','Permission']);

    Route::get('/register', [
    	'as' => 'user-register', 
    	'uses' => 'UserController@getRegister', 
        'module' => 'User', 
        'permission_type' => 'can_create'
        ])->middleware(['AuthCheck','Permission']);

    Route::get('/login', [
    	'as' => 'user-login', 
    	'uses' => 'UserController@getUserLogin'
    	])->middleware('RedirectIfAuthenticated');

    Route::get('/home', [
    	'as' => 'user-home', 
    	'uses' => 'UserController@getUserHome'
    	])->middleware('AuthCheck');

    Route::get('/user-logout',[
    	'as' => 'user-logout', 
    	'uses' => 'UserController@getLogout'
    	])->middleware('AuthCheck');

    Route::get('list-user', [
        'as' => 'list-user', 
        'uses' => 'UserController@getListUser', 
        'module' => 'User', 
        'permission_type' => 'can_view'
        ])->middleware(['AuthCheck','Permission']);

    Route::get('user-edit/{id}', [
        'as' => 'user-edit', 
        'uses' => 'UserController@getEditUser', 
        'module' => 'User', 
        'permission_type' => 'can_edit'
        ])->middleware(['AuthCheck','Permission']);


    Route::get('user-delete/{id}', [
        'as' => 'user-delete', 
        'uses' => 'UserController@getUserDelete', 
        'module' => 'User', 
        'permission_type' => 'can_delete'
        ])->middleware(['AuthCheck','Permission']);


    Route::get('generate-user-excel', [
        'as' => 'generate-user-excel', 
        'uses' => 'UserController@getUserExcel', 
        'module' => 'User', 
        'permission_type' => 'can_generate_excel'
        ])->middleware(['AuthCheck','Permission']);


    Route::get('download-user-cv/{user_id}', [
        'as' => 'download-user-cv',
        'uses' => 'UserController@getDownloadCV'
        ]);

    //POST ROUTES

    Route::post('/user-create-post', [
    	'as' => 'user-create-post', 
    	'uses' => 'UserController@postRegister', 
        'module' => 'User', 
        'permission_type' => 'can_create'
        ])->middleware(['AuthCheck','Permission']);

    Route::post('/user-login-post', [
    	'as' => 'user-login-post', 
    	'uses' => 'UserController@postUserLogin'
        ])->middleware('RedirectIfAuthenticated');


    Route::post('user-edit-post/{id}', [
        'as' => 'user-edit-post', 
        'uses' => 'UserController@postEditUser', 
        'module' => 'User', 
        'permission_type' => 'can_edit'
        ])->middleware(['AuthCheck','Permission']);

    Route::post('change-password', [
        'as' => 'change-password', 
        'uses' => 'UserController@postChangePassword', 
        'module' => 'User', 
        'permission_type' => 'can_change_password'
        ])->middleware(['AuthCheck','Permission']);

});

//AjAX ROUTES AND FUNCTION ARE DEFINED IN APP/HTTP/CONTROLLERS/AJAXCONTROLLER AND ROUTES/AJAX_ROUTES.PHP