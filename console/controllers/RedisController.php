<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/6
 * Time: 10:58
 */

namespace console\controllers;


use common\core\Redis;
use yii\console\Controller;

class RedisController extends Controller {
    public function actionRedistest(){
        $redis = Redis::getInstance();
        $redis->set('testkey','1');
        $value = $redis->get('testkey');
        var_dump($value);
    }
} 