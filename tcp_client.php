<?php

include 'simpleClient/SimpleClient.php';

$client = new SimpleClient(SWOOLE_SOCK_TCP);

if (!$client->checkConnect()){
    var_dump('服务器连接失败！');
    exit;
}

$client->sendMessage();

$msg = $client->getMessage();

var_dump($msg);

