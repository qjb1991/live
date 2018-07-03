<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-03
 * Time: 15:22
 */
namespace app\common\lib;

class Redis{
    /**
     * 验证码 redis key 前缀
     * @var string
     */
    public static $pre = 'sms_';

    /**
     * 存储验证码 redis key
     * @param $mobile
     * @return string
     */
    public static function smsKey($mobile){
        return self::$pre.$mobile;
    }
}