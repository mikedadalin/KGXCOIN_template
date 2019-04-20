<?php
include('DB.php');
$data = file_get_contents("php://input");
$data = json_decode($data, true);
$data['amount'] = ($data['amount']/100);

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
//風雲回傳的資料
//HTTP 1.1
//URL: 接入商接收订单异步通知的URL (在风云后台设置)
//Method: POST
//Post Data: 内容是json string, 内容字段如下：
//{
//order_id: xxx, 接入商网站提交的订单号
//direction: in/out, 充值or 提现
//amount: xxxx, 金额，单位分，没有小数点 //!!客戶匯入的金額
//customer_name: xxx, 接入商网站的会员ID(提单API 传递过来的)
//verified_time: xxx, 订单完成时间，UNIX 时间戳秒值
//created_time: xxx, 订单创建时间，UNIX 时间戳秒值
//status: "verified / timeout / revoked" //!! verified 表示成功支付
//cmd: “order_success”/ “order_revoked”/ “order_timeout”
//type: “remit”, 会员存款方式(充值有此参数)
//remit: 银行卡转账
//qrcode: 二维码存款
//online: 在线网银
//quick: 快捷支付
//to_bankflag: 收款卡银行, (充值有此参数)
//to_cardnumber: 收款卡号, (充值有此参数)
//to_username:: 收款卡姓名, (充值有此参数)
//customer_bankflag: “ALIPAY” 会员存款卡类型(充值有此参数)
//ALIPAY: 支付宝, WebMM: 微信支付, QQPAY: QQ 钱包
//CMB: 招商银行, ABC: 农业银行, … ...
//out_cardnumber: 会员提现，系统使用的出款卡(提现有此参数)
//trans_fee: 会员提现，此笔订单的转账佣金(提现有此参数) 单位分
//}

order_id : 135||
direction : in||
amount : 101||
customer_name : 41||
verified_time : 1520606311||
created_time : 1520606218||
cmd : order_success||
status : verified||
type : online||
customer_bankflag : BCM||
to_cardnumber : CHANG1509975290259||
to_username : CHANG1509975290259||
to_bankflag : CHANGHUI||
mer_order_id : d.5l.135||
*/


if (isset($data['order_id']) && isset($data['customer_name']) && $data['status'] == 'verified') {
    //查詢訂單是否已處理
    $db = new DB;
    $db->query("SELECT * FROM `order_history` WHERE `no`='" . $data['order_id'] . "' AND `userID`='" . $data['customer_name'] . "' AND `confirm_remittance`!='1'");
    if ($db->num_rows() > 0) {
        $r = $db->fetch_assoc();
        
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
            echo true;
        }
    }
}
?>