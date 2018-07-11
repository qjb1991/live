<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-11
 * Time: 11:02
 */
namespace app\admin\controller;
use app\common\lib\Util;

class Image{
    public function index(){
        $file = request()->file('file');
        $info = $file->move('../public/static/upload');
        if ($info){
            $data = [
                'image' => config('live.host')."/upload/".$info->getSaveName(),
            ];
            return Util::show(config('code.success'), 'ok', $data);
        }else{
            return Util::show(config('code.image_error'),  'error');
        }
    }
}