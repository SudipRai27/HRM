<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
@include('ajax-routes.php');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/remove-global/{type}', array(
	'as'	=>	'remove-global',
	'uses'	=>	'HelperController@removeGlobal'));

Route::get('login-option-page', [
	'as' => 'login-option-page', 
	'uses' => 'Controller@getLoginOptionPage'
	]);








