<?php

class SimpleServer{

	//swoole服务
	protected $_serv;
	
	//客户端标识
	protected $_fd;

	//设置
	protected $_config;
	
	//初始化方法 回调函数初始化
	public function __construct(string $host,int $port = 0, int $mode = SWOOLE_PROCESS, int $sock_type = SWOOLE_SOCK_TCP){	
		//实例化,单例模式
		if(null === $this->_serv){
			$this->_serv = new Swoole_Server($host,$port,$mode,$sock_type);
		}
	}

	//初始化设置
	public function setConfig(){
		$this->_serv->set($this->_config);
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
			if($this->_config['open_task']){
        			// send a task to task worker.
        			$this->task($serv,$fd,$data);
			}else{
				//同步消息
				echo "Client：$fd 请求的数据为：$data".PHP_EOL;
				$this->_serv->send($fd,'服务端返回的数据为:Hello'.$data."\n");
			}
		});
	}

	//设置task
	public function task($serv,$fd,$data){
		$params = [
			'fd'   => $fd,
			'data' => $data,
		];
		$serv->task(json_encode($params));
	}

	//开启异步队列
	public function onTask() {
		$this->_serv->on('task',function($serv,$task_id,$from_id, $data){		
			$fd = json_decode($data,true);
    			$serv->send($fd['fd'],"返回数据".$fd['data']);
		});
	}

	//异步队列结束
	public function onFinish() {
		$this->_serv->on('finish',function($serv,$task_id, $data){
			echo "Task {$task_id} finish\n";
        		echo "Result: {$data}\n";
		});
		
	}

	//关闭服务
	public function onClose(){
		$this->_serv->close('close',function(swoole_server $serv,$fd){
			echo "Client: $fd has closed\n";
		});
	}

	//启动服务
	public function onStart(){
		$this->_serv->start();
	}

}

