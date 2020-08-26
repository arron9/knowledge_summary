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

    public function testBinaryTree()
    {
        $tree= new \App\Algorithmic\BinaryTree\BinaryTree(55);
        $tree->insert(23);
        $tree->insert(45);
        $tree->insert(16);
        $tree->insert(37);
        $tree->insert(3);
        $tree->insert(99);
        $tree->insert(22);

        $tree->print();

        $tree->preOrder($tree->getRoot());
    }
}

$client = new Client();
//$client->testLinkedList();
$client->testBinaryTree();

