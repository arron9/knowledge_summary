<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/5/25 0025
 * Time: 上午 9:38
 */

class annotation
{
    /**
     * 列表及搜索
     * @funcName  院所管理-院所列表
     */
    public function index()
    {
        echo "annotation";
    }

    public function getAnnotationVal()
    {
        $m = new ReflectionMethod($this, "index");
        //方法注释
        $note = $m->getDocComment();
        //取指定标签 funcName 的值
        preg_match('/@funcName\s*([^\s]*)/i', $note, $matches);
        return $matches;
    }
}

$anno = (new annotation())->getAnnotationVal();
var_dump($anno);exit;
