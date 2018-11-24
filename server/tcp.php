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
    'reactor_num'   => 2,
    'worker_num'    => 4,
    'backlog'       => 128,
    'max_request'   => 50,
    'dispatch_mode' => 1,
    'max_conn'      => 2,
]);

//监听连接进入事件
$serv->on('connect', function ($serv, $fd, $reactor_id) {
    echo "Client: {$reactor_id} -- {$fd} Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: {$serv} \n Client: {$fd} \n ReactorId: {$from_id}".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: {$fd} Close.\n";
});

//启动服务器
$serv->start();