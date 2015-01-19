<?php

class UserController extends \BaseController {

    /**
     * 用户登陆
     *
     * @return Response
     **/
    public function sigin()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'username' => Input::get('username'),
                'password' => Input::get('password'),
            ],
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        if($validator->fails()) {
            $resData['status']    = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $user = Config::get('const.user');
        if((Input::get('username') !== $user['mobile'] 
            && Input::get('username') !== $user['email'])
            || Input::get('password') !== $user['password']
        ) {
            $resData['status']    = 300;
            $resData['message'] = '账号或密码错误';

            return $this->result($resData);
        }

        $resData['status']    = 1;
        $resData['message'] = '请求成功';
        $resData['data'] = Config::get('const.user_baseinfo');
        $resPack = msgpack_pack($resData);

        // 将token,salt写入header
        $token = Config::get('const.token');
        $salt = Config::get('const.salt');

        $response = Response::make($resPack, 200);
        $response->header('TOKEN', $token);
        $response->header('SALT', $salt);
        
        return $response;
    }

    /**
     * 用户注册
     *
     * @return Response
     **/
    public function create()
    {
        $resData = [];

        if(
            Input::has('mobile')
            && !Input::has('email')
            && Input::has('password')
            && Input::has('code')
        ) {
            if(Input::get('code') !== Config::get('const.smsCode')) {
                $resData['status']    = 300;
                $resData['message'] = '验证码错误';

                return $this->result($resData);
            }
        } elseif (
            !Input::has('mobile')
            && Input::has('email')
            && Input::has('password')
            && !Input::has('code')
        ) {

        } else {
            $resData['status']    = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $resData['status']    = 1;
        $resData['message'] = '注册成功';
        $resData['data'] = Config::get('const.user_baseinfo');
        
        return $this->result($resData);
    }

    /**
     * 获取个人资料
     *
     * @return Response
     **/
    public function info()
    {
        $resData = [];

        $resData['data'] = Config::get('const.user_baseinfo');
        
        return $this->result($resData);
    }

    /**
     * 上传头像
     *
     * @return Response
     **/
    public function avatar()
    {
        $resData = [];

        if(!Input::hasFile('avatar')) {
            $resData['status']    = 300;
            $resData['message'] = '未添加上传文件';

            return $this->result($resData);
        }

        $avatar = Config::get('const.user_baseinfo.avatar');
        $resData['data'] = ['avatar' => $avatar];

        return $this->result($resData);
    }

    /**
     * 个人资料更新
     *
     * @return Response
     **/
    public function update()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'avatar'   => Input::get('avatar'),
                'nickname' => Input::get('nickname'),
                'sex'      => Input::get('sex'),
                'birthday' => Input::get('birthday'),
                'address'  => Input::get('address'),
            ],
            [
                'avatar'   => 'required',
                'nickname' => 'required',
                'sex'      => 'required',
                'birthday' => 'required',
                'address'  => 'required',
            ]
        );
        if($validator->fails()) {
            $resData['status']    = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $resData['status']    = 300;
        $resData['message'] = '个人资料更新成功';
        $resData['data'] = Config::get('const.user_baseinfo');
        
        return $this->result($resData);
    }

    /**
     * 修改密码
     *
     * @return Response
     **/
    public function pwd()
    {
        $resData = [];

        if(
            Input::has('old_password') 
            && Input::has('new_password') 
            && !Input::has('code')
        ) {

        } elseif (
            !Input::has('old_password') 
            && Input::has('new_password') 
            && Input::has('code')
        ) {
            if(Input::get('code') !== Config::get('const.resetCode')) {
                $resData['status']    = 300;
                $resData['message'] = '修改密码验证码错误';

                return $this->result($resData);
            }
        } else {
            $resData['status']    = 300;
            $resData['message'] = '修改密码参数格式验证失败';

            return $this->result($resData);
        }

        $validator = Validator::make(
            [
                'new_password' => Input::get('new_password')
            ],
            [
                'new_password' => 'min:6'
            ]
        );

        if($validator->fails()) {
            $resData['status']    = 311;
            $resData['message'] = '新密码格式错误';
        }

        $resData['message'] = '修改密码成功';
        return $this->result($resData);
    }

}