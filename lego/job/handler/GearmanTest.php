<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/10
 * Time: 16:30
 */
namespace lego\job\handler;

use common\core\Llog;
use common\core\Redis;
use shakura\yii2\gearman\JobBase;

class GearmanTest extends JobBase {
    public function execute(\GearmanJob $job = null){
        $loader = $this->getWorkload($job);
        $params = $loader->getParams();
        $redis = Redis::getInstance();
        $redis->set('geartest',$params);
    }
} 