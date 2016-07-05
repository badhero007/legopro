<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/7/5
 * Time: 16:44
 */

namespace console\controllers;


use common\core\Helper;
use yii\console\Controller;

class NewtestController extends Controller {
    public function actionTest(){
        echo 1;
    }

    public function actionHandleimg(){
        $path = \Yii::$app->getBasePath().'/../';
        $imgname = $path.'/frontend/web/img/1.jpg';
        $im = @\imagecreatefrompng($imgname);
        Helper::resizeImage($im,329,452,$path.'/frontend/web/img/th_1','jpg');
    }
} 