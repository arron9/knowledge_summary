<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/2 0002
 * Time: 下午 6:25
 */

use Finite\StatefulInterface;

class Document implements StatefulInterface
{
    private $state;
    public function setFiniteState($state)
    {
        $this->state = $state;
    }

    public function getFiniteState()
    {
        return $this->state;
    }
}
