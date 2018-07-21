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
        $clients = Predis::getInstance()->sMembers(config("redis.live_game_key"));
        print_r($clients);
        // if(empty($_GET)){
        //     return Util::show(config('code.error'), 'error');
        // }
        // $teams = [
        //     1   =>  [
        //         'name'  =>  '马刺',
        //         'logo'  =>  '/live/imgs/team1.png',
        //     ],
        //     4   =>  [
        //         'name'  =>  '火箭',
        //         'logo'  =>  '/live/imgs/team2.png',
        //     ],
        // ];

        // $data = [
        //     'type'  =>  intval($_GET['type']),
        //     'title' =>  !empty($teams[$_GET['team_id']]['name']) ? $teams[$_GET['team_id']]['name'] : '直播员',
        //     'logo'  =>  !empty($teams[$_GET['team_id']]['logo']) ? $teams[$_GET['team_id']]['logo'] : '',
        //     'content'   =>  !empty($_GET['content']) ? $_GET['content'] : '',
        //     'image' =>  !empty($_GET['image']) ? $_GET['image'] : '',
        // ];
        // $clients = Predis::getInstance()->sMembers(config("redis.live_game_key"));
        $_POST['http_server']->push(8, 'hello-push');
    }
}