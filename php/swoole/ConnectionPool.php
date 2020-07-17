<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/17 0017
 * Time: 上午 10:02
 */
declare(strict_types=1);

namespace App\Swoole;

use Swoole\Coroutine;
use Swoole\Database\RedisConfig;
use Swoole\Database\RedisPool;
use Swoole\Runtime;

class ConnectionPool
{
    const N = 1024;

    public function run()
    {

        Runtime::enableCoroutine();
        $s = microtime(true);
        Coroutine\run(function () {
            $pool = new RedisPool((new RedisConfig)
                ->withHost('127.0.0.1')
                ->withPort(6379)
                ->withAuth('')
                ->withDbIndex(0)
                ->withTimeout(1)
            );
            for ($n = self::N; $n--;) {
                Coroutine::create(function () use ($pool) {
                    $redis = $pool->get();
                    $result = $redis->set('foo', 'bar');
                    if (!$result) {
                        throw new RuntimeException('Set failed');
                    }
                    $result = $redis->get('foo');
                    if ($result !== 'bar') {
                        throw new RuntimeException('Get failed');
                    }
                    echo $result;
                    echo "\n";
                    $pool->put($redis);
                });
            }
        });
        $s = microtime(true) - $s;
        echo 'Use ' . $s . 's for ' . (self::N * 2) . ' queries' . PHP_EOL;
    }


}
