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

$overtime = date('Y-m-d 00:00:00', strtotime('-1 day'));

//確認 order
$db = new DB;
$db->query("SELECT * FROM `order_history` WHERE `confirm_remittance`='0' AND `currency_type_id` IN (2, 3, 4)");
for ($i = 0; $i < $db->num_rows(); $i++) {
    $r = $db->fetch_assoc();
    
    if ($r['dateTime'] < $overtime) {
        $dbOver = new DB;
        $dbOver->query("UPDATE `order_history` SET `confirm_remittance`='3' WHERE `no`='" . $r['no'] . "'");
    } else {
        //選擇帳戶
        switch ($r['currency_type_id']) {
            case '2':    //BTC
                $currency = 'BTC';
                $accountId = '093d8968-a4ae-51d8-900b-72b958517e37';
                break;
            case '3':    //ETH
                $currency = 'ETH';
                $accountId = '33ca396a-cab9-5461-b0b3-7aa50395cd56';
                break;
            case '4':    //LTC
                $currency = 'LTC';
                $accountId = '18fa83df-254d-5f9d-8b95-2d4b39a5379d';
                break;
        }
        $account = $client->getAccount($accountId);
        
        //獲取接收地址信息
        $addressId = $r['id'];
        $address = $client->getAccountAddress($account, $addressId);
        /*
        echo '### 獲取接收地址信息 ###<br>';
        $obj_data = $address;
        $responseData = [];
        $responseData[] = $obj_data->getRawData();
        for ($ii = 0 ; $ii < count($responseData); $ii++) {
            foreach ($responseData[$ii] as $k => $v) {
                echo $k.' : '.$v.'<br>';
            }
        }
        echo '<br><br>';
        */
        
        //列出地址的交易
        $amount = 0;
        $transactions = $client->getAddressTransactions($address);
        //echo '### 列出地址的交易 ###<br>';
        //print_r($transactions);
        if (count($transactions) > 0) {
            $obj_data = $transactions;
            $responseData = [];
            foreach ($obj_data->all() as &$temp) {
                $responseData[] = $temp->getRawData();
            }
            for ($ii = 0 ; $ii < count($responseData); $ii++) {
                /*
                foreach ($responseData[$ii] as $k => $v) {
                    if ($k == 'amount' || $k == 'native_amount' || $k == 'network' || $k == 'from' || $k == 'details') {
                        echo $k.' : <br>{<br>';
                        foreach ($responseData[$ii][$k] as $kk => $vv) {
                            echo '&nbsp;&nbsp;&nbsp;'.$kk.' : '.$vv.'<br>';
                        }
                        echo '}<br>';
                    } else {
                        echo $k.' : '.$v.'<br>';
                    }
                }
                */
                //echo 'status : '. $responseData[$ii]['status'] .'<br>';//status: pending、completed
                //echo 'amount : '. $responseData[$ii]['amount']['amount'] .'<br>';
                //echo 'currency : '. $responseData[$ii]['amount']['currency'] .'<br><br>';
                
                //!!確認 status、貨幣類型
                if ($responseData[$ii]['status'] == 'completed' && $responseData[$ii]['amount']['currency'] == $currency) {
                    //統計交易總額
                    $amount += $responseData[$ii]['amount']['amount'];
                }
            }
            //echo 'total amount : '.$amount.'<br><br><br>';
            if ($amount >= ($r['currency_amount']-0.0000001)) {
                //確認到帳
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `confirm_remittance`='1', `income`='" . $amount . "' WHERE `no`='" . $r['no'] . "'");
                
                //完成購買交易
                $db2 = new DB;
                $db2->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $r['userID'] . "'");
                $r2 = $db2->fetch_assoc();
                
                $db2 = new DB;
                $db2->query("UPDATE `user` SET `kgx`='" . ($r2['kgx'] + $r['kgx_amount']) . "' WHERE `userID`='" . $r['userID'] . "'");
                
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `complete`='1' WHERE `no`='" . $r['no'] . "'");
                
                //統計發行數量
                $db2 = new DB;
                $db2->query("SELECT * FROM `issue_number` WHERE `no`='1'");
                $r2 = $db2->fetch_assoc();
                $issue_number = ($r2['issue_number'] + $r['kgx_amount']);
                $db2 = new DB;
                $db2->query("UPDATE `issue_number` SET `issue_number`='" . $issue_number. "' WHERE `no`='1'");
                
                //發行數量比對匯率
                $db2 = new DB;
                $db2->query("SELECT * FROM `rate` WHERE `rangeA`<'" . ($issue_number + $r2['adjustment']) . "' AND `rangeB`>='" . ($issue_number + $r2['adjustment']) . "' LIMIT 0,1");
                if ($db2->num_rows() > 0) {
                    $r2 = $db2->fetch_assoc();
                    
                    $db2 = new DB;
                    $db2->query("SELECT * FROM `rate_history`");
                    $no = $db2->num_rows();
                    
                    $db2 = new DB;
                    $db2->query("SELECT * FROM `rate_history` WHERE `no`='" . $no . "' AND `rate`='" . $r2['rate'] . "' LIMIT 0,1");
                    if ($db2->num_rows() == 0) {
                        
                        $rate = (1/$r2['rate']);
                        
                        //更新 KGX 匯率
                        $db2 = new DB;
                        $db2->query("UPDATE `currency_type` SET `rate`='" . $rate . "' WHERE `currency_type_id`='1'");
                        
                        //紀錄匯率調整
                        $db2 = new DB;
                        $db2->query("INSERT INTO `rate_history` VALUES (null, '" . date("Y-m-d H:i:s") . "', '" . $r2['rate'] . "');");
                    }
                }
            }
        }
        //echo '<br><br><br>';
    }
}
?>