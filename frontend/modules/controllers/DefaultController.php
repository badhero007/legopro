<?php

namespace frontend\modules\controllers;

use app\models\User;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $model = new User();

        if($data = \Yii::$app->getRequest()->post()) {

            $model->setAttributes($data['User']);
            $model->updated_at = time();
            $model->created_at = time();
            $model->auth_key = 'nWLhrHeDQk1VmxVeWx_7mxMwup_SnlNi';
            $model->password_hash = md5($model->password_hash);



            if ($model->validate()) {

                if($_FILES){
                    if (isset($_FILES["User"]) && is_uploaded_file($_FILES["User"]["tmp_name"]["logo"]) && $_FILES["User"]["error"]["logo"] == 0) {

                        $upload_file = $_FILES['User'];

                        //上传文件信息
                        $file_info   = pathinfo($upload_file['name']['logo']);

                        //后缀名
                        $file_type   = $file_info['extension'];

                        //上传路径
                        $path = \Yii::$app->getRuntimePath().'/logs/upload';
                        if (!is_dir($path)) {
                            @mkdir($path);
                            @chmod($path,0777);
                        }

                        //日志文件
                        $logfile = $path.'/upload.log';
                        if (!file_exists($logfile)) {
                            @touch($logfile);
                            @chmod($logfile,0777);
                        }

                        $newfilename = $randname = date('ymdhis').'.'.$file_type;
                        $newfileloc = $path.'/'.$newfilename;
                        $name = $upload_file['tmp_name']['logo'];

                        if (!move_uploaded_file($name, $newfileloc)) {
                            $msg = '文件上传失败，错误信息：'.$upload_file['error']['logo'];
                            var_dump($upload_file['error']['logo']);
                        }else{
                            $msg = '上传文件：'.$randname.'|'.($upload_file['size']['logo']/1024).'kb';
                            $model->logo= $newfileloc;
                        }

                        //打开文件
                        $fd = fopen($logfile,"a");
                        //增加文件
                        $str = "[".date("Y/m/d H:i:s",time())."]".$msg;
                        //写入字符串
                        fwrite($fd, $str."\r\n");
                        //关闭文件
                        fclose($fd);
                    }
                }

                if(!$model->save()){
                    var_dump($model->getErrors());
                }

            } else {
                $errors = $model->errors;
                var_dump($errors);
                exit();
            }
        }


        return $this->render('index',['model'=>$model]);
    }
}
