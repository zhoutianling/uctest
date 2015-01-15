<?php

return [
    'token' => md5('token'), // 94a08da1fecbb6e8b46990538c7b50b2
    'salt'  => md5('salt'), //ceb20772e0c9d240c75eb26b0e37abee
    'uuid'  => 'abcdefg12345',
    'smsCode' => '123456',
    'resetCode' => 'asdasdasdasdasdasdasdasd',
    'user' => [
        'id' => 1,
        'mobile' => '13712341234',
        'email' => 'litian@ltbl.cn',
        'password' => '123456',
    ],
    'user_baseinfo' => [
        'id' => 1,
        'mobile' => '15712341234',
        'email' => 'litian@ltbl.cn',
        'nickname' => 'hahaha',
        'avatar' => 'img/qqq.jpg',
        'sex' => 'male',
        'birthday' => '2002-10-10',
        'address' => '广东省深圳市',
    ],
    'amounts_list' => [
        'list' => [
            [
                'id' => 1,
                'order_id' => 20092211,
                'pay' => 500.00,
                'spend' => 500.00,
                'platform_received_at' => '2015-1-1 00:00:00',
                'game_received_at' => '2015-1-1 00:00:00',
                'pay_method' => '支付宝'
            ],
            [
                'id' => 2,
                'order_id' => 20092212,
                'pay' => 600.00,
                'spend' => 600.00,
                'platform_received_at' => '2015-1-1 00:00:00',
                'game_received_at' => '2015-1-1 00:00:00',
                'pay_method' => '支付宝'
            ],
            [
                'id' => 3,
                'order_id' => 20092213,
                'pay' => 700.00,
                'spend' => 700.00,
                'platform_received_at' => '2015-1-1 00:00:00',
                'game_received_at' => '2015-1-1 00:00:00',
                'pay_method' => '支付宝'
            ],
            [
                'id' => 4,
                'order_id' => 20092214,
                'pay' => 500.00,
                'spend' => 500.00,
                'platform_received_at' => '2015-1-1 00:00:00',
                'game_received_at' => '2015-1-1 00:00:00',
                'pay_method' => '支付宝'
            ],
            [
                'id' => 5,
                'order_id' => 20092215,
                'pay' => 300.00,
                'spend' => 300.00,
                'platform_received_at' => '2015-1-1 00:00:00',
                'game_received_at' => '2015-1-1 00:00:00',
                'pay_method' => '支付宝'
            ],
        ],
        'total_page' => 1,
    ],
    'feedback_list' => [
        'list' => [
            [
                'id' => 1,
                'content' => '我的充值没到账诶1！',
                'status' => 'over',
                'readed' => 'true',
                'updated_at' => '2015-1-1 00:00:00',
            ],
            [
                'id' => 2,
                'content' => '我的充值没到账诶2！',
                'status' => 'over',
                'readed' => 'true',
                'updated_at' => '2015-1-1 00:00:00',
            ],
            [
                'id' => 3,
                'content' => '我的充值没到账诶3！',
                'status' => 'over',
                'readed' => 'true',
                'updated_at' => '2015-1-1 00:00:00',
            ],
        ],
        'total_page' => 1,
    ],
    'feedback_detail' => [
        'list' => [
            [
                'user_id' => 166,
                'content' => '我的充值没到账诶！',
                'created_at' => '2015-1-12 00:08:00',
            ],
            [
                'user_id' => '',
                'content' => '真的没到账吗？',
                'created_at' => '2015-1-12 00:09:00',
            ],
            [
                'user_id' => 166,
                'content' => '恩！是的！',
                'created_at' => '2015-1-12 00:10:00',
            ],
            [
                'user_id' => '',
                'content' => '哦',
                'created_at' => '2015-1-12 00:12:00',
            ],
        ],
        'total_page' => 1,
    ],
];