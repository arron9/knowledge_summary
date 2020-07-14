<?php
class BinTree{
    public $data;
    public $left;
    public $right;
}

//前序遍历生成二叉树
function createBinTree(){
    $handle=fopen("php://stdin","r");
    $e=trim(fgets($handle));
    if($e=="#"){
        $binTree=null;
    }else{
        echo "e";
        $binTree=new BinTree();
        $binTree->data = $e;
        $binTree->left=createBinTree();
        $binTree->right=createBinTree();
    }

    return $binTree;
}

$tree=createBinTree();

var_dump($tree);
