<?php

class SmsController extends \BaseController {

    /**
     * 发送短信验证(注册时的短信验证和忘记密码时的短信验证)
     *
     * @return Response
     **/
    public function send()
    {
        $resData = [];

        $validator = Validator::make(
        array('mobile' => Input::get('mobile')),
        array('mobile' => 'required|min:11')
    );

        if($validator->fails()) {
            $resData['code']    = 300;
            $resData['message'] = '参数格式验证失败';
        }

        $resData['message'] = '短信已发送';
        
        return $this->result($resData);
    }

    /**
     * 忘记密码手机找回验证手机
     *
     * @return Response
     **/
    public function check()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'mobile' => Input::get('mobile'),
                'code'   => Input::get('code')
            ],
            [
                'mobile' => 'required|min:11',
                'code'   => 'required'
            ]
        );

        if($validator->fails()) {
            $resData['code']    = 300;
            $resData['message'] = '参数格式验证失败';
            return $this->result($resData);
        }

        if(Input::get('code') !== Config::get('const.smsCode')) {
            $resData['code']    = 300;
            $resData['message'] = '验证码错误';

            return $this->result($resData);
        }

        // 请求成功
        $resData['data']['code'] = Config::get('const.resetCode');

        return $this->result($resData);
    }

}