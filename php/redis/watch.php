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

echo $redisConn->get("lockB");
$redisConn->watch("lockA");
$redisConn->set("lockA", time());
$redisConn->multi();
$redisConn->set("lockB", "122211");
$redisConn->exec();
$redisConn->unwatch();

echo $redisConn->get("lockB");

$aa = $redisConn->eval("redis.call('set', 'lua_key', 'test1'); return redis.call('get', 'lua_key')");
var_dump($aa);exit;


