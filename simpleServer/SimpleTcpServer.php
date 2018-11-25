<?php

class SimpleTcpServer{

	//swoole服务
	private $_serv;
	
	//配置项
	private $_config = [];
	
	//初始化方法 回调函数初始化
	public function __construct(){	
		//实例化
		$this->_serv = new Swoole_Server('127.0.0.1',9501);

		//加载配置
		$this->_serv->set($this->_config);

		//封装回调函数连接swoole
		$this->onConnect();

		//封装回调函数接收信息
		$this->onReceive();

		//封装回调函数，关闭服务
		//$this->onClose();
	}

	//连接服务
	public function onConnect(){
		$this->_serv->on('connect',function($serv,$fd,$reactor_id){
			echo "Client： $fd has connected\n";
		});
	}

	//服务端接收数据
	public function onReceive(){
		$this->_serv->on('receive',function(swoole_server $serv,$fd,$reactor_id,$data){
			echo "Client: $data\n";
		});
	}

	//关闭服务
	public function onClose(){
		$this->_serv->close('close',function(swoole_server $serv,$fd){
			echo "Client: $fd has closed\n";
		});
	}

	//启动服务
	public function start(){
		$this->_serv->start();
	}

}


$serv = new SimpleTcpServer();
$serv->start();
//var_dump($serv);
