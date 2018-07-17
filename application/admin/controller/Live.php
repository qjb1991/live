<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-11
 * Time: 11:02
 */
namespace app\admin\controller;
use app\common\lib\Util;

class Live{
    public function push(){
        if(empty($_GET)){
            return Util::show(config('code.error'), 'error');
        }
        $teams = [
            1   =>  [
                'name'  =>  '马刺',
                'logo'  =>  '/live/imgs/team1.png',
            ],
            4   =>  [
                'name'  =>  '火箭',
                'logo'  =>  '/live/imgs/team2.png',
            ],
        ];

        $data = 
        $_POST['http_server']->push(8, 'hello-push');
    }
}