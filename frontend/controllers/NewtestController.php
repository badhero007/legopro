<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/7/6
 * Time: 14:30
 */

namespace frontend\controllers;


use yii\web\Controller;

class NewtestController extends Controller {
    public function actionGif(){
        if(function_exists("imagegif")){
//            // Create a new image instance
//            $im = imagecreatetruecolor(100, 100);
//            // Make the background white
//            imagefilledrectangle($im, 0, 0, 99, 99, 0xFFFFFF);
//            // Draw a text string on the image
//            imagestring($im, 3, 40, 20, 'GD Library', 0xFFBA00);
//            header("Content-type: image/gif");
//            imagegif($im);
            return $this->render('gif');
        }
    }

    public function actionTest(){
        
    }
} 