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

        self::$server->set([
            'worker_num'    => 4,
            'max_request'   => 50,
            'dispatch_mode' => 1,
        ]);
        parent::onConnect();
        parent::onReceive();
        parent::onClose();
    }
}