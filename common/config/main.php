<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mydb',
            'username' => 'lego',
            'password' => '021271',
            'charset' => 'utf8',
        ],
        'dianping' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=bakdianping',
            'username' => 'lego',
            'password' => '021271',
            'charset' => 'utf8',
        ],
        'base'=>[
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=base',
            'username' => 'lego',
            'password' => '021271',
            'charset' => 'utf8',
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
    'modules' => [
        'test' => [
            'class' => 'backend\modules\test\Module',
        ],
    ],
];
