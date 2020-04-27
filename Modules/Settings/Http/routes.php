<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'settings', 'namespace' => 'Modules\Settings\Http\Controllers'], function()
{

	//GET ROUTES
	
    Route::get('update-general-settings', [
    	'as' => 'update-general-settings', 
    	'uses' => 'SettingsController@getUpdateSettings', 
        'module' => 'Settings', 
        'permission_type' => 'can_update_general_settings',
    	]);


    //POST ROUTES

    Route::post('settings-update', [
    	'as' => 'settings-update', 
    	'uses' => 'SettingsController@postUpdateSettings',
        'module' => 'Settings', 
        'permission_type' => 'can_update_general_settings',
    	]);	
});
