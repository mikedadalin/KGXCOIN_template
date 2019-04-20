<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'adjustment':
        $db = new DB;
        $db->query("UPDATE `issue_number` SET `adjustment`='" . $_POST['value'] . "' WHERE `no`='1'");
        
        //發行數量比對匯率
        $db = new DB;
        $db->query("SELECT * FROM `issue_number` WHERE `no`='1'");
        $r = $db->fetch_assoc();
        
        $db = new DB;
        $db->query("SELECT * FROM `rate` WHERE `rangeA`<'" . ($r['issue_number'] + $r['adjustment']) . "' AND `rangeB`>='" . ($r['issue_number'] + $r['adjustment']) . "' LIMIT 0,1");
        if ($db->num_rows() > 0) {
            $r = $db->fetch_assoc();
            
            $db = new DB;
            $db->query("SELECT * FROM `rate_history`");
            $no = $db->num_rows();
            
            $db = new DB;
            $db->query("SELECT * FROM `rate_history` WHERE `no`='" . $no . "' AND `rate`='" . $r['rate'] . "' LIMIT 0,1");
            if ($db->num_rows() == 0) {
                
                $rate = (1/$r['rate']);
                
                //更新 KGX 匯率
                $db = new DB;
                $db->query("UPDATE `currency_type` SET `rate`='" . $rate . "' WHERE `currency_type_id`='1'");
                
                //紀錄匯率調整
                $db = new DB;
                $db->query("INSERT INTO `rate_history` VALUES (null, '" . date("Y-m-d H:i:s") . "', '" . $r['rate'] . "');");
                
                echo 'ok';
            } else {
                echo 'no';
            }
        } else {
            echo 'no';
        }
        break;
}
?>