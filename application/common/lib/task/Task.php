<?php
/**
 * swoole中所有异步任务
 */
namespace app\common\lib\task;
use app\common\lib\ali\Sms;
use app\common\lib\Redis;
use app\common\lib\redis\Predis;

class Task{
    public function sendSms($data){
        try{
            $response = Sms::sendSms($data['mobile'], $data['code']);
        } catch (\Exception $e){
            return false;
        }

        //发送成功则记录到redis里面
        if ($response->Code === 'OK'){
            Predis::getInstance()->set(Redis::smsKey($data['mobile']), $data['code'], 120);
        }
        return true;
    }
}
