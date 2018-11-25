<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 21:05
 */

include 'simpleServer/SimpleTcpServer.php';


$serv = new SimpleTcpServer('127.0.0.1',9501);

var_dump($serv);

//$serv->start();
