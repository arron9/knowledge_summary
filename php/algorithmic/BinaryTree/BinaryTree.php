<?php
namespace App\Algorithmic\BinaryTree;

class BinaryTree {
    private $root;

    public function __construct($root = null)
    {
        $this->root = new TreeNode($root);
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function insert($data)
    {
        $node = new TreeNode($data);
        if ($this->root->getData() == null) {
            $this->root = $node;
        } else {
            $current = $this->root;
            while (true) {
                $parent = $current;

                if ($data < $current->getData()) {
                    $current = $current->getLeft();
                    if ($current == null) {
                        $parent->setLeft($node);
                        break;
                    }
                } else {
                    $current = $current->getRight();
                    if ($current == null) {
                        $parent->setRight($node);
                        break;
                    }
                }
            }
        }
    }

    public function print()
    {
        echo "<pre>";
        var_export($this->root);
        echo "</pre>";
    }

    public function preOrder($node)
    {
        if ($node != null) {
            echo $node->getData();
            echo "</br>";
            $this->preOrder($node->getLeft());
            $this->preOrder($node->getRight());
        }
    }
}




