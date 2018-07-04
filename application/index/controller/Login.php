<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-03
 * Time: 17:29
 */
namespace app\index\controller;

use app\common\lib\Util;
use app\common\lib\Redis;
use think\Request;
use app\common\lib\redis\Predis;

class Login{
    public function index(Request $request){
        var_dump($request->param());
        echo "<br>";
        var_dump($request->get());
        echo "<br>";
        var_dump($request->input());
        echo "<br>";
        var_dump($_GET);
//        $phoneNum = $request->param('phone_num');
//        $code = $request->param('code');
//        echo $phoneNum.PHP_EOL;
//        echo $code.PHP_EOL;
//        if (empty($phoneNum) || empty($code)) {
//            return Util::show(config('code.val_empty'),'mobile or code is empty');
//        }
//
//        //获取redis中的code
//        try{
//            $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));
//        } catch (\Exception $e){
//            echo $e->getMessage();
//        }
//        echo 'a'.$redisCode;

    }
}