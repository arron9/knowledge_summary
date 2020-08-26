<?php
namespace App\Algorithmic\BinaryTree;

class TreeNode {

    private $data;

    private  $left;

    private  $right;

    public function __construct($data,$left = null,$right = null)
    {

        $this->data = $data;
        $this->left = $left;
        $this->right = $right;

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
     * @return mixed
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param mixed $left
     */
    public function setLeft($left): void
    {
        $this->left = $left;
    }

    /**
     * @return mixed
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param mixed $right
     */
    public function setRight($right): void
    {
        $this->right = $right;
    }
}




