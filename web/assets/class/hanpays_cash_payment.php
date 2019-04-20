<?php
include('DB.php');

//接收測試
/*
foreach ($data as $k => $v) {
    if ($k == 'amount') { $v = ($v/100); }
    $test .= $k . ' : ' . $v . '||';
    if ($k == 'order_id') { $test_no = $v; }
}
$db = new DB;
$db->query("UPDATE `order_history` SET `id`='" . $test . "' WHERE `no`='" . $test_no . "'");
*/


/*
//悍付回傳的資料
商家代號        $_POST['scode']
交易序號        $_POST['orderid']        訂單編號
本系統交易序號    $_POST['orderno']        第三方訂單編號
支付方式        $_POST['paytype']        unionpay, unionpayq, unionpayc
支付金額        $_POST['amount']        格式: ###.##
商品名稱        $_POST['productname']    KGX Coin
支付幣別        $_POST['currcode']        CNY
交易結果        $_POST['status']        0:user中途終止交易, 1:交易成功, -1:交易失敗
交易代碼        $_POST['respcode']
驗證碼            $_POST['sign']            MD5加密
*/
$key = '51af7e69d43576fc96eb5a00ed8ba23f';
if ($_POST['sign'] == md5($_POST['scode'] . '|' . $_POST['orderno'] . '&' . $_POST['orderid'] . '&' . $_POST['amount'] . '|' . $_POST['currcode'] . '&' . $_POST['status'] . '&' . $_POST['respcode'] . '|' . $key)) {
    if ($_POST['status'] == '1') {
        //查詢訂單是否已處理
        $db = new DB;
        $db->query("SELECT * FROM `order_history` WHERE `no`='" . $_POST['orderid'] . "' AND `confirm_remittance`!='1'");
        if ($db->num_rows() > 0) {
            $r = $db->fetch_assoc();
            
            if ($_POST['amount'] >= $r['currency_amount']) {
                //確認到帳
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `confirm_remittance`='1', `income`='" . $_POST['amount'] . "' WHERE `no`='" . $_POST['orderid'] . "'");
                
                //完成購買交易
                $db2 = new DB;
                $db2->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $r['userID'] . "'");
                $r2 = $db2->fetch_assoc();
                
                $db2 = new DB;
                $db2->query("UPDATE `user` SET `kgx`='" . ($r2['kgx'] + $r['kgx_amount']) . "' WHERE `userID`='" . $r['userID'] . "'");
                
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `complete`='1' WHERE `no`='" . $_POST['orderid'] . "'");
                
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
                echo true;
            }
        }    
    }
}
?>