<?php
namespace app\index\controller;

use app\common\lib\ali\Sms;
use app\common\lib\Util;
use app\common\lib\Redis;
use think\Request;

class Send
{
    public function index(Request $request){
        $mobile =  $request->param('phone_num', 0);
        if (empty($mobile)){
            return Util::show(config('code.empty_phone_num'), 'error');
        }

        $code = rand(1000, 9999);
        //todo 验证手机号格式  code.wrong_number

//        try{
//            $response = Sms::sendSms($mobile, $code);
//        } catch (\Exception $e){
//            return Util::show(config('code.faile_send_message'), '短信服务内部异常');
//        }

//        if ($response->Code === 'OK'){

            $redis = new \Swoole\Coroutine\Redis();
            $redis->connect(config('redis.host'), config('redis.port'));
            $redis->set(Redis::smsKey($mobile), $code, config('redis.expire'));

            return Util::show(config('code.success'), 'success');
//        }else{
//            return Util::show(config('code.fail_send_msg'), '验证码发送失败');
//        }
    }
}
