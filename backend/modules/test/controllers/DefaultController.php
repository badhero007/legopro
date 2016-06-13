<?php

namespace backend\modules\test\controllers;

use lego\job\BaseJobHanlder;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $jobHandler = new BaseJobHanlder();
        $jobParams = [
            'params' => 'params',
            'user' => 'user',
            'community' => 'community'
        ];

        $jobHandler->background('GearmanTest',$jobParams);
//        return $this->render('index');
    }
}
