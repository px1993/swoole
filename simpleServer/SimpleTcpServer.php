<?php

include 'SimpleServer.php';

class SimpleTcpServer extends SimpleServer{
	public function __construct($host,$port){
		//初始化
	    parent::__construct($host,$port);

        //加载配置
        $this->_serv->set($this->_config);

        //封装回调函数连接swoole
        $this->onConnect();

        //封装回调函数接收信息
        $this->onReceive();

        //封装回调函数，关闭服务
        //$this->onClose();
	}
}
