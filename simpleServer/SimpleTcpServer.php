<?php

include 'SimpleServer.php';

class SimpleTcpServer extends SimpleServer{
	public function __construct($host,$port){
		parent::__construct($host,$port);
	}
}


$serv = new SimpleTcpServer('127.0.0.1',9501);
//var_dump($serv);

$serv->start();
