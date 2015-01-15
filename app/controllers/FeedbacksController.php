<?php

class FeedbacksController extends \BaseController {

    /**
     * 我的反馈
     *
     * @return Response
     **/
    public function index()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'page' => Input::get('page')
            ],
            [
                'page' => 'required|integer'
            ]
        );
        if($validator->fails()) {
            $resData['code']    = 300;
            $resData['message'] = '请求参数格式错误';
            return $this->result($resData);
        }

        $resData['data'] = Config::get('const.feedback_list');
        
        return $this->result($resData);
    }

    /**
     * 我的反馈详情(包括客服回复和用户回复)
     *
     * @return Response
     **/
    public function detail($feedback_id)
    {
        $resData = [];

        $validator = Validator::make(
            [
                'page' => Input::get('page')
            ],
            [
                'page' => 'required|integer'
            ]
        );
        if($validator->fails()) {
            $resData['code']    = 300;
            $resData['message'] = '请求参数格式错误';
            return $this->result($resData);
        }

        $resData['data'] = Config::get('const.feedback_detail');

        return $this->result($resData);
    }

    /**
     * 提交反馈
     *
     * @return Response
     **/
    public function create()
    {
        $resData = [];

        $validator = Validator::make(
            [
                'content' => Input::get('content'),
                'type'    => Input::get('type'),
                'cat'     => Input::get('cat'),
                'email'   => Input::get('email'),
                'mobile'  => Input::get('mobile'),
            ],
            [
                'content' => 'required',
                'type'    => 'required',
                'cat'     => 'required',
                'email'   => 'required',
                'mobile'  => 'required',
            ]
        );
        if($validator->fails()) {
            $resData['code']    = 300;
            $resData['message'] = '请求参数格式错误';

            return $this->result($resData);
        }

        $resData['code']    = 1;
        $resData['message'] = '反馈提交成功';
        
        return $this->result($resData);
    }

}