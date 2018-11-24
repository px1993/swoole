<?php
/**
 * Created by PhpStorm.
 * User: PX
 * Date: 2018/11/24
 * Time: 20:40
 */
namespace Swoole\Server;

class Server
{

    /**
     * swoole 服务器
     * @var swoole_server
     */
    protected $server;


    /**
     * Server constructor.
     * @param string $host
     * @param int $port
     * @param int $mode
     * @param int $sock_type
     */
    public function __construct(string $host, int $port = 0, int $mode = SWOOLE_PROCESS, int $sock_type = SWOOLE_SOCK_TCP)
    {
        /**
         * 单例模式
         */

	$this->server = new swoole_server('127.0.0.1', 9501);

    }

    /**
     * 连接
     * @return mixed
     */
    public function onConnect(){
        $this->server->on('connect', function ($serv, $fd, $reactor_id){
            return  "服务器已连接";
        });
    }

    /**
     * @return mixed
     */
    public function onReceive(){
       $this->server->on('receive', function (swoole_server $serv, $fd, $reactor_id, $data) {
            if ($this->server->send($fd, $data) == false)
            {
                return '服务连接失败！请重试！';
            }
            return $data;
        });
    }

    /**
     * @return mixed
     */
    public function onClose(){
        $this->server->on('close', function ($serv, $fd, $reactor_id) {
            return '服务已关闭';
        });

    }

    /**
     * @return mixed
     */
//    public function send(){
////        self::$server->on('receive', function (swoole_server $serv, $fd, $reactor_id, $data) {
////
////            if ($serv->send($fd, $data) == false)
////            {
////                return '服务连接失败！,请稍后重试';
////            }
////            return $data;
////        });
//    }

}
