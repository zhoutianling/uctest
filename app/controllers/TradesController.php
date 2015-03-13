<?php

class TradesController extends \BaseController {

    /**
     * 我的交易
     *
     * @return Response
     **/
    public function index()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'type' => Input::get('type'),
                'page' => Input::get('page')
            ],
            [
                'type' => 'required',
                'page' => 'required|integer'
            ]
        );
        if($validator->fails()) {
            $resData['status']  = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $resData['data'] = Config::get('const.amounts_list');
        
        return $this->result($resData);
    }

    /**
     * 发送充值记录(sdk 发送)
     *
     * @return Response
     **/
    public function create()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'order_id'   => Input::get('order_id'),
                'game_id'    => Input::get('game_id'),
                'game_title' => Input::get('game_title'),
                'server'     => Input::get('server'),
                'pay'        => Input::get('pay'),
                'pay_method' => Input::get('pay_method'),
            ],
            [
                'order_id'   => 'required',
                'game_id'    => 'required|integer',
                'game_title' => 'required',
                'server'     => 'required',
                'pay'        => 'required',
                'pay_method' => 'required',
            ]
        );
        if($validator->fails()) {
            $resData['status']  = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $resData['status']  = 1;
        $resData['message'] = '充值记录保存成功';
        
        return $this->result($resData);
    }

}