<?php
include('DB.php');

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

//列出匯率
$rates = $client->getExchangeRates();
//print_r($rates);
/*
echo '### 匯率 ###';
echo '<br>幣別: '.$rates['currency'];
echo '<br>BTC: '.$rates['rates']['BTC'];
echo '<br>ETH: '.$rates['rates']['ETH'];
echo '<br>LTC: '.$rates['rates']['LTC'];
echo '<br>CNY: '.$rates['rates']['CNY'];
*/

$db = new DB;
$db->query("UPDATE `currency_type` SET `rate`='" . $rates['rates']['BTC'] . "' WHERE `currency_type_id`='2'");
$db = new DB;
$db->query("UPDATE `currency_type` SET `rate`='" . $rates['rates']['ETH'] . "' WHERE `currency_type_id`='3'");
$db = new DB;
$db->query("UPDATE `currency_type` SET `rate`='" . $rates['rates']['LTC'] . "' WHERE `currency_type_id`='4'");
$db = new DB;
$db->query("UPDATE `currency_type` SET `rate`='" . $rates['rates']['CNY'] . "' WHERE `currency_type_id`='6'");
?>