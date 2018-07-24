<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-11
 * Time: 11:02
 */
namespace app\admin\controller;
use app\common\lib\Util;
use app\common\lib\redis\Predis;

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

        $data = [
            'type'  =>  intval($_GET['type']),
            'title' =>  !empty($teams[$_GET['team_id']]['name']) ? $teams[$_GET['team_id']]['name'] : '直播员',
            'logo'  =>  !empty($teams[$_GET['team_id']]['logo']) ? $teams[$_GET['team_id']]['logo'] : '',
            'content'   =>  !empty($_GET['content']) ? $_GET['content'] : '',
            'image' =>  !empty($_GET['image']) ? $_GET['image'] : '',
        ];
        //方式一
        // $clients = Predis::getInstance()->sMembers(config("redis.live_game_key"));
        // foreach($clients as $fd){
        //     $_POST['http_server']->push($fd, json_encode($data));
        // }
        //方式二
        $taskData = [
            'method'    =>  'pushLive',
            'data'  =>  $data
        ];
        $_POST['http_server']->task($taskData);
        return Util::show(config('code.success', 'ok'));
    }
}