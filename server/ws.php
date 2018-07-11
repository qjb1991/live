<?php
class Ws{
    const HOST = '0.0.0.0';
    const PORT = 9501;
    public $ws = null;
    public function __construct(){
        $this->ws = new swoole_websocket_server(self::HOST, self::PORT);

        $this->ws->set([
            'enable_static_handler' =>  true,
            'document_root' =>  "/var/www/html/live/public/static/",
            'worker_num'    =>  5,
            'task_worker_num'   =>  4,
        ]);

        $this->ws->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->ws->on('request', [$this, 'onRequest']);
        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('task', [$this, 'onTask']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->on('close', [$this, 'onClose']);

        $this->ws->start();
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
        $_FILES = [];
        if (isset($request->files)){
            foreach ($request->files as $k => $v){
                $_FILES[$k] = $v;
            }
        }
        $_POST = [];
        if (isset($request->post)){
            foreach ($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }
        $_POST['http_server'] = $this->ws;

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
        $flag = $obj->$method($data['data']);
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

    public function onOpen($ws, $request){
        var_dump($request->fd);
    }

    public function onMessage($ws, $frame){
        echo "ser-push-message:{$frame->data}\n";
        $ws->push($frame-fd, "server-push:".date('Y-m-d H:i:s'));
    }

    public function onClose($ws, $fd){
        echo "clientid:{$fd}\n";
    }

}

new ws();