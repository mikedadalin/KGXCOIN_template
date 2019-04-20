<?php
session_start();
include("DB.php");
include("qrlib.php");

if ($_SERVER["REMOTE_ADDR"] == '::1') {
    require '../../vendor/autoload.php';// local端
} else {
    require '/var/www/html/vendor/autoload.php';// server端
}
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

use Coinbase\Wallet\Resource\Account;
use Coinbase\Wallet\Resource\Address;
use Coinbase\Wallet\Resource\Buy;
use Coinbase\Wallet\Resource\Checkout;
use Coinbase\Wallet\Resource\CurrentUser;
use Coinbase\Wallet\Resource\Deposit;
use Coinbase\Wallet\Resource\Merchant;
use Coinbase\Wallet\Resource\Order;
use Coinbase\Wallet\Resource\PaymentMethod;
use Coinbase\Wallet\Resource\Resource;
use Coinbase\Wallet\Resource\ResourceCollection;
use Coinbase\Wallet\Resource\Sell;
use Coinbase\Wallet\Resource\Transaction;
use Coinbase\Wallet\Resource\User;
use Coinbase\Wallet\Resource\Withdrawal;
use Coinbase\Wallet\Resource\Notification;


$apiKey = '0FFUhFZ4EcCPHRrD';
$apiSecret = '6HTxNWdvtOjgKkmITH7aXUBxtTEdftnx';

$configuration = Configuration::apiKey($apiKey, $apiSecret);
$client = Client::create($configuration);
//選擇帳戶
switch ($_POST['currency_type_id']) {
    case '2':    //BTC
        $accountId = '093d8968-a4ae-51d8-900b-72b958517e37';
        $account = $client->getAccount($accountId);
        break;
    case '3':    //ETH
        $accountId = '33ca396a-cab9-5461-b0b3-7aa50395cd56';
        $account = $client->getAccount($accountId);
        break;
    case '4':    //LTC
        $accountId = '18fa83df-254d-5f9d-8b95-2d4b39a5379d';
        $account = $client->getAccount($accountId);
        break;
}



$inputNull = false;

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
    if ($_POST[$k] == '' || $_POST[$k] == null) { $inputNull = true; }
}

switch ($_POST['action']) {
    case 'order':
        if (!$inputNull && $_POST['kgx_amount'] <= 20000) {
            switch ($_POST['currency_type_id']) {
                case 2:
                    $uuid = 'e'.md5(md5($_POST['ratio'])).'c';
                    break;
                case 3:
                    $uuid = 'j'.md5(md5($_POST['ratio'])).'n';
                    break;
                case 4:
                    $uuid = 'q'.md5(md5($_POST['ratio'])).'l';
                    break;
                case 6:
                    $uuid = 'g'.md5(md5($_POST['ratio'])).'d';
                    break;
            }
            $uuid2 = 'm'.md5(md5($_POST['ratio2'])).'z';
            
            if ($uuid == $_POST['uuid'] && $uuid2 == $_POST['uuid2']) {
                //驗證匯率
                $check = false;
                /*
                $temp = ($_POST['kgx_amount']*$_POST['ratio2']);
                if ($temp >= 60000) {
                    if ($_POST['currency_amount'] == (($_POST['kgx_amount']/$_POST['ratio'])*0.7)) {
                        $check = true;
                    }
                } elseif ($temp >= 40000) {
                    if ($_POST['currency_amount'] == (($_POST['kgx_amount']/$_POST['ratio'])*0.8)) {
                        $check = true;
                    }
                } elseif ($temp >= 20000) {
                    if ($_POST['currency_amount'] == (($_POST['kgx_amount']/$_POST['ratio'])*0.9)) {
                        $check = true;
                    }
                } else {
                    if ($_POST['currency_amount'] == ($_POST['kgx_amount']/$_POST['ratio'])) {
                        $check = true;
                    }
                }
                */
                if ($_POST['currency_type_id'] == 6) {
                    if ($_POST['currency_amount'] == (ceil(($_POST['kgx_amount']/$_POST['ratio'])*100)/100)) {
                        $check = true;
                    }
                } else {
                    if ($_POST['currency_amount'] == ($_POST['kgx_amount']/$_POST['ratio'])) {
                        $check = true;
                    }
                }
                
                if ($check) {
                    
                    $dateTime = date("Y-m-d H:i:s");
                    
                    //儲存訂單
                    $db = new DB;
                    $db->query("INSERT INTO `order_history` VALUES (null, '" . $dateTime . "', '" . $_SESSION['userID'] . "', '" . $_POST['currency_type_id'] . "', '" . $_POST['currency_amount'] . "', '0', '" . $_POST['kgx_amount'] . "', '', '', '', '0', '0', '" . $_POST['ratio'] . "', '" . $_POST['ratio2'] . "', '');");
                    
                    $db = new DB;
                    $db->query("SELECT `no` FROM `order_history` WHERE `dateTime`='" . $dateTime . "' AND `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='" . $_POST['currency_type_id'] . "'");
                    $r = $db->fetch_assoc();
                    
                    if ($_POST['currency_type_id'] == 2 || $_POST['currency_type_id'] == 3 || $_POST['currency_type_id'] == 4) {
                        //產生地址
                        $address = new Address([
                            'name' => $dateTime. ' '. $_SESSION['userID']
                        ]);
                        $client->createAccountAddress($account, $address);
                        $obj_data = $address;
                        $responseData = [];
                        $responseData[] = $obj_data->getRawData();
                        $id = $responseData[0]['id'];
                        $address = $responseData[0]['address'];
                        
                        //QR code
                        $PNG_TEMP_DIR = '../qr_code/';
                        if (!file_exists($PNG_TEMP_DIR)){
                            mkdir($PNG_TEMP_DIR);
                        }
                        $filename = $PNG_TEMP_DIR.'ad_'.$r['no'].'.png';
                        QRcode::png($address, $filename, 'H', 4, 2);
                        
                        //儲存地址
                        $db = new DB;
                        $db->query("UPDATE `order_history` SET `id`='" . $id . "', `address`='" . $address . "', `qr`='ad_" . $r['no'] . ".png' WHERE `no`='" . $r['no'] . "'");
                        
                        echo 'ok||ad_'.$r['no'].'.png||'.$address;
                    } elseif ($_POST['currency_type_id'] == 6) {
                        //提交充值訂單
                        /*
                        if ($_POST['from_bank_flag'] == 'QQPAY') {
                            $_POST['category'] = 'qrcode';
                        } else {
                            $_POST['category'] = 'remit';
                        }
                        $time = time();
                        $data = array("cid" => 201, "uid" => $_SESSION['userID'], "time" => $time, "amount" => $_POST['currency_amount'], "order_id" => $r['no'], "category" => $_POST['category'], "ip" => $_SERVER["REMOTE_ADDR"], "from_bank_flag" => $_POST['from_bank_flag']);
                        $data_string = json_encode($data);
                        $dig64 = base64_encode(hash_hmac('sha1', $data_string, 'n11w4mzndYtMnWZiARUbAaSojJBLIYD7Aiot0waF03uMI7n6BwnuJchLgLooFWDk',true));
                        $ch = curl_init('https://www.dsdfpay.com/dsdf/api/place_order');
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Content-Hmac:'.$dig64));
                        $result = curl_exec($ch);
                        curl_close($ch);
                        //print($result);
                        $result = json_decode($result, true);
                        
                        if ($result['success']) {
                            switch ($_POST['category']) {
                                case 'qrcode':
                                    //{"success":true,"data":{"action":"show","card":{"bankflag":"CHANGHUI","cardnumber":"CHANG1509975290259"},"qrurl":"https://myun.tenpay.com/mqq/pay/qrcode.html?_wv=1027&_bid=2183&t=6Va286b43aca7954f8de8df438c84427"}}
                                    //{"success":false,"msg":"order id exist"}
                                    $url = $result['data']['qrurl'];
                                    switch ($result['data']['action']) {
                                        case 'show':    //二維碼
                                            //QR code
                                            $PNG_TEMP_DIR = '../qr_code/';
                                            if (!file_exists($PNG_TEMP_DIR)){
                                                mkdir($PNG_TEMP_DIR);
                                            }
                                            $filename = $PNG_TEMP_DIR.'ad_'.$r['no'].'.png';
                                            QRcode::png($url, $filename, 'H', 4, 2);
                                            //儲存地址
                                            $db = new DB;
                                            $db->query("UPDATE `order_history` SET `id`='show', `address`='" . $url . "', `qr`='ad_" . $r['no'] . ".png', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                                            echo 'dsdfpay||qrcode||show||ad_'.$r['no'].'.png';
                                            break;
                                        case 'jump':    //轉跳網址
                                            //儲存地址
                                            $db = new DB;
                                            $db->query("UPDATE `order_history` SET `id`='jump', `address`='" . $url . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                                            echo 'dsdfpay||qrcode||jump||'.$url;
                                            break;
                                        case 'image':    //固定碼圖片url
                                            //儲存地址
                                            $db = new DB;
                                            $db->query("UPDATE `order_history` SET `id`='image', `address`='" . $url . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                                            echo 'dsdfpay||qrcode||image||'.$url;
                                            break;
                                    }
                                    break;
                                case 'remit':
                                    //{"success":true,"data":{"action":"show","card":{"bankflag":"PAB","cardnumber":"6230580000142881908","cardname":"邱歆媛","location":"北京通州區新華支行"}}}
                                    //{"success":true,"data":{"action":"show","card":{"bankflag":"PSBC","cardnumber":"6217993810006756675","cardname":"田闯闯","location":"魏武邮政支局"}}}
                                    //顯示收款帳戶資料給user
                                    //$result['data']['card'][bankflag]    銀行編碼
                                    //$result['data']['card'][cardnumber]  收款卡號
                                    //$result['data']['card'][cardname]    收款卡姓名
                                    //$result['data']['card'][location]    收款卡開戶行
                                    //儲存地址
                                    $url = $result['data']['card']['bankflag'].'||'.$result['data']['card']['cardnumber'].'||'.$result['data']['card']['cardname'].'||'.$result['data']['card']['location'];
                                    $db = new DB;
                                    $db->query("UPDATE `order_history` SET `id`='remit', `address`='" . $url . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                                    echo 'dsdfpay||remit||'.$result['data']['card']['bankflag'].'||'.$result['data']['card']['cardnumber'].'||'.$result['data']['card']['cardname'].'||'.$result['data']['card']['location'];
                                    break;
                            }
                        } else {
                            $db = new DB;
                            $db->query("UPDATE `order_history` SET `confirm_remittance`='2' WHERE `no`='" . $r['no'] . "'");
                            echo 'dsdfpayno';
                        }
                        */
                        
                        if ($_POST['from_bank_flag'] == 'unionpay' || $_POST['from_bank_flag'] == 'unionpayq' || $_POST['from_bank_flag'] == 'unionpayc') {
                            /*
                            後臺網址=>http://www.hanpays.com:888
                            後台登入帳號=>CID020
                            後檯登入密碼=>1a5ee442ae
                            金流串接商號=>CID02001
                            
                            金流串接KEY=>51af7e69d43576fc96eb5a00ed8ba23f
                            
                            unionpay : 網銀支付
                            unionpayq : 快捷支付
                            unionpayc : 銀聯掃碼
                            */
                            //儲存地址
                            $time = time();
                            $db = new DB;
                            $db->query("UPDATE `order_history` SET `id`='online', `address`='" . $_POST['from_bank_flag'] . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                            //回傳必要參數
                            $scode = 'CID02001';
                            $orderid = $r['no'];
                            $paytype = $_POST['from_bank_flag'];
                            $amount = $_POST['currency_amount'];
                            $productname = 'KGX Coin';
                            $currcode = 'CNY';
                            $userid = $_SESSION['userID'];
                            $callbackurl = 'https://kgxcoin.com/assets/class/hanpays_cash_payment.php';
                            $key = '51af7e69d43576fc96eb5a00ed8ba23f';
                            $sign = md5($scode . '|' . $orderid . '&' . $amount . '&' . $currcode . '|' . $callbackurl . '&' . $key);
                            echo 'dsdfpay||online||'.$scode.'&&'.$orderid.'&&'.$paytype.'&&'.$amount.'&&'.$productname.'&&'.$currcode.'&&'.$userid.'&&'.$callbackurl.'&&'.$sign;
                        } elseif ($_POST['from_bank_flag'] == 'alipayOrg') {
                            //儲存地址
                            $time = time();
                            $db = new DB;
                            $db->query("UPDATE `order_history` SET `id`='online', `address`='" . $_POST['from_bank_flag'] . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                            //回傳必要參數
                            echo 'dsdfpay||online||'.$r['no'].'&&'.$_POST['currency_amount'].'&&'.$_POST['kgx_amount'];
                        } else {
                            //儲存地址
                            $time = time();
                            $db = new DB;
                            $db->query("UPDATE `order_history` SET `id`='online', `address`='" . $_POST['from_bank_flag'] . "', `create_time`='" . $time . "' WHERE `no`='" . $r['no'] . "'");
                            if ($_POST['from_bank_flag'] == 'ALIPAY') {
                                $type = 'qrcode';
                            } else {
                                $type = 'online';
                            }
                            //產生付款轉跳網址
                            $data = 'cid=201&uid=' . $_SESSION['userID'] . '&time=' . $time . '&amount=' . $_POST['currency_amount'] . '&order_id=' . $r['no'] . '&ip=' . $_SERVER["REMOTE_ADDR"];
                            $dig64 = base64_encode(hash_hmac('sha1', $data, 'n11w4mzndYtMnWZiARUbAaSojJBLIYD7Aiot0waF03uMI7n6BwnuJchLgLooFWDk', true));
                            $url = 'https://www.dsdfpay.com/dsdf/customer_pay/init_din?' . $data . '&sign=' . $dig64 . '&type=' . $type . '&tflag=' . $_POST['from_bank_flag'];
                            //回傳付款網址
                            echo 'dsdfpay||online||'.$url;
                        }
                    } else {}
                } else {
                    echo 'out';
                }
            } else {
                echo 'out';
            }
        } else {
            echo 'inputNull';
        }
        break;
}
?>