<?php
class BinTree{
    public $data;
    public $left;
    public $right;
}

//前序遍历生成二叉树
function createBinTree($items) {
    $e = array_shift($items);
    if ($e =="#") {
        $binTree=null;
    } else {
        $binTree=new BinTree();
        $binTree->data = $e;
        $binTree->left=createBinTree($items);
        $binTree->right=createBinTree($items);
    }

    return $binTree;
}

$items[] = [1, 2, 4, 8, 5, 3, 7];
$tree=createBinTree($items);

var_dump($tree);
