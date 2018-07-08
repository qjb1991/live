<?php
class Http{
    const HOST = '0.0.0.0';
    const PORT = 9501;
    public $http = null;
    public function __construct(){
        $this->http = new swoole_http_server(self::HOST, self::PORT);

        $this->http->set([
            'enable_static_handler' =>  true,
            'document_root' =>  "/var/www/html/live/public/static/",
            'worker_num'    =>  5,
            'task_worker_num'   =>  4,
        ]);

        $this->http->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->http->on('request', [$this, 'onRequest']);
        $this->http->on('task', [$this, 'onTask']);
        $this->http->on('finish', [$this, 'onFinish']);
        $this->http->on('close', [$this, 'onClose']);

        $this->http->start();
    }

    public function onWorkerStart(swoole_server $server,$worker_id){
        // 定义应用目录
        define('APP_PATH', __DIR__ . '/../application/');
        // 1. 加载基础文件
        require __DIR__ . '/../thinkphp/base.php';
    }

    public function onRequest($request, $response){
        $_SERVER = [];
        if (isset($request->server)){
            foreach ($request->server as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        if (isset($request->header)){
            foreach ($request->header as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        $_GET = [];
        if (isset($request->get)){
            foreach ($request->get as $k => $v){
                $_GET[$k] = $v;
            }
        }
        $_POST = [];
        if (isset($request->post)){
            foreach ($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }
        $_POST['http_server'] = $this->http;

        ob_start();
        // 2. 执行应用
        try{
            think\App::run()->send();
        }catch (\Exception $e){
            //todo
        }
        $res = ob_get_contents();
        ob_end_clean();

        $response->end($res);
    }

    public function onTask($serv, $taskId, $workerId, $data){

        $obj = new app\common\lib\task\Task;
        $method = $data['method'];
        $flag = $obj->$method[$data['data']];
        // try{
        //     $obj = new app\common\lib\ali\Sms;
        //     $response = $obj::sendSms($data['mobile'], $data['code']);
        // } catch (\Exception $e){
        //     echo $e->getMessage();
        // }
        // print_r($response);
        return "on task finish";
    }

    public function onFinish($serv, $taskId, $data){
        echo "taskId:{$taskId}\n";
        echo "finish-data-success:{$data}\n";
    }

    public function onClose($ws, $fd){
        echo "clientid:{$fd}\n";
    }
}

new Http();