<?php

include 'SimpleServer.php';

class SimpleTcpServer extends SimpleServer{
	//tcpServer
	protected $_serv;	

	public function __construct(string $host,int $port,array $config = []){

		parent::__construct($host,$port);		

		$this->_config = $config;
		
		//加载配置
		$this->setConfig();
		
		//封装回调函数连接swoole
        	$this->onConnect();

        	//封装回调函数接收信息
		$this->onReceive();
	
	        //封装回调函数，关闭服务
        	//$this->onClose();

	}

	//重构receive方法
//	public function receive(){
//		$returnData = $this->onReceive();
//		if(!$returnData || !is_array($returnData)){
//			echo '服务器接收数据出错！';
//			exit;
//		}
//	  	return $returnData;
//	}
}
