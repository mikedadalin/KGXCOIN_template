<?php
session_start();
include("DB.php");
//阿里雲
//include_once 'aliyun-php-sdk-core/Config.php';
//use afs\Request\V20180112 as Afs;

// geetest 驗證
// 输出二次验证结果,本文件示例只是简单的输出 Yes or No
// error_reporting(0);
require_once 'gt3-php-sdk-master/lib/class.geetestlib.php';
require_once 'gt3-php-sdk-master/config/config.php';
$GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
$data = array(
    "client_type" => "unknown", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
    "ip_address" => $_SERVER["REMOTE_ADDR"] # 请在此处传输用户请求验证时所携带的IP
);


$inputNull = false;

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
    if ($_POST[$k] == '' || $_POST[$k] == null) { $inputNull = true; }
}

switch ($_POST['action']) {
    case 'signin':
        if (!$inputNull) {
            // geetest 驗證
            if ($_SESSION['gtserver'] == 1) {   //服务器正常
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                if ($result) {
                    $db = new DB;
                    $db->query("SELECT `userID`, `username`, `mail`, `phone`, `kgx_address` FROM `user` WHERE `username`='" . $_POST['account'] . "' AND `password`='" . md5(md5($_POST['pw'])) . "'");
                    if ($db->num_rows() > 0) {
                        $r                        = $db->fetch_assoc();
                        $_SESSION['userID']       = $r['userID'];
                        $_SESSION['username']     = $r['username'];
                        $_SESSION['mail']         = $r['mail'];
                        $_SESSION['phone']        = $r['phone'];
                        $_SESSION['kgx_address']  = $r['kgx_address'];
                        echo 'ok';
                    } else {
                        echo 'no';
                    }
                } else{
                    echo 'vno';
                }
            } else {  //服务器宕机,走failback模式
                if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                    $db = new DB;
                    $db->query("SELECT `userID`, `username`, `mail`, `phone`, `kgx_address` FROM `user` WHERE `username`='" . $_POST['account'] . "' AND `password`='" . md5(md5($_POST['pw'])) . "'");
                    if ($db->num_rows() > 0) {
                        $r                        = $db->fetch_assoc();
                        $_SESSION['userID']       = $r['userID'];
                        $_SESSION['username']     = $r['username'];
                        $_SESSION['mail']         = $r['mail'];
                        $_SESSION['phone']        = $r['phone'];
                        $_SESSION['kgx_address']  = $r['kgx_address'];
                        echo 'ok';
                    } else {
                        echo 'no';
                    }
                }else{
                    echo 'vno';
                }
            }
            /*
            if (!$_SESSION['ali_captcha']) {
                //阿里雲
                //YOUR ACCESS_KEY、YOUR ACCESS_SECRET请替换成您的阿里云accesskey id和secret
                $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "LTAI9HVMvodg9qZr", "qNB9TSjUB87uwoIN31vsd1LHx64KAa");
                $client = new DefaultAcsClient($iClientProfile);
                $iClientProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "afs", "afs.aliyuncs.com");
                
                $request = new Afs\AuthenticateSigRequest();
                $request->setSessionId($_POST['csessionid']);// 必填参数，从前端获取，不可更改
                $request->setToken($_POST['token']);// 必填参数，从前端获取，不可更改
                $request->setSig($_POST['sig']);// 必填参数，从前端获取，不可更改
                $request->setScene("nc_login");// 必填参数，从前端获取，不可更改
                $request->setAppKey("FFFF00000000017A9DA1");//必填参数，后端填写
                $request->setRemoteIp($_SERVER["REMOTE_ADDR"]);//必填参数，后端填写
                
                $response = $client->getAcsResponse($request);
                
                if ($response->Code == 100 || $response->Code == 200) {
                    $_SESSION['ali_captcha'] = true;
                }
            }
            
            if ($_SESSION['ali_captcha'] || $_SERVER["REMOTE_ADDR"] == '::1') {
                $db = new DB;
                $db->query("SELECT `userID`, `username`, `mail`, `phone`, `kgx_address` FROM `user` WHERE `username`='" . $_POST['account'] . "' AND `password`='" . md5(md5($_POST['pw'])) . "'");
                if ($db->num_rows() > 0) {
                    $r                        = $db->fetch_assoc();
                    $_SESSION['userID']       = $r['userID'];
                    $_SESSION['username']     = $r['username'];
                    $_SESSION['mail']         = $r['mail'];
                    $_SESSION['phone']        = $r['phone'];
                    $_SESSION['kgx_address']  = $r['kgx_address'];
                    echo 'ok';
                } else {
                    echo 'no';
                }
            } else {
                echo 'vno';
            }
            */
            /*
            //騰訊
            $url = "https://ssl.captcha.qq.com/ticket/verify";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("aid"=>"2000100641", "AppSecretKey"=>"0Z1c-XTwHBU39i3QISUYfNg**", "Ticket"=> $_POST['ticket'], "Randstr"=> $_POST['randstr'], "UserIP"=> $_SERVER["REMOTE_ADDR"]))); 
            $output = curl_exec($ch); 
            curl_close($ch);
            
            if ($output == 1 || $_SERVER["REMOTE_ADDR"] == '::1') {
                $db = new DB;
                $db->query("SELECT `userID`, `username`, `mail`, `phone`, `kgx_address` FROM `user` WHERE `username`='" . $_POST['account'] . "' AND `password`='" . md5(md5($_POST['pw'])) . "'");
                if ($db->num_rows() > 0) {
                    $r                        = $db->fetch_assoc();
                    $_SESSION['userID']       = $r['userID'];
                    $_SESSION['username']     = $r['username'];
                    $_SESSION['mail']         = $r['mail'];
                    $_SESSION['phone']        = $r['phone'];
                    $_SESSION['kgx_address']  = $r['kgx_address'];
                    echo 'ok';
                } else {
                    echo 'no';
                }
            } else {
                echo 'vno';
            }
            */
        } else {
            echo 'no';
        }
        break;
}
?>