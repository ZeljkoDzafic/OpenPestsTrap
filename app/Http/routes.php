<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', ['as'=>'login' ,'uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as'=>'login_post' ,'uses'=>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as'=>'logout' ,'uses'=>'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register',['as'=>'register','uses'=>'Auth\AuthController@getRegister'] );
Route::post('auth/register',['as'=>'register_post','uses'=>'Auth\AuthController@postRegister'] );

Route::filter('admin', function()
{
    $admin = \Illuminate\Support\Facades\Auth::user();
    if(!$admin['admin'])
        return redirect(route('network.index'));
});

Route::group(['before'=>'admin'],function(){
    Route::resource('notifications','NotificationsController');
    Route::get('notification/delete',['as'=>'notification.delete','uses'=>'NotificationsController@delete']);
    Route::resource('users','UsersController');
    Route::get('/user/admin/{id}',['as'=>'users.admin','uses'=>'UsersController@admin']);
    Route::get('/user/user/{id}',['as'=>'users.user','uses'=>'UsersController@user']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('traps','TrapsController');
    Route::resource('network','NetworkController');
    Route::post('/upload-image/{id}',['as'=>'upload-image','uses'=>'TrapsController@uploadImage']);
    Route::get('traps/{id}/image', ['as'=>'image' ,'uses'=>'TrapsController@getImage']);
    Route::post('traps/{id}/image', ['as'=>'image_post' ,'uses'=>'TrapsController@postImage']);
    Route::get('traps/{id}/image/edit', ['as'=>'edit_image' ,'uses'=>'TrapsController@editImage']);
    Route::post('traps/{id}/image/update', ['as'=>'update_image' ,'uses'=>'TrapsController@updateImage']);
    Route::post('traps/{id}/change', ['as'=>'change_plate' ,'uses'=>'TrapsController@changePlate']);
    Route::get('trap/{id}/delete',['as'=>'delete_trap','uses'=>"TrapsController@destroy"]);
    Route::get('notification/read',['as'=>'notification.read','uses'=>'NotificationsController@read']);
    Route::get('user/edit/{id}',['as'=>'user.edit','uses'=>'UsersController@editUser']);
    Route::post('user/edit/{id}',['as'=>'user.update','uses'=>'UsersController@updateUser']);
    Route::get('error_log',['uses'=>'ErrorLogController@create']);
    Route::post('error_log',['as'=>'error_log','uses'=>'ErrorLogController@store']);

});

Route::get('/battery/{traps_id}/{level}',['as'=>'batteryUpdate','uses'=>'BatteryController@storeAPI']);

Route::get('/home',['as'=>'public_home','uses'=>'TrapsController@publicIndex']);
Route::get('/trap/{id}/show',['as'=>'public_show','uses'=>'TrapsController@publicShow']);

Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::check())
        return redirect (route('networks.index'));
    else
        return redirect (route('public_home'));
});
