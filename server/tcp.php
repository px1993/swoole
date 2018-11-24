<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 18:58
 */

//创建Server对象，监听 127.0.0.1:9501端口
$server = new swoole_server("127.0.0.1", 9501);

$server->set([
    'worker_num'    => 4,
    'max_request'   => 50,
    'dispatch_mode' => 1,
]);

//监听连接进入事件
$server->on('connect', function ($serv, $fd, $reactor_id) {
    echo "Client: {$reactor_id} -- {$fd} Connect.\n";
});

//监听数据接收事件
$server->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Client: {$from_id} -- {$fd} \n".$data);
});

//监听连接关闭事件
$server->on('close', function ($serv, $fd) {
    echo "Server: Client: {$fd} Close.\n";
});

//启动服务器
$server->start();