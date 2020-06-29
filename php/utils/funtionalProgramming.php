<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/5/25 0025
 * Time: 上午 9:58
 */

function cal($a, $b, $cal) {
    return $cal($a, $b);
}

function sum($a, $b) {
    return $a + $b;
}

function dec($a, $b) {
    return $a - $b;
}

$cal = 'dec';
$cal = Closure::bind(function ($a, $b) {
    return $a*1 + $b*2;
}, null);
$aa = cal(1,2, $cal);
var_dump($aa);

function getCounter() {
    $n = 1;
    $inner = function ()use(&$n) {
        return ++$n;
    };

    return $inner;
}

$f = getCounter();
$aa = $f();
var_dump($f);
var_dump($aa);
$bb= $f();
var_dump($f);
var_dump($bb);
$cc= $f();
var_dump($f);
var_dump($cc);



