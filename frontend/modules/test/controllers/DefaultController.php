<?php

namespace frontend\modules\test\controllers;

use app\models\DianpingBeijing;
use frontend\modules\test\logic\DefaultLogic;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest(){
        $logic = new DefaultLogic();
        $logic->testLogic();
    }
}
