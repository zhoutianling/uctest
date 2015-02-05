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

Route::get('base', 'UserController@base');

Route::group(['before' => 'signAuth'], function()
{
    // 注册，登陆
    Route::put('user/signin', 'UserController@signin');
    Route::post('user/create', 'UserController@create');

    // 短信
    Route::get('sms/send', 'SmsController@send');
    Route::get('sms/check', 'SmsController@check');
    
    // 修改密码&重置密码
    Route::put('user/pwd', 'UserController@pwd');

    Route::group(['before' => 'userAuth'], function()
    {
        // 用户
        Route::get('user/info', 'UserController@info');
        Route::post('user/avatar', 'UserController@avatar');
        Route::put('user/update', 'UserController@update');
        
        // 用户充值消费
        Route::get('trades', 'TradesController@index');
        Route::post('trades/create', 'TradesController@create');

        // 用户反馈
        Route::get('feedbacks', 'FeedbacksController@index');
        Route::get('feedbacks/{feedback_id}', 'FeedbacksController@detail');
        Route::post('feedbacks/create', 'FeedbacksController@create');

    });

});