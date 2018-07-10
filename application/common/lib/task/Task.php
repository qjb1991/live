<?php
/**
 * swoole中所有异步任务
 */
namespace app\common\lib\task;
use app\common\lib\ali\Sms;

class Task{
    public function sendSms($data){
        try{
            $response = Sms::sendSms($data['mobile'], $data['code']);
        } catch (\Exception $e){
            echo $e->getMessage();
        }
        print_r($response);

        if ($response->Code === 'OK'){

        }
    }
}
