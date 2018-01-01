<?php
function curPageURL() 
{
  $pageURL = 'http';
 
  if ($_SERVER["HTTPS"] == "on") 
  {
    $pageURL .= "s";
  }
  $pageURL .= "://";
 
  if ($_SERVER["SERVER_PORT"] != "80") 
  {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
  } 
  else
  {
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}

function redirect($url, $time = 0, $msg = '') {  
    $url = str_replace(array("\n", "\r"), '', $url); // 多行URL地址支持  
    if (empty($msg)) {  
        $msg = "系统将在 {$time}秒 之后自动跳转到 {$url} ！";  
    }  
    if (headers_sent()) {  
        $str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";  
        if ($time != 0) {  
            $str .= $msg;  
        }  
        exit($str);  
    } else {  
        if (0 === $time) {  
            header("Location: " . $url);  
        } else {  
            header("Content-type: text/html; charset=utf-8");  
            header("refresh:{$time};url={$url}");  
            echo($msg);  
        }  
        exit();  
    }  
}; 
// echo 'hello';
// $curUrl=curPageURL();
// // 在应用启动之前跳转至 auth.qiliuxiansheng.com 去获取用户相对于某一个公众号的openid
// $url = "http://auth.qiliuxiansheng.com/get-weixin-code.html?appid=59624ac501a7dad98815f48e3d0b0869&scope=snsapi_base&state=hello-world&redirect_uri=".$curUrl;
// redirect($url);
// // 在这里做的话，会限制整个应用，即整个frontend 都必须在微信的环境下打开

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
// echo 'hello';

