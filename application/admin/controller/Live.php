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
        print_r($_GET);

        $_POST['http_server']->push(8, 'hello-push');
    }
}