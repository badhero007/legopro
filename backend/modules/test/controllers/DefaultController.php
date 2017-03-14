<?php

namespace backend\modules\test\controllers;

use lego\extend\GeetestLib;
use yii\helpers\Json;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $this->layout='@app/views/layouts/newmain.php';
        return $this->render('test');
    }

    public function actionGt()
    {
        return $this->render('gt');
    }

    public function actionStartcaptcha()
    {
        $GtSdk = new GeetestLib();
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }

    public function actionVerify(){
        $GtSdk = new GeetestLib();
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if ($result) {
                echo 'Yes!';
            } else{
                echo 'No';
            }
        }else{
            if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                echo "yes";
            }else{
                echo "no";
            }
        }
    }

    public function actionBdmap(){
        return $this->render('bdmap');
    }

    public function actionGetplaces(){
        $data = [
            ['long'=>116.567646,'lat'=>39.853166,'name'=>'富力又一城','point'=>10],
            ['long'=>116.549873,'lat'=>39.968263,'name'=>'奥利匹克花园','point'=>4],
        ];

        echo Json::encode($data);
    }
}
