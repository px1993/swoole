<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 21:05
 */

include 'simpleServer/SimpleTcpServer.php';


$config = [
	'worker_num'  => 4,
	'max_request' => 10000,
];

$serv = new SimpleTcpServer('127.0.0.1',9501,$config);

$serv->onStart();

//$serv->onClose;

//var_dump($serv);


//$data = $serv->receive();

//var_dump($data);


