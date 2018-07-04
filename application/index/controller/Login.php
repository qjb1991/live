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
       $phoneNum = intval($_GET['phone_num']);
       $code = intval($_GET['code']);
       if (empty($phoneNum) || empty($code)) {
           return Util::show(config('code.val_empty'),'mobile or code is empty');
       }

       //获取redis中的code
       try{
           $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));
       } catch (\Exception $e){
           echo $e->getMessage();
       }
       if($redisCode == $code){
           $data = [
               'user'   =>  $phoneNum,
               'srcKey' =>  md5(Redis::userkey($phoneNum)),
               'time'   =>  time(),
               'isLogin'    =>  true,
           ];
           Predis::getInstance()->set(Redis::userkey($phoneNum),$data);

           return Util::show(config('code.success'), 'ok', $data);
       }else{
           return Util::show(config('code.login_error'), 'login error');
       }

    }
}