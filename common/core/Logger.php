<?php
namespace common\core;

use Psr\Log\LoggerInterface;
/**
 * Class JLogger
 * @package vendor\jeen
 */
class Logger implements LoggerInterface
{

//    const SEASLOG_DEBUG = "debug";
//    const SEASLOG_INFO = "info";
//    const SEASLOG_NOTICE = "notice";
//    const SEASLOG_WARNING = "warning";
//    const SEASLOG_ERROR = "error";
//    const SEASLOG_CRITICAL = "critical";
//    const SEASLOG_ALERT = "alert";
//    const SEASLOG_EMERGENCY = "emergency";

    private $log_path = '/data/log/jlog';
    private $log_dir = 'default';

    public function __construct($path = '', $dir = '')
    {
        $this->log_path = $path ? : \Yii::$app->getRuntimePath() . '/logs/';
        $this->log_dir = $dir ? : 'jlogger';
    }

    private function legolog($level, $message, array $content = [], $module = '')
    {
        $path = $this->log_path . DS . ($module ? : $this->log_dir) . DS;
        LegoFile::createDirectory($path, 0777); //目录不存在 则创建目录 并开放权限

        $file = $path . $level . date("_Y-m-d") . '.log';
        LegoFile::touchFile($file, 0777);//文件不存在 则创建文件 并开放权限

        if ($content) {
            $message = str_replace(array_keys($content),$content,$message);
        }
        $msg =  $level
            . ' | ' . posix_getpid()
            . ' | ' . microtime(true)
            . date(' | Y-m-d H:i:s | ')
            . $message
            . PHP_EOL;
        return error_log($msg, 3, $file);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function log($level,$message,array $content = [],$module = '')
    {
        return self::legolog($level,$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function debug($message,array $content = [],$module = '')
    {
        return self::legolog('debug',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function info($message,array $content = [],$module = '')
    {
        return self::legolog('info',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function notice($message,array $content = [],$module = '')
    {
        return self::legolog('notice',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function warning($message,array $content = [],$module = '')
    {
        return self::legolog('warning',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function error($message,array $content = [],$module = '')
    {
        return self::legolog('error',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function critical($message,array $content = [],$module = '')
    {
        return self::legolog('critical',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function alert($message,array $content = [],$module = '')
    {
        return self::legolog('alert',$message,$content,$module);
    }

    /**
     * @param string $message
     * @param array $content
     * @param string $module
     * @return bool|null
     */
    public function emergency($message,array $content = [],$module = '')
    {
        return self::legolog('emergency',$message,$content,$module);
    }

    /**
     * 设置basePath
     * @param string $path
     * @return bool
     */
    public function setBasePath($path)
    {
        $this->log_path = $path;
        return true;
    }

    /**
     * 获取basePath
     * @return string
     */
    public function getBasePath()
    {
        return $this->log_path;
    }

    /**
     * 设置模块目录
     * @param string $module
     * @return bool
     */
    public function setLogger($module)
    {
        $this->log_dir = $module;
        return true;
    }

    /**
     * 获取最后一次设置的模块目录
     * @return string
     */
    public function getLastLogger()
    {
        return $this->log_dir;
    }

}