<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */
include('../DB.php');
require_once("config.php");
require_once 'wappay/service/AlipayTradeService.php';


$arr=$_POST;
$alipaySevice = new AlipayTradeService($config); 
$alipaySevice->writeLog(var_export($_POST,true));
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
/*
if ($result) {
	$test = 'true';
} else {
	$test = 'false';
}
foreach ($_POST as $k => $v) {
	$test .= ' || '. $k . '&&' . $v;
}
$dbTEST = new DB;
$dbTEST->query("INSERT INTO `user` VALUES (null, '" . $test . "', '', '', '', '', '', '', '');");
*/

if ($result) {//验证成功
    if ($_POST['app_id'] == '2018060260291542') {
        //商户订单号
        $data['order_id'] = $_POST['out_trade_no'];
        //支付宝交易号
        $trade_no = $_POST['trade_no'];
        //交易状态
        $trade_status = $_POST['trade_status'];
        //實收金額
        $data['amount'] = $_POST['receipt_amount'];
        
        if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
            //查詢訂單是否已處理
            $db = new DB;
            $db->query("SELECT * FROM `order_history` WHERE `no`='" . $data['order_id'] . "' AND `confirm_remittance`!='1'");
            if ($db->num_rows() > 0) {
                $r = $db->fetch_assoc();
                $data['customer_name'] = $r['userID'];
                
                if ($data['amount'] >= $r['currency_amount']) {
                    //確認到帳
                    $db2 = new DB;
                    $db2->query("UPDATE `order_history` SET `confirm_remittance`='1', `income`='" . $data['amount'] . "' WHERE `no`='" . $data['order_id'] . "'");
                    
                    //完成購買交易
                    $db2 = new DB;
                    $db2->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $data['customer_name'] . "'");
                    $r2 = $db2->fetch_assoc();
                    
                    $db2 = new DB;
                    $db2->query("UPDATE `user` SET `kgx`='" . ($r2['kgx'] + $r['kgx_amount']) . "' WHERE `userID`='" . $data['customer_name'] . "'");
                    
                    $db2 = new DB;
                    $db2->query("UPDATE `order_history` SET `complete`='1' WHERE `no`='" . $data['order_id'] . "'");
                    
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
                    //回應 true，不然會重複推送訂單多次
                    echo "success";
                }
            }
        }
    }
} else {
    //验证失败
    echo "fail";    //请不要修改或删除
}

?>

