<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/8/7 0007
 * Time: 上午 9:56
 */

    require_once dirname(__DIR__) . '/bootstrap.php';

    /**
     * Writer写数据，Protobuf抽象成调用相关set函数即可
     */
    $foo = new \Protobuf\Prots\MailConfig();

    $foo->setTo("George");
    $foo->setFrom("John");
    $foo->setMsg("Don't forget the meeting!");
    $packed = $foo->serializeToString();//这里你也可以选择serializeToJsonString序列化成JSON
    //Reader读数据，Protobuf抽象成调用相关get函数即可
    $res = new \Protobuf\Prots\MailConfig();
    $res->mergeFromString($packed);
    $jsonArr = [
        "to"=> $res->getTo(),
        "from"=> $res->getFrom(),
        "msg"=> $res->getMsg(),
    ];
    var_dump($jsonArr);
