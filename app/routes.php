<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::route('user');
});


Route::get('home', ['as'=>'user','uses' => 'FacebookController@show']);
Route::get('login/fb', ['as'=>'login/fb','uses' => 'FacebookController@login']);
Route::get('login/fb/callback', ['as'=>'login/fb/callback','uses' => 'FacebookController@doLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'FacebookController@logout']);










