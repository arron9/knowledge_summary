<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/13 0013
 * Time: 下午 7:25
 */
namespace App\Tests;
use App\Openssl\OpensslClass;

class OpensslTest extends BaseTest {
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }

    public function testSign()
    {
        $dn = array(
            "countryName" => 'XX', //所在国家名称
            "stateOrProvinceName" => 'State', //所在省份名称
            "localityName" => 'SomewhereCity', //所在城市名称
            "organizationName" => 'MySelf', //注册人姓名
            "organizationalUnitName" => 'Whatever', //组织名称
            "commonName" => 'mySelf', //公共名称
            "emailAddress" => 'user@domain.com' //邮箱
        );

        require_once dirname(__DIR__) . "/openssl/opensslClass.php";
        $test = new OpensslClass($dn);
        $str = '这是一个验证签名测试文本';
        $test->getCertificate();
        $signtext = $test->sign($str);
        //echo '加密信息 :'.$signtext;
        //echo '<br/>';
        $result = $test->verify($str,$signtext);
        $this->assertEquals(1, $result);
    }
}


