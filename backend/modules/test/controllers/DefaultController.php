<?php

namespace backend\modules\test\controllers;

//use lego\job\BaseJobHanlder;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $this->layout='@app/views/layouts/newmain.php';
//        return $this->render('index');
        return $this->render('test');
    }
}
