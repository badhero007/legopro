<?php
$gearmanConfig = require(__DIR__ . '/gearman.php');

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'true',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mydb',
            'username' => 'root',
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
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => 'm15201218196@163.com',
                'password' => '021271asd',
                'port' => '465',
                'encryption' => 'ssl', //tls or ssl

            ],
        ],
        'urlManager' => array(
            'enablePrettyUrl' => true,
            'showScriptName' => false, //隐藏index.php
            'rules' => array(),
        ),
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
