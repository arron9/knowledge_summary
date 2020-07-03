<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/2 0002
 * Time: 上午 9:39
 */

$redisConn = new Redis();

$host = "127.0.0.1";
$port = 6379;
$timeout = 5;
$success = $redisConn->connect($host, $port, $timeout);

$lockTimeout = time() + 10;
$resVal = $redisConn->setnx("lockA", $lockTimeout);
if ($resVal) {
    echo "11 我获取到锁了";
}

while (true) {
    $lockTimeout = time() + 3;
    $resVal = $redisConn->setnx("lockA", $lockTimeout);
    if ($resVal || time() > $redisConn->get("lockA")) {
        echo "22 我获取到锁了";
        $redisConn->del("lockA");
        break;
    } else {
        echo "等待3秒";
        sleep(3);
    }
}



