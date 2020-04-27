<?php

Route::group(['middleware' => 'web', 'prefix' => 'chat', 'namespace' => 'Modules\Chat\Http\Controllers'], function()
{
    Route::get('chat-view', [
    	'as' => 'chat-view', 
    	'uses' => 'ChatController@getChatView'
    	]);


    //AJAX API ROUTES FOR CHAT 

    Route::get('contacts', [
    	'as' => 'chat-contacts', 
    	'uses' => 'ChatController@getChatContacts'
    	]);

    Route::get('conversation/{id}', [
    	'as' => 'chat-conversation', 
    	'uses' => 'ChatController@getMessageFor'
    	]);	

    Route::post('conversation/send', [
    	'as' => 'chat-conversation-send', 
    	'uses' => 'ChatController@send'
    	]);	
});
