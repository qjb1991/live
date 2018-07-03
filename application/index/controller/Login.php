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

class Login{
    public function index(Request $request){
        var_dump($request->param());
    }
}