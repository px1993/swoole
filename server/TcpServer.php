<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 21:01
 */
namespace Swoole\Server;

class TcpServer extends Server{

    public function __construct($host,$port)
    {
        parent::__construct($host,$port);

        $this->server->set([
            'worker_num'    => 4,
            'max_request'   => 50,
            'dispatch_mode' => 1,
        ]);
        $this->onConnect();
        $this->onReceive();
        $this->onClose();
    }
}

$serv = new TcpServer('127.0.0.1',9501);

$serv->start();
