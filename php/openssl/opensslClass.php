<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/13 0013
 * Time: 下午 7:11
 */
class OpensslClass {
    private $dn;
    private $privkeypass = '111111'; //私钥密码
    private $numberofdays = 365; //有效时长
    private $cerpath = "./test.cer"; //生成证书路径
    private $pfxpath = "./test.pfx"; //密钥文件路径
    private $prikeypath = "./key/privkey.pem"; //私钥文件
    private $pubkeypath = "./key/pubkey.key"; //公钥文件
    public function __construct(array $dn)
    {
        $this->dn = $dn;
    }
    /**
     * 对称加密
     * @param string 明文
     * @param string key
     * @param string 加密方式
     * @return array [密文, 伪随机字节串]
     */
    public function symmetric_encrypt($plaintext, $key, $cipher = 'aes-128-cbc')
    {
        if (in_array($cipher, openssl_get_cipher_methods()))//判断传递的加密算法是否在可用的加密算法的列表中
        {
            $ivlen = openssl_cipher_iv_length($cipher); //获取密码初始化向量(iv)长度
            $iv = openssl_random_pseudo_bytes($ivlen); //生成一个伪随机字节串 string ，字节数由 length 参数指定
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
            return [$ciphertext,$iv];
        } else {
            return '加密方式传递错误';
        }
    }
//对称解密
    /**
     * 对称解密
     * @param string $ciphertext 密文
     * @param string $key 密钥
     * @param string $iv 伪随机字节串
     * @param string $cipher 加密方式
     * @return string 明文
     */
    public function symmetric_decrypt($ciphertext, $key, $iv, $cipher = 'aes-128-cbc')
    {
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
            return $original_plaintext;
        } else {
            return '加密方式传递错误';
        }
    }
    /**
     * 获取私钥公钥
     * @param array $configargs 配置
     * @return bool [description]
     */
    public function getPrivateKeyAndPublicKey($configargs = array())
    {

        if (empty($configargs)) {
            $configargs = array(
                'private_key_bits' => 1024, // Size of Key.
                'private_key_type' => OPENSSL_KEYTYPE_RSA
            );
        }
//$res返回false的时候，检查发现，是window系统缺少了openssl环境变量，解决方法如下：
        $opensslConfigPath = "C:/phpStudy/PHPTutorial/Apache/conf/openssl.cnf"; //apache路径下的openssl.conf文件路径
        $res = openssl_pkey_new($configargs);////生成一个新的私钥 openssl_pkey_new ([ array $configargs ] ) configargs参数微调密钥的生成（比如private_key_bits 指定应该使用多少位来生成私钥）
        if(!$res) {
            //$configargs['config'] = $opensslConfigPath;
            $res = openssl_pkey_new($configargs);
        }
        openssl_pkey_export($res, $privKey, null, $configargs);//将一个密钥的可输出表示转换为字符串
        $file = fopen($this->prikeypath, 'w');
        fwrite($file, trim($privKey));
        fclose($file);
        $pubkey=openssl_pkey_get_details($res);
        $pubkey=$pubkey["key"];
        $file = fopen($this->pubkeypath, 'w');
        fwrite($file, trim($pubkey));
        fclose($file);
        return true;
    }
//非对称私钥加密
    public function asymmetric_private_encrypt($plaintext)
    {
        $pkey = openssl_pkey_get_private(file_get_contents($this->prikeypath));
        openssl_private_encrypt($plaintext,$crypttext,$pkey);
        $crypttext = base64_encode($crypttext);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $crypttext;
    }
//非对称公钥解密
    public function asymmetric_public_decrypt($crypttext)
    {
        $pubkey = file_get_contents($this->pubkeypath);
        $res = openssl_pkey_get_public($pubkey);
        openssl_public_decrypt(base64_decode($crypttext), $decrypttext, $res);
        return $decrypttext;
    }
//非对称公钥加密
    public function asymmetric_public_encrypt($plaintext)
    {
        $pkey = openssl_pkey_get_public(file_get_contents($this->pubkeypath));
        openssl_public_encrypt($plaintext,$crypttext,$pkey);
        $crypttext = base64_encode($crypttext);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $crypttext;
    }
//非对称私钥解密
    public function asymmetric_private_decrypt($crypttext)
    {
        $pubkey = file_get_contents($this->prikeypath);
        $res = openssl_pkey_get_private($pubkey);
        openssl_private_decrypt(base64_decode($crypttext), $decrypttext, $res);
        return $decrypttext;
    }
//证书生成
    public function getCertificate()
    {
        $configargs = array(
            //'config' => "C:/phpStudy/PHPTutorial/Apache/conf/openssl.cnf",
            'private_key_bits' => 1024, // Size of Key.
            'private_key_type' => OPENSSL_KEYTYPE_RSA
        );
//生成证书
        $privkey = openssl_pkey_new($configargs); //生成一个新的私钥 openssl_pkey_new ([ array $configargs ] ) configargs参数微调密钥的生成（比如private_key_bits 指定应该使用多少位来生成私钥）
        $csr = openssl_csr_new($this->dn, $privkey,$configargs); //根据dn提供的信息生成新的CSR（证书签名请求） privkey 应该被设置为由openssl_pkey_new()函数预先生成(或者以其他方式从openssl_pkey函数集中获得)的私钥。该密钥的相应公共部分将用于签署CSR.
        $sscert = openssl_csr_sign($csr, null, $privkey, $this->numberofdays,$configargs); //用另一个证书签署 CSR (或者本身) 并且生成一个证书 从给定的 CSR 生成一个x509证书资源
        openssl_x509_export($sscert, $csrkey); //导出证书$csrkey 将 x509 以PEM编码的格式导出到名为 output 的字符串类型的变量中 公钥证书 只有公钥
        openssl_pkcs12_export($sscert, $privatekey, $privkey, $this->privkeypass); //导出密钥$privatekey
//生成证书文件
        $fp = fopen($this->cerpath, "w");
        fwrite($fp, $csrkey);
        fclose($fp);
//生成密钥文件
        $fp = fopen($this->pfxpath, "w");
        fwrite($fp, $privatekey);
        fclose($fp);
        return true;
    }
    /**
     * 签名
     * @param string $data 明文
     * @return string 加密信息
     */
    public function sign($data)
    {
        $priv_key = file_get_contents($this->pfxpath); //获取密钥文件内容
//私钥加密
        openssl_pkcs12_read($priv_key, $certs, $this->privkeypass); //读取公钥、私钥
        $prikeyid = $certs['pkey']; //私钥
        openssl_sign($data, $signMsg, $prikeyid,OPENSSL_ALGO_SHA1); //注册生成加密信息
        $signMsg = base64_encode($signMsg); //base64转码加密信息 加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $signMsg;
    }
    /**
     * 公钥验证签名
     * @param string $data 明文
     * @param string $signMsg 加密信息
     * @return bool 是否验证通过
     */
    public function verify($data,$signMsg)
    {
        $priv_key = file_get_contents($this->pfxpath);
//公钥解密
        $unsignMsg=base64_decode($signMsg);//base64解码加密信息
        openssl_pkcs12_read($priv_key, $certs, $this->privkeypass); //读取公钥、私钥
        $pubkeyid = $certs['cert']; //公钥
        $res = openssl_verify($data, $unsignMsg, $pubkeyid); //验证
        return $res; //输出验证结果，1：验证成功，0：验证失败
    }
}

