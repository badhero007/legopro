<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mydb',
            'username' => 'root',
            'password' => '021271',
            'charset' => 'utf8',
        ],
        'dianping' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=bakdianping',
            'username' => 'root',
            'password' => '021271',
            'charset' => 'utf8',
        ],
        'base'=>[
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=base',
            'username' => 'root',
            'password' => '021271',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'gearman' => [
            'class' => 'shakura\yii2\gearman\GearmanComponent',
            'servers' => [
                'main'=>['host' => '127.0.0.1', 'port' => 4730],
                'slave'=>['host' => '', 'port' => 0],
            ],
            'user' => 'root', //测试线配置
            'jobs' => [
                'GearmanTest' => [
                    'class' => 'lego\job\handler\GearmanTest'
                ],
                //... other test jobs
            ],
        ],

    ],
    'controllerMap' => [
        'gearman' => [
            'class' => 'shakura\yii2\gearman\GearmanController',
            'gearmanComponent' => 'gearman'
        ],
    ],
];
