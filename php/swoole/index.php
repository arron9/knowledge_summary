<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/16 0016
 * Time: 下午 1:25
 */
require_once dirname(__DIR__) . '/bootstrap.php';

/*$event = new App\Swoole\Event();
$event->run();*/


/*go(function (){
    $redisPool = new App\Swoole\RedisPool();
    echo $redisPool->getPool();
    $redisCon = $redisPool->get();
    echo "\n";
    $redisCon->set("test11", "123131");
    echo $redisCon->get("test11");
    echo "\n";
    echo $redisPool->getPool();
    $redisPool->put($redisCon);
    echo "\n";
    echo $redisPool->getPool();
});*/

/*$connectionPool = new \App\Swoole\ConnectionPool();
$connectionPool->run();*/

/*$websocketServer = new \App\Swoole\WebSocketServer();
$websocketServer->run();*/


$task = new \App\Swoole\Task();
$task->run();




