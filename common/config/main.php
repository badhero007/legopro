<?php
if(defined('YII_DEBUG') && YII_DEBUG) {
    $gearmanConfig = require(__DIR__ . '/gearman.php');
} else {
    $gearmanConfig = require(__DIR__ . '/gearman.php');
}
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

        'gearman' => $gearmanConfig,

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.exmail.qq.com',
                'username' => 'export@louli.com.cn',
                'password' => 'LLdatamail123',
                'port' => '25',
                'encryption' => '', //tls or ssl
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
