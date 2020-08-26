<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/8/26 0026
 * Time: 上午 11:01
 */

require_once dirname(__DIR__) . '/bootstrap.php';

class Client
{
    public function testLinkedList()
    {
        $linked = new \App\Algorithmic\LinkedList\LinkedList(1);
        $linked->insert(2);
        $linked->insert(3);
        $linked->insert(4);
        $linked->insert(5);

        $linked->print();
    }
}

$client = new Client();
$client->testLinkedList();

