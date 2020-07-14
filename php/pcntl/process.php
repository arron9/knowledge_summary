<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/9 0009
 * Time: 下午 5:34
 */

$pid = pcntl_fork();
switch ($pid) {
    case -1:
        // fatal error 致命错误 所有进程crash掉
        break;

    case 0:
        // worker context
        echo "我是 子进程";
        exit; // 这里exit掉，避免worker继续执行下面的代码而造成一些问题
        break;

    default:
        // master context
        pcntl_wait($status); // pcntl_wait会阻塞，例如直到一个子进程exit
        // 或者 pcntl_waitpid($pid, $status, WNOHANG); // WNOHANG:即使没有子进程exit，也会立即返回
    echo "我是 父类";
        break;
}


