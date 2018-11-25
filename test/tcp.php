<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 18:58
 */

//创建Server对象，监听 127.0.0.1:9501端口
$server = new swoole_server("127.0.0.1", 9501);

var_dump($server);exit;

//设置
$server->set([
    'worker_num'    => 4,
    'max_request'   => 50,
    'dispatch_mode' => 1,
]);

//监听连接进入事件
$server->on('connect', function ($serv, $fd, $reactor_id){
	echo "Server进程ID:".posix_getpid()." \tClient:$fd 进程ID:$reactor_id: Connect.\n";
});

//监听数据接收事件
$server->on('receive', function (swoole_server $serv, $fd, $reactor_id, $data) {
    echo "[#".$serv->worker_id."]\tClient[$fd] receive data: $data\n";
    if ($serv->send($fd, "hello {$data}\n") == false)
    {
        echo "error\n";
    }
});


//监听连接关闭事件
$server->on('close', function ($serv, $fd, $reactor_id) {
	echo "[#".posix_getpid()."]\tClient@[$fd:$reactor_id]: Close.\n";
});

//启动服务器
$server->start();
