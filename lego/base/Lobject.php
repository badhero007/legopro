<?php
namespace louli\base;
class Lobject
{
    public static function className()
    {
        return get_called_class();
    }
    //--单例模式Start
    private static $instance;
    public static function getInstance(){
        $class = str_replace('\\','_',get_called_class());
        if(empty(self::$instance[$class])){
            self::$instance[$class] = new $class();
        }
        return self::$instance[$class];
    }
    private function __construct() { }
    public function __clone() { throw new \Exception('Clone is not allowed !'); }
    //--单例模式End



}