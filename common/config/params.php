<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'm15201218196@163.com',
    'user.passwordResetTokenExpire' => 3600,
    'mongodb' => [
        'common' => [
            'host' => '127.0.0.1',
            'port' => '27017',
            'connect' => true,
            'timeout' => 1000,
            'username' => 'lego',
            'password' => '021271',
        ],
    ],

    //---------------
    'redisConfig' => [ //redis 服务器连接参数配置  //正式线偶数，测试线基数
        'common' => [
            'ip' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 3,
            'db' => 0,
            'pass' => '021271'
        ],
        'cache' => [
            'ip' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 3,
            'db' => 0,
            'pass' => '021271'
        ],
        'list' => [
            'ip' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 3,
            'db' => 1,
            'pass' => '021271'
        ],
    ],
];
