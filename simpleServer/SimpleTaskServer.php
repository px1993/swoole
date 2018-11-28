<?php

include 'SimpleServer.php';

class SimpleTaskServer extends SimpleServer{
	
	public function __construct(string $host,int $port,array $config = []){
		//初始化父类
		parent::__construct($host,$port);
		
		//设置初始化配置
		$this->_config = $config;
		
		//设置
		$this->setConfig();

		//接收消息加入队列
		$this->onReceive();

		//队列消费
		$this->onTask();

		//队列消费完成返回
		$this->onFinish();
	}

}

$config = [
	'worker_num'      => 4,
	'task_worker_num' => 8,
	'open_task'       => 1, 
];
$taskServer = new SimpleTaskServer('127.0.0.1',9501,$config);

//var_dump($taskServer);
$taskServer->onStart();
//var_dump($taskServer);

