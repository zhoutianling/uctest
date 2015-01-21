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
	return View::make('hello');
});

// 注册，登陆
Route::put('user/signin', 'UserController@signin');
Route::post('user/create', 'UserController@create');

// 短信
Route::get('sms/send', 'SmsController@send');
Route::get('sms/check', 'SmsController@check');
    
Route::group(['before' => 'signAuth|userAuth'], function()
{
    // 用户
    Route::get('user/info', 'UserController@info');
    Route::post('user/avatar', 'UserController@avatar');
    Route::put('user/update', 'UserController@update');
    Route::put('user/pwd', 'UserController@pwd');

    // 用户充值消费
    Route::get('trades', 'TradesController@index');
    Route::post('trades/create', 'TradesController@create');

    // 用户反馈
    Route::get('feedbacks', 'FeedbacksController@index');
    Route::get('feedbacks/{feedback_id}', 'FeedbacksController@detail');
    Route::post('feedbacks/create', 'FeedbacksController@create');

    
});