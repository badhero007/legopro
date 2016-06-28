<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/10
 * Time: 16:30
 */
namespace lego\job\handler;

use common\core\Llog;
use shakura\yii2\gearman\JobBase;

class GearmanTest extends JobBase {
    public function execute(\GearmanJob $job = null){
        $loader = $this->getWorkload($job);
        $params = $loader->getParams();
        Llog::log('test','test');
        var_dump($params);
    }
} 