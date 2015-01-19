<?php

class BaseController extends Controller {

    /**
     * 返回结果
     *
     * @param $resData array 返回数据
     *
     * @return Response
     **/
    public function result(array $resData)
    {
        $res = [];

        $res['status'] = isset($resData['status']) ? $resData['status'] : 1;
        $res['message'] = isset($resData['message']) ? $resData['message'] : '请求成功';
        $res['data'] = isset($resData['data']) ? $resData['data'] : '';

        // $resJson = json_encode($res);

        // return $resJson;

        $resPack = msgpack_pack($res);

        return $resPack;
    }

}