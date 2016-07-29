<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/7
 * Time: 11:29
 */

namespace console\controllers;


use yii\console\Controller;

class SeaslogController extends Controller {

    public function actionSeaslogtest(){

        $basePath_1 = \SeasLog::getBasePath();

        var_dump($basePath_1);exit();

        \SeasLog::log(SEASLOG_ERROR,'this is a error test by ::log');

        \SeasLog::debug('this is a {userName} debug',array('{userName}' => 'neeke'));

        \SeasLog::info('this is a info log');

        \SeasLog::notice('this is a notice log');

        \SeasLog::warning('your {website} was down,please {action} it ASAP!',array('{website}' => 'github.com','{action}' => 'rboot'));

        \SeasLog::error('a error log');

        \SeasLog::critical('some thing was critical');

        \SeasLog::alert('yes this is a {messageName}',array('{messageName}' => 'alertMSG'));

        \SeasLog::emergency('Just now, the house next door was completely burnt out! {note}',array('{note}' => 'it`s a joke'));
        echo "\n";
    }
} 