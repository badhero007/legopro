<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/10
 * Time: 16:43
 */

namespace console\controllers;


use common\models\dianping\DianpingBeijing;
use lego\job\BaseJobHanlder;
use yii\console\Controller;

class GearmantestController extends Controller {
    public function actionTest(){
        $jobHandler = new BaseJobHanlder();
        $jobParams = [
            'params' => 'params',
            'user' => 'user',
            'community' => 'community'
        ];

        $jobHandler->background('GearmanTest',$jobParams);
    }

    public function actionDianping(){
        $i = 0;

        DianpingBeijing::find()->where('phone <> “无”')->limit(1)->offset($i)->one();
    }


} 