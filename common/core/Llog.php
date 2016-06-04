<?php
namespace common\core;
use yii\helpers\FileHelper;
use yii\helpers\Json;

class Llog
{
    /**
     * @param $msg
     * @param string $dir
     * @param bool $json
     * @return bool
     * @throws \yii\base\Exception
     */
    public static function log($msg, $dir = '', $json = false)
    {
        $path = \Yii::$app->getRuntimePath() . DS . 'logs' . DS;
        if($dir != '') {
            $path = $path . $dir . DS;
            FileHelper::createDirectory($path, 0777);
        }
        $file = $path . date("Y-m-d") . '.log';
        if(!file_exists($file)) { //文件不存在 则创建文件 并开放权限
            @touch($file); @chmod($file,0777);
        }
        if(is_array($msg)) {
            $msg = $json ? Json::encode($msg) : implode(' | ',$msg);
        }
        $msg = date('H:i:s | ') . $msg . PHP_EOL;
        return error_log($msg, 3, $file);
    }

    public static function debug($msg)
    {
        if(defined('YII_DEBUG') && YII_DEBUG)
            return self::log($msg,'debug',true);
        else
            return null;
    }

    public static function exception(\Exception $e,$data = [],$dir='')
    {
        $dir = ($dir ? 'exception/'.$dir : 'exception');
        self::log([$e->getFile(),$e->getLine(),$e->getMessage(),$e->getTraceAsString(),json_encode($data)],$dir);
    }

    //旧方法迁移
    public static function logErrorParam($controller,$action,$params,$msg = '',$pdir='')
    { //少必要参数
        self::log([$controller,$action,json_encode($params),$msg], ($pdir ? "$pdir/" : '') . 'errorParam');
    }
    public static function logInsertError($msg,$errors,$data,$pdir='')
    { //添加数据异常
        self::log([$msg,json_encode($errors),json_encode($data)], ($pdir ? "$pdir/" : '') . 'insertError');
    }
    public static function logUpdateError($msg,$errors,$data,$pdir='')
    { //更新数据异常
        self::log([$msg,json_encode($errors),json_encode($data)], ($pdir ? "$pdir/" : '') . 'updateError');
    }
    public static function logException($controller,$action,$e,$params=[],$pdir='')
    { //逻辑异常
        self::log([$controller,$action,$e->getMessage(),$e->getFile(),$e->getLine(),$e->getTraceAsString(),json_encode($params)], ($pdir ? "$pdir/" : '') . 'actionError');
    }



}