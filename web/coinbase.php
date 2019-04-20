<?php
if ($_SERVER["REMOTE_ADDR"] == '::1') {
    require 'vendor/autoload.php';// local端
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



######### 市場數據 #########
//列出支持的本地貨幣
//$currencies = $client->getCurrencies();
/*
for ($i = 0; $i < count($currencies); $i++) {
    echo $currencies[$i]['id'].'<br>';
    echo $currencies[$i]['name'].'<br>';
    echo $currencies[$i]['min_size'].'<br><br>';
}
*/



//列出匯率
$rates = $client->getExchangeRates();
//print_r($rates);
echo '### 匯率 ###';
echo '<br>幣別: '.$rates['currency'];
echo '<br>BTC: '.$rates['rates']['BTC'];
echo '<br>ETH: '.$rates['rates']['ETH'];
echo '<br>LTC: '.$rates['rates']['LTC'];
echo '<br>CNY: '.$rates['rates']['CNY'];
echo '<br><br><br>';



//列出所有帳戶
$accounts = $client->getAccounts();
echo '### 列出所有帳戶 ###<br>';
$obj_data = $accounts;
$responseData = [];
foreach ($obj_data->all() as &$temp) {
    $responseData[] = $temp->getRawData();
}
for ($i = 0 ; $i < count($responseData); $i++) {
    foreach ($responseData[$i] as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
    echo '<br>';
}
echo '<br><br><br>';

//列出帳戶詳情
$accountId = $responseData[1]['id'];
$account = $client->getAccount($accountId);
echo '### 列出帳戶詳情 ###<br>';
$obj_data = $account;
$responseData = [];
$responseData[] = $obj_data->getRawData();
for ($i = 0 ; $i < count($responseData); $i++) {
    foreach ($responseData[$i] as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
}
echo '<br><br><br>';


//列出主要帳戶詳情
$account = $client->getPrimaryAccount();
echo '### 列出主要帳戶詳情 ###<br>';
$obj_data = $account;
$responseData = [];
$responseData[] = $obj_data->getRawData();
for ($i = 0 ; $i < count($responseData); $i++) {
    foreach ($responseData[$i] as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
}
echo '<br><br><br>';



######### 地址 #########
//列出帳戶的接收地址
$addresses = $client->getAccountAddresses($account);
echo '### 帳戶的接收地址 ###<br>';
$obj_data = $addresses;
$responseData = [];
foreach ($obj_data->all() as &$temp) {
    $responseData[] = $temp->getRawData();
}
for ($i = 0 ; $i < count($responseData); $i++) {
    foreach ($responseData[$i] as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
    echo '<br>';
}
echo '<br><br><br>';



//獲取接收地址信息
$addressId = $responseData[0]['id'];
$address = $client->getAccountAddress($account, $addressId);
echo '### 獲取接收地址信息 ###<br>';
$obj_data = $address;
$responseData = [];
$responseData[] = $obj_data->getRawData();
for ($i = 0 ; $i < count($responseData); $i++) {
    foreach ($responseData[$i] as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
}
echo '<br><br><br>';



//列出地址的交易
$transactions = $client->getAddressTransactions($address);
echo '### 列出地址的交易 ###<br>';
print_r($transactions);
if (count($transactions) > 0) {
    $obj_data = $transactions;
    $responseData = [];
    $responseData[] = $obj_data->getRawData();
    for ($i = 0 ; $i < count($responseData); $i++) {
        foreach ($responseData[$i] as $k => $v) {
            echo $k.' : '.$v.'<br>';
        }
    }
}
//從 order_history 撈 id，帶入 "獲取接收地址信息" 取得 $address，再使用 "列出地址的交易" 取得交易資訊
//$amount = 0;
//$responseData[$i]['status'] == "completed"           //狀態需要測試看看
//$responseData[$i]['amount']['currency'] == ""
//$amount += $responseData[$i]['amount']['amount']
//
echo '<br><br><br>';



//創建一個新的接收地址
/*
$address = new Address([
    'name' => 'New Address'
]);
$client->createAccountAddress($account, $address);
print_r($address);
*/
?>