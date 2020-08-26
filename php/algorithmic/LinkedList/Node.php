<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/8/26 0026
 * Time: 上午 11:01
 */

namespace App\Algorithmic\LinkedList;

class Node
{
    private $data;
    private $next = null;

    public function __construct($data, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return null
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param null $next
     */
    public function setNext($next): void
    {
        $this->next = $next;
    }
}
