<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/2 0002
 * Time: 下午 6:19
 */
require_once __DIR__ . '/vendor/autoload.php';

function autoload($className)
{
    echo $className;
    echo "\n";
    $className = ltrim($className, '\\');
    $fileName  = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

spl_autoload_register('autoload');
