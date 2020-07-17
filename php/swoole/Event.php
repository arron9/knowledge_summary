<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/14 0014
 * Time: 下午 6:23
 */
namespace App\Swoole;

class Event extends SwooleBase
{
    public function run()
    {
        $fp = stream_socket_client("tcp://www.qq.com:80", $errno, $errstr, 30);

        \Swoole\Event::add($fp, function($fp) {
            $resp = fread($fp, 8192);
            echo $resp;
            echo "\n";
            //\Swoole\Event::del($fp);
            //fclose($fp);
        }, null, SWOOLE_EVENT_READ);

        var_dump(\Swoole\Event::isset($fp, SWOOLE_EVENT_READ)); //返回 true
        var_dump(\Swoole\Event::isset($fp, SWOOLE_EVENT_WRITE)); //返回 false
        var_dump(\Swoole\Event::isset($fp, SWOOLE_EVENT_READ | SWOOLE_EVENT_WRITE)); //返回 true

        \Swoole\Timer::tick(1000, function ()use($fp) {
            echo "hello\n";
            fwrite($fp,"GET / HTTP/1.1\r\nHost: www.qq.com\r\n\r\n");
        });

        \Swoole\Event::wait();
    }
}

