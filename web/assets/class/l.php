<style>
table {
    margin-bottom: 20px;
    border-collapse: collapse;
    font-size: 13px;
}
td {
    padding: 5px 10px;
    border: 1px rgb(200, 200, 200) solid;
    text-align: center;
}
.title {
    background-color: #009393;
    color: #fff;
}
.item {
    text-align: left;
}
.content {
    text-align: right;
}
.content2 {
    background-color: #c4e1ff;
    text-align: right;
}
.content3 {
    background-color: #d1e9e9;
    text-align: right;
}
.note {
    background-color: #00aeae;
    text-align: left;
    color: #fff;
}
</style>
<?php
session_start();
include("DB.php");
include('function.php');
checkSignin(0);

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

if ($_SESSION['username'] == "liao") {
    
    $apiKey = '0FFUhFZ4EcCPHRrD';
    $apiSecret = '6HTxNWdvtOjgKkmITH7aXUBxtTEdftnx';
    
    $configuration = Configuration::apiKey($apiKey, $apiSecret);
    $client = Client::create($configuration);
    
    //列出匯率
    //echo '### 匯率 ###';
    $rates = $client->getExchangeRates('BTC');
    $rate_BTC = $rates['rates']['TWD'];
    //echo '<br>幣別: '.$rates['currency'];
    //echo '<br>TWD: '.$rates['rates']['TWD'];
    
    $rates = $client->getExchangeRates('ETH');
    $rate_ETH = $rates['rates']['TWD'];
    //echo '<br>幣別: '.$rates['currency'];
    //echo '<br>TWD: '.$rates['rates']['TWD'];
    
    $rates = $client->getExchangeRates('LTC');
    $rate_LTC = $rates['rates']['TWD'];
    //echo '<br>幣別: '.$rates['currency'];
    //echo '<br>TWD: '.$rates['rates']['TWD'];
    
    $rates = $client->getExchangeRates('CNY');
    $rate_CNY = $rates['rates']['TWD'];
    //echo '<br>幣別: '.$rates['currency'];
    //echo '<br>TWD: '.$rates['rates']['TWD'];
    
    $rates = $client->getExchangeRates('USD');
    $rate_USD = $rates['rates']['TWD'];
    //echo '<br>幣別: '.$rates['currency'];
    //echo '<br>TWD: '.$rates['rates']['TWD'];
    
    
    $user_kgx_total = 0;
    $user_redbag_kgx = 0;
    $user_presale_kgx = 0;
    
    $db = new DB;
    $db->query("SELECT * FROM `user`");
    if ($db->num_rows() > 0) {
        for ($i=0;$i<$db->num_rows();$i++) {
            $r = $db->fetch_assoc();
            if ($r['userID'] == '102') {
                $user_presale_kgx += $r['kgx'];
            } elseif ($r['userID'] == '103') {
                $user_redbag_kgx += $r['kgx'];
            } else {}
            $user_kgx_total += $r['kgx'];
        }
    }
    
    
    
    $order_kgx_total = 0;
    $order_only_user_buy_kgx_total = 0;
    $gift_5_kgx_total = 0;
    $gift_10_kgx_total = 0;
    $redbag_kgx_total = 0;
    $presale_kgx_total = 0;
    
    $db = new DB;
    $db->query("SELECT * FROM `order_history` WHERE `confirm_remittance`='1' AND `complete`='1'");
    if ($db->num_rows() > 0) {
        for ($i=0;$i<$db->num_rows();$i++) {
            $r = $db->fetch_assoc();
            if ($r['userID'] == '102') {
                $presale_kgx_total += $r['kgx_amount'];
            } elseif ($r['userID'] == '103') {
                $redbag_kgx_total += $r['kgx_amount'];
            } elseif ($r['currency_amount'] == 0) {
                switch ($r['kgx_amount']) {
                    case 5:
                        $gift_5_kgx_total += $r['kgx_amount'];
                        break;
                    case 10:
                        $gift_10_kgx_total += $r['kgx_amount'];
                        break;
                }
            } else {
                $order_only_user_buy_kgx_total += $r['kgx_amount'];
            }
            $order_kgx_total += $r['kgx_amount'];
        }
    }
    
    
    
    $issue_kgx_total = 0;
    
    $db = new DB;
    $db->query("SELECT `issue_number` FROM `issue_number` WHERE `no`='1'");
    if ($db->num_rows() > 0) {
        $r = $db->fetch_assoc();
        $issue_kgx_total += $r['issue_number'];
    }
    
    
    
    $user_only_user_buy_kgx_total = ($user_kgx_total*100-$user_redbag_kgx*100-(3000000*100 - $user_redbag_kgx*100)-$user_presale_kgx*100-(2000000*100 - $user_presale_kgx*100)-$gift_5_kgx_total*100-$gift_10_kgx_total*100)/100;
    $issue_only_user_buy_kgx_total = ($issue_kgx_total*100-$gift_5_kgx_total*100-$gift_10_kgx_total*100)/100;
    
    if (((float)((String)($user_kgx_total - $user_redbag_kgx - ((3000000*100 - $user_redbag_kgx*100)/100) - $user_presale_kgx - ((2000000*100 - $user_presale_kgx*100)/100) - $gift_5_kgx_total - $gift_10_kgx_total)) - $user_only_user_buy_kgx_total) == 0) {
        $user_cross_validation = 'OK';
    } else {
        $user_cross_validation = 'NO';
    }
    
    if (((float)((String)($order_kgx_total - $redbag_kgx_total - $presale_kgx_total - $gift_5_kgx_total - $gift_10_kgx_total)) - $order_only_user_buy_kgx_total) == 0) {
        $order_cross_validation = 'OK';
    } else {
        $order_cross_validation = 'NO';
    }
    
    if (((float)((String)($issue_kgx_total - $gift_5_kgx_total - $gift_10_kgx_total)) - $issue_only_user_buy_kgx_total) == 0) {
        $issue_cross_validation = 'OK';
    } else {
        $issue_cross_validation = 'NO';
    }
        
    if ($user_only_user_buy_kgx_total == $order_only_user_buy_kgx_total && $order_only_user_buy_kgx_total == $issue_only_user_buy_kgx_total) {
        $cross_validation = 'OK';
    } else {
        $cross_validation = 'NO';
    }
    
    echo '
        <table>
            <tr>
                <td colspan="2" class="title">User</td>
            </tr>
            <tr>
                <td class="item">User KGX Total</td>
                <td class="content">' . $user_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Redbag Account</td>
                <td class="content">' . $user_redbag_kgx . '</td>
            </tr>
            <tr>
                <td class="item">- Redbag</td>
                <td class="content">' . (3000000*100 - $user_redbag_kgx*100)/100 . '</td>
            </tr>
            <tr>
                <td class="item">- Presale Account</td>
                <td class="content">' . $user_presale_kgx . '</td>
            </tr>
            <tr>
                <td class="item">- Presale</td>
                <td class="content">' . (2000000*100 - $user_presale_kgx*100)/100 . '</td>
            </tr>
            <tr>
                <td class="item">- Recommend Code</td>
                <td class="content">' . $gift_5_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Signup Gift</td>
                <td class="content">' . $gift_10_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">= Actual Sales Volume</td>
                <td class="content">' . $user_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Validation</td>
                <td class="content">' . $user_cross_validation . '</td>
            </tr>
            <tr>
                <td colspan="2" class="title">Order</td>
            </tr>
            <tr>
                <td class="item">Order KGX Total</td>
                <td class="content">' . $order_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Redbag Order KGX Total</td>
                <td class="content">' . $redbag_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Presale Order KGX Total</td>
                <td class="content">' . $presale_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Recommend Code</td>
                <td class="content">' . $gift_5_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Signup Gift</td>
                <td class="content">' . $gift_10_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">= Actual Sales Volume</td>
                <td class="content">' . $order_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Validation</td>
                <td class="content">' . $order_cross_validation . '</td>
            </tr>
            <tr>
                <td colspan="2" class="title">Issue</td>
            </tr>
            <tr>
                <td class="item">Issue KGX Total</td>
                <td class="content">' . $issue_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Recommend Code</td>
                <td class="content">' . $gift_5_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">- Signup Gift</td>
                <td class="content">' . $gift_10_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">= Actual Sales Volume</td>
                <td class="content">' . $issue_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Validation</td>
                <td class="content">' . $issue_cross_validation . '</td>
            </tr>
            <tr>
                <td colspan="2" class="title">Cross Validation</td>
            </tr>
            <tr>
                <td class="item">User Actual Sales Volume</td>
                <td class="content">' . $user_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Order Actual Sales Volume</td>
                <td class="content">' . $order_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Issue Actual Sales Volume</td>
                <td class="content">' . $issue_only_user_buy_kgx_total . '</td>
            </tr>
            <tr>
                <td class="item">Validation</td>
                <td class="content">' . $cross_validation . '</td>
            </tr>
        </table>
    ';
    
    
    echo '
    <table>
        <tr>
            <td colspan="9" class="title">Statistics</td>
        </tr>
        <tr>
            <td colspan="9" class="note">※ USD is presale. Rate: 0.016 USD</td>
        </tr>
        <tr>
            <td rowspan="2">Month</td>
            <td rowspan="2" colspan="2">KGX Sales Volume</td>
            <td colspan="6">Income</td>
        </tr>
        <tr>
            <td>% \ Currency</td>
            <td>BTC</td>
            <td>ETH</td>
            <td>LTC</td>
            <td>CNY</td>
            <td>USD</td>
        </tr>
    ';
    for ($i=0;$i<11;$i++) {
        $month_order_kgx_total = 0;
        $month_order_btc_income_total = 0;
        $month_order_eth_income_total = 0;
        $month_order_ltc_income_total = 0;
        $month_order_cny_income_total = 0;
        $month_presale_kgx_total = 0;
        
        //從 2018.02 開始
        $j = $i+1;
        $start = date("Y-m-d H:i:s",strtotime("2018-02 +$i month"));
        $end = date("Y-m-d H:i:s",strtotime("2018-02 +$j month"));
        
        $db = new DB;
        $db->query("SELECT * FROM `order_history` WHERE `confirm_remittance`='1' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
        if ($db->num_rows() > 0) {
            for ($ii=0;$ii<$db->num_rows();$ii++) {
                $r = $db->fetch_assoc();
                if ($r['userID'] == '102') {
                } elseif ($r['userID'] == '103') {
                } elseif ($r['currency_amount'] == 0) {
                } else {
                    switch ($r['currency_type_id']) {
                        case 2:
                            $month_order_btc_income_total += $r['income'];
                            break;
                        case 3:
                            $month_order_eth_income_total += $r['income'];
                            break;
                        case 4:
                            $month_order_ltc_income_total += $r['income'];
                            break;
                        case 6:
                            $month_order_cny_income_total += $r['income'];
                            break;
                    }
                    $month_order_kgx_total += $r['kgx_amount'];
                }
            }
        }
        $db = new DB;
        $db->query("SELECT * FROM `transfer_history` WHERE `userID`='102' AND `complete`='1' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
        if ($db->num_rows() > 0) {
            for ($ii=0;$ii<$db->num_rows();$ii++) {
                $r = $db->fetch_assoc();
                $month_presale_kgx_total += $r['kgx_amount'];
            }
        }
        $BTCtoTWD = $month_order_btc_income_total*0.05*$rate_BTC;
        $ETHtoTWD = $month_order_eth_income_total*0.05*$rate_ETH;
        $LTCtoTWD = $month_order_ltc_income_total*0.05*$rate_LTC;
        $CNYtoTWD = $month_order_cny_income_total*0.05*$rate_CNY;
        $USDtoTWD = ($month_presale_kgx_total*0.016)*0.05*$rate_USD;
        $total = $BTCtoTWD + $ETHtoTWD + $LTCtoTWD + $CNYtoTWD + $USDtoTWD;
        echo '
        <tr>
            <td rowspan="3">' . date("Y-m",strtotime("2018-02 +$i month")) . '</td>
            <td>Sale</td>
            <td class="content">' . $month_order_kgx_total . '</td>
            <td class="content">100%</td>
            <td class="content">' . $month_order_btc_income_total . '</td>
            <td class="content">' . $month_order_eth_income_total . '</td>
            <td class="content">' . $month_order_ltc_income_total . '</td>
            <td class="content">' . $month_order_cny_income_total . '</td>
            <td class="content">' . ($month_presale_kgx_total*0.016) . '</td>
        </tr>
        <tr>
            <td>Presale</td>
            <td class="content">' . $month_presale_kgx_total . '</td>
            <td class="content2">5%</td>
            <td class="content2">' . $month_order_btc_income_total*0.05 . '</td>
            <td class="content2">' . $month_order_eth_income_total*0.05 . '</td>
            <td class="content2">' . $month_order_ltc_income_total*0.05 . '</td>
            <td class="content2">' . $month_order_cny_income_total*0.05 . '</td>
            <td class="content2">' . ($month_presale_kgx_total*0.016)*0.05 . '</td>
        </tr>
        <tr>
            <td colspan="2">Exchange to TWD</td>
            <td class="content3">Total: ' . $total . '</td>
            <td class="content3">' . $BTCtoTWD . '</td>
            <td class="content3">' . $ETHtoTWD . '</td>
            <td class="content3">' . $LTCtoTWD . '</td>
            <td class="content3">' . $CNYtoTWD . '</td>
            <td class="content3">' . $USDtoTWD . '</td>
        </tr>
        ';
    }
    echo '</table>';
}
?>