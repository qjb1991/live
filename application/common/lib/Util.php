<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-03
 * Time: 11:49
 */
namespace app\common\lib;
class Util{
    /**
     * API输出格式
     * @param $status
     * @param string $message
     * @param array $data
     */
    public static function show($status, $message = '', $data = []){
        $result = [
            'status'    =>  $status,
            'message'   =>  $message,
            'data'      =>  $data
        ];

        echo json_encode($result);
    }
}