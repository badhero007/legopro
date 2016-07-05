<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/7/5
 * Time: 14:47
 */

namespace console\controllers;


use common\core\Helper;

class TestController {
    public function actionHandleimg(){
        $path = \Yii::$app->getBasePath().'/../';
        $imgname = $path.'/frontend/web/img/1.jpg';
        $im = @\imagecreatefrompng($imgname);
        Helper::resizeImage($im,329,452,$path.'/frontend/web/img/th_1','jpg');
    }
} 