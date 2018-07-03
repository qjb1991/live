<?php
namespace app\index\controller;

use app\common\lib\ali\Sms;

class Index
{
    public function index()
    {
        print_r($_GET);
        echo 'bibo-1aaaaaa';
    }

    public function bibo(){
        echo time();
    }

    public function sms(){
        try{
            $re = Sms::sendSms(17620822665, 1234);
            var_dump($re);
        }catch (\Exception $e){
            //todo
        }
    }
}
