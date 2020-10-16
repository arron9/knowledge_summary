<?php
class HelloWorld
{
    function index()
    {
        echo "hello world";
    }
}

echo (new HelloWorld())->index();

/**
 * 生成签名
 * 用于调用开发商接口和用户中心接口
 */
function payEncrypt($params, $privateKey)
{
    $privateKey = 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAJ0SSTwauo51IRCCeGLd0Pf51b2kINSbDJJnF0YiEzbDu51mHMy6Ke58yBmlo4xnrUyUV6smFSkkKfCrnYYnMU8AjvBZyr6Eh8QQGLIoege45NIy847QxFo/G9rIJXwzTnADW7o28iRVUo0Wcf3+4JnQ9T5i/uAyiWG4QttrNqGhAgMBAAECgYBpqZ54f2aWZLb8ezhvEdb8qiWeMGYhf7hCWHVwqYWRZrS0WrfvBSEmHO0jS6ksz6XmCTi8mp7LkVdhXqFWWNEyzPYYlLP15z+sNvHVGEjhkOqtuSKKMfFpFgmpFZZPbrdUReKpBwqj6sgGjs/fG5RaG+zDDyFfJQ3M8uMb+NKBzQJBANOxwbS7YdJHsRfkpRzJDnZ7UgleYI6bx44eEdbHp3+BK/mjq+OCgLQFUEtxOTDcP8QdOOjaRmG8vndWXQ+kyNsCQQC98eur5C+NxO3ANYOWuiG3Q8VSQdRTxz8qSfrQraZP/eiXwc5QiOAWRa/RoD6Ui6Bfnn0bfcLZXtDJJ4rw8zozAkEAh54sK12UCIO3N0haYruHUW4lmyzkDNhNmoU3BnK3op6dDnvFRaY4T5vL2dj6O4wOKdRSvhH/3uNs3cTtL3Vw2wJAKNqv5fjegY+p032vH+xI9DIPbvHZyWtBmsbuu5OeAfaK4Jk+1vOZvzCd8GiXDTw68lYUcqVKE5bhMWLf75NhIQJAVvbuuy15qemFdorzrD08o6H53eRRkPZ/9NYMvE7323LpElXHEFO/3Lwyn5Dh2H1ErW36atQFN6lrI/uXXQv+/w==';
    if (!$params || !is_array($params) || !$privateKey) {
        return false;
    }
    $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".$privateKey."\n-----END RSA PRIVATE KEY-----";
    ksort($params);
    $query1 = [];
    foreach ($params as $key => $value)
    {
        if ($key == "sign") {
            continue;
        }
        array_push($query1, $key . "=" . ($value));
    }
    $string = join("&", $query1);
    $r = openssl_sign($string, $sign, $privateKey, "SHA256");
    openssl_free_key($privateKey);
    return base64_encode($sign);
}


/**
 * 解密签名
 * 用于调用开发商接口和用户中心接口
 */
 function payDecrypt($params, $publicKey)
{
    $publicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCdEkk8GrqOdSEQgnhi3dD3+dW9pCDUmwySZxdGIhM2w7udZhzMuinufMgZpaOMZ61MlFerJhUpJCnwq52GJzFPAI7wWcq+hIfEEBiyKHoHuOTSMvOO0MRaPxvayCV8M05wA1u6NvIkVVKNFnH9/uCZ0PU+Yv7gMolhuELbazahoQIDAQAB';
    if (!$params || !is_array($params) || !$publicKey) {
        return false;
    }
    $publicKey = "-----BEGIN PUBLIC KEY-----\n".$publicKey."\n-----END PUBLIC KEY-----";
    ksort($params);
    $query1 = [];
    $sign = "";
    foreach ($params as $key => $value)
    {
        if ($key == "sign") {
            $sign = base64_decode($value);
            continue;
        }
        if(strlen($value) == 0) {
            continue;
        }
        array_push($query1, $key . "=" . $value);
    }
    $queryString = join("&", $query1);
    $result = (bool)openssl_verify($queryString, $sign, $publicKey, "SHA256");
    openssl_free_key($publicKey);
    return $result;
}


$params = [
    "a" => "1213",
    "b" => "erer",
    "c" => "2ewerw",
];

$sign = payEncrypt($params, "");

 $params = [
    "a" => "1213",
    "b" => "erer",
    "c" => "2ewerw",
    "sign" => "ZKaPKMsQt1jNl+ilFdiXB3dR/o1I0M3aTLU0uosNBzuDkka3+ZE/VaOv6y9deKa4z0LVkYdRpYzKi6hFudPWj0gzDenfW/T3fmGhWC646dcGW99/mDCHDDsb2fYySyAB+cIbiHR1U95HkSXGsX7c/Hj2LDcxRloY1mR3Z2cxWg4="
];

$aa = payDecrypt($params, "");
var_dump($aa);exit;

function quickSort($data)
{
    if (count($data) <= 1) {
        return $data;
    }

    $mid = $data[0];
    $leftArray = [];
    $rightArray = [];
    foreach($data as $val) {
        if ($val > $mid) {
            $rightArray[] = $val;
        } else if ($val < $mid) {
            $leftArray[] = $val;
        }
    }

    $leftArray=quickSort($leftArray);
    $leftArray[] = $mid;
    $rightArray = quickSort($rightArray);

    return array_merge($leftArray, $rightArray);
}

function binSearch($data, $target, $left, $right)
{
    if ($left >= $right) {
        return false;
    }

    $midIndex = ceil(($left + $right)/2);
    if ($target == $data[$midIndex]) {
        return true;
    } else if($target > $data[$midIndex]) {
        $left = $midIndex + 1;
    } else {
        $right = $midIndex - 1;
    }

    return binSearch($data, $target, $left, $right);
}

$a = [2,1,6,7,9,34,454];
$b = quickSort($a);

$a = binSearch($b, 7, 0, count($b) - 1);
var_dump($a);

function factorial($n) {
    if ($n == 1) {
        return 1;
    }

    return $n * factorial($n - 1);
}


function longestPalindrome($str)
{
    $len = strlen($str) - 1;
    $mideLen = round($len/2);
    for ($i = 0; $i < $mideLen; $i++) {
        if ($str[$i] !== $str[$len - $i]) {
            return false;
        }
    }

    return true;
}

$c = factorial(4);
$d = longestPalindrome('abcba');

$a1 = ['a' => 1, 'b' => 2];
$b2 = ['a' => 5, 'c'=>3];
$g = $a1 + $b2;
var_dump($g);
var_dump(array_merge($a1, $b2));

$e = "aaa";
$b = "bbbb";
var_dump($a);

$a = [];
$a[] = &$a;
echo($a[0][0]);


