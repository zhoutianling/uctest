<?php
$salt = md5('salt');
$uuid = 'abcdefg12345';
$uriArr = [
    '/user/signin',
    '/user/create',
    '/user/info',
    '/user/avatar',
    '/user/update',
    '/trades',
    '/user/pwd',
    '/sms/send',
    '/sms/check',
    '/feedbacks',
    '/feedbacks/1',
    '/feedbacks/create',
    '/trades/create',
    ];
foreach($uriArr as $uri) {
    $serverSign = md5($salt . $uri . $uuid . $salt);
    echo $uri . '=>' . $serverSign . '<br />';
}
/*/user/signin=>22c13d550954c35213a3166cc0d155ff
/user/create=>7898330387966bc07666d750debec8e5
/user/info=>919491e35b1b201ecab6cdda275ac301
/user/avatar=>de2aba87c3534f0d986db2fe6d2fd8c6
/user/update=>bc996461e8e72a576d4fd3b5129b8d11
/trades=>80557ab1d12f57ae6c0d0ea3ebb5a49a
/user/pwd=>b33970dd154abd1c26c7e2212d1ff5db
/sms/send=>ffb253019aaa23cca6a933407ae6dc81
/sms/check=>cc6a47cd18a146b56d1e965de521bc2b
/feedbacks=>5c47c600e2a6b17e0bc27a67e91b5149
/feedbacks/1=>788cce3f7e0c65dbf23afaef2a625751
/feedbacks/create=>d3e248e92b36f7cbf85ecd6757509aa1
/trades/create=>74848b8ba1e8de6a3f7712590ad9e961*/
var_dump(extension_loaded("msgpack"));
var_dump(function_exists("msgpack_pack"));
var_dump(function_exists("msgpack_unpack"));
var_dump(function_exists("msgpack_serialize"));
var_dump(function_exists("msgpack_unserialize"));
msgpack_pack($uriArr);