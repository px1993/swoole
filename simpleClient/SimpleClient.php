<?php

class SimpleClient{

	//客户端对象
	protected $_client;

	//客户端模式
	protected $_sock_type;

	public function __construct(int $sock_type, int $is_sync = SWOOLE_SOCK_SYNC){
		
		$this->_sock_type = $sock_type;

		//实例化swool客户端，单例模式
		if(null === $this->_client){				
			$this->_client = new swoole_client($this->_sock_type);		
		}

	}

	//检查客户端是否连接成功
	public function checkConnect($host,$port){
		if(!$this->_client->connect($host, $port, -1)){
			return false;
		}
		return true;
	}

	//获取服务端的消息
	public function getMessage(){
		$msg = $this->_client->recv();
		return $msg;
	}

	//发送消息到服务端
	public function sendMessage(){
		fwrite(STDOUT,'请输入要发送的消息:');
		$msg = trim(fgets(STDIN));
		$this->_client->send($msg);
	}
	
	//关闭客户端
	public function close(){
		$this->_client->close();
	}

}


