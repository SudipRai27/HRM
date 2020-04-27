<?php

Route::group(['middleware' => ['web', 'AuthCheck','Permission'], 'prefix' => 'accesscontrol', 'namespace' => 'Modules\AccessControl\Http\Controllers'], function()
{

	Route::get('list-modules', [
		'as' => 'list-modules', 
		'uses' => 'AccessControlController@getListAllModules', 
		'module' => 'AccessControl', 
        'permission_type' => 'can_view_modules'
		]);

	Route::get('create-permission/{module_name}', [
		'as' => 'create-permission', 
		'uses' => 'AccessControlController@getCreatePermission', 
		'module' => 'AccessControl', 
        'permission_type' => 'can_create_permission',
		]);

	Route::post('create-permissions-post/{module_name}', [
		'as' => 'create-permissions-post', 
		'uses' => 'AccessControlController@postCreatePermissions', 
		'module' => 'AccessControl', 
        'permission_type' => 'can_create_permission',
		]);
});
