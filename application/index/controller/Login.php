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
        $phoneNum = $request->param('phone_num');
        $code = $request->param('code');
        if (empty($phoneNum) || empty($code)) {
            return Util::show(config('code.val_empty'),'mobile or code is empty');
        }

        //获取redis中的code
        $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));
        echo $redisCode;
    }
}