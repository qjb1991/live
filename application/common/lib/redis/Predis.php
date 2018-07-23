<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-03
 * Time: 17:32
 */
namespace app\common\lib\redis;
class Predis{
    public $redis = "";
    /**
     * 单例模式
     * @var null
     */
    private static $_instance = null;

    public static function getInstance(){
        if (empty(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->redis = new \Redis();
        $result = $this->redis->connect('127.0.0.1', 6379, 120);
        if ($result === false){
            throw new \Exception('redis connect error');
        }
    }

    /**
     * 设置redis
     * @param $key
     * @param $value
     * @param int $time
     * @return bool|string
     */
    public function set($key, $value, $time = 0){
        if (!$key){
            return '';
        }
        if (is_array($value)){
            $value = json_encode($value);
        }
        if (!$time){
            return $this->redis->set($key, $value);
        }

        return $this->redis->setex($key, $time, $value);
    }

    /**
     * get
     * @param $key
     */
    public function get($key){
        if (!$key){
            return '';
        }

        return $this->redis->get($key);
    }

    public function sAdd($key, $value){
        return $this->redis->sAdd($key, $value);
    }

    public function sRem($key, $value){
        return $this->redis->sRem($key, $value);
    }

    public function sMembers($key){
        return $this->redis->sMembers($key);
    }

    // public function __call($name, $arguments){
    //     if(count($arguments) != 2){
    //         return '';
    //     }
    //     return $this->redis->$name($arguments[0], $arguments[1]);
    // }
}