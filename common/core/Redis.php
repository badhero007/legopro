<?php
namespace common\core;

class Redis
{
    public static $instance;

    /**
     * @param string $config
     * @return \Redis
     */
    public static function getInstance($config='cache')
    {
        if(empty(self::$instance[$config])) new self($config);
        return self::$instance[$config];
    }

    public function __construct($config='cache')
    {
        if(!empty(self::$instance[$config])) {
            return self::$instance[$config];
        }

        if(defined("YII_DEBUG") && YII_DEBUG) { //非生产环境不使用ali kv store
            self::$instance[$config] = RedisBase::getInstance();
            return self::$instance[$config];
        }

        self::$instance[$config] = RedisBase::getInstance($config);
        return self::$instance[$config];

        $host = '127.0.0.1';
        $port = 6379;
//        $auth = '412c55b0c79711e4:REDISlouli2015';
        $timeOut = 2; //超时时间  N second(s)

        $redis = new \Redis();
        if ($redis->connect($host, $port, $timeOut)) {
//            if($redis->auth($auth)) {
                $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);
                self::$instance[$config] = $redis;
//            } else {
//                throw new \Exception("Jedis Auth Failed");
//            }
        } else {
            throw new \Exception("Jedis Connect Failed");
        }
        return $redis;
    }

}