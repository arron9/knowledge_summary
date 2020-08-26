<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/8/26 0026
 * Time: 上午 11:01
 */

namespace App\Algorithmic\LinkedList;

use App\Algorithmic\LinkedList\Node;

class LinkedList
{
    /**
     * @var \App\Algorithmic\LinkedList\Node
     */
    public $head;

    /**
     * @var \App\Algorithmic\LinkedList\Node
     */
    public $tail;

    public function __construct($data)
    {
        $node = new \App\Algorithmic\LinkedList\Node($data);
        $this->head = $this->tail = $node;
    }

    public function insert($data)
    {
        $currentNode = $this->tail;
        $node = new \App\Algorithmic\LinkedList\Node($data);
        $currentNode->setNext($node);
        $this->tail = $node;
    }

    public function print()
    {
        echo "<pre>";
        var_export($this->head);
        echo "</pre>";
        exit;
        $currentNode = $this->head;
        $data = [];
        do {
            $data[] =  $currentNode->getData();
            $currentNode = $currentNode->getNext();
        } while($currentNode != null);

        echo json_encode($data);
    }
}
