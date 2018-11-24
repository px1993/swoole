<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 21:05
 */

//namespace Swoole;

//use Swoole\Server\TcpServer;

include 'server/Server.php';
include 'server/TcpServer.php';

$serv = new \Swoole\Server\TcpServer('0.0.0.0',9501);
$serv->start();

var_dump($serv);
