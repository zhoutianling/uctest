<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		return Redirect::guest('login');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('signAuth', function()
{
	// 获取header参数
	$params = Request::header('PARAMS');
	$sign = Request::header('SIGN');
	$deviceInfo = json_decode($params, true);

	// 获取服务器salt
	$salt = Config::get('const.salt');

	$uri = '/' . Request::path();

	$serverSign = md5($salt . $uri . $deviceInfo['uuid'] . $salt);

	if ($sign !== $serverSign) {
		$resData = [];

		$resData['status']    = 200;
        $resData['message'] = 'SIGN验证错误';
        $resData['data']    = '';

        $resPack = msgpack_pack($resData);

        return $resPack;
	}

});

Route::filter('userAuth', function()
{
	// 获取header参数
	$postToken = Request::header('TOKEN');

	// 获取服务器token
	$serverToken = Config::get('const.token');

	if($postToken !== $serverToken) {
		$resData = [];

		$resData['status']    = 300;
        $resData['message'] = '用户未登录';
        $resData['data']    = '';

        $resPack = msgpack_pack($resData);

        return $resPack;

        // $resJson = json_encode($resData);

        // return $resJson;
	}
    
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
