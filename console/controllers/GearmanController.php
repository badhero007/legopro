<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/10
 * Time: 16:43
 */

namespace console\controllers;


use lego\job\BaseJobHanlder;
use yii\console\Controller;

class GearmanController extends Controller {
    public function actionTest(){
        $jobHandler = new BaseJobHanlder();
        $jobParams = [
            'params' => 'params',
            'user' => 'user',
            'community' => 'community'
        ];

        $jobHandler->background('GearmanTest',$jobParams);
    }
} 