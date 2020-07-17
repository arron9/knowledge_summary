<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/16 0016
 * Time: 下午 1:24
 */

namespace App\Swoole;
use Swoole\Coroutine as Co;

class Coroutine
{
    public function createCo()
    {
        Co\run(function(){
            $chan = new \Swoole\Coroutine\Channel(1);
            \Swoole\Coroutine::create(function () use ($chan) {
                for($i = 0; $i < 100000; $i++) {
                    co::sleep(1.0);
                    $chan->push(['rand' => rand(1000, 9999), 'index' => $i]);
                    echo "$i\n";
                }
            });
            \Swoole\Coroutine::create(function () use ($chan) {
                while(1) {
                    $data = $chan->pop();
                    var_dump($data);
                }
            });
        });
    }

}
