<?php
session_start();
include("DB.php");

$inputNull = false;

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
    if ($_POST[$k] == '' || $_POST[$k] == null) { $inputNull = true; }
}

switch ($_POST['action']) {
    case 'signup':
        if (!$inputNull) {
            //判斷推薦代碼
            /*
            $recommend_code = false;
            if ($_POST['code'] != '') {
                $db = new DB;
                $db->query("SELECT `no` FROM `recommend_code` WHERE `code`='" . $_POST['code'] . "' AND `status`='0'");
                if ($db->num_rows() > 0) {
                    $r = $db->fetch_assoc();
                    $recommend_code_no = $r['no'];
                    $recommend_code = true;
                } else {
                    echo 'codeError';
                    exit;
                }
            }
            */
            if ($_POST['countryCode'] != '86') { $temp_mobile = $_POST['countryCode'] . $_POST['mobile']; } else { $temp_mobile = $_POST['mobile']; }
            $db = new DB;
            $db->query("SELECT * FROM `signup_verification` WHERE `mail`='" . $temp_mobile . "' AND `verification_code`='" . $_POST['verificationCode'] . "'");
            if ($db->num_rows() > 0) {
                $r = $db->fetch_assoc();
                
                $db = new DB;
                $db->query("DELETE FROM `signup_verification` WHERE `mail`='" . $temp_mobile . "'");
                
                $db = new DB;
                $db->query("SELECT * FROM `user` WHERE `username`='" . $_POST['account'] . "' OR `mail`='" . $_POST['email'] . "'");
                if ($db->num_rows() > 0) {
                    echo 'exist';
                } else {
                    $checkUUID = false;
                    while($checkUUID == false){
                        $str = md5(uniqid(mt_rand(), true));
                        $uuid  = substr($str,0,8);
                        $uuid .= substr($str,8,4);
                        $uuid .= substr($str,12,4);
                        $uuid .= substr($str,16,4);
                        $uuid .= substr($str,20,12);
                        $db = new DB;
                        $db->query("SELECT * FROM `user` WHERE `kgx_address`='" . $uuid . "'");
                        if ($db->num_rows() == 0) {
                            $checkUUID = true;
                            $kgx_address = $uuid;
                        }
                    }
                    
                    $db = new DB;
                    $db->query("INSERT INTO `user` VALUES (null, '" . $_POST['name'] . "', '" . $_POST['account'] . "', '" . $_POST['email'] . "', '" . md5(md5($_POST['pw'])) . "', '" . md5(md5($_POST['transpw'])) . "', '" . $_POST['countryCode'] . "', '" . $_POST['mobile'] . "', '', 0);");
                    
                    $db = new DB;
                    $db->query("SELECT `userID`, `username`, `mail`, `phone`, `kgx_address` FROM `user` WHERE `username`='" . $_POST['account'] . "' AND `mail`='" . $_POST['email'] . "'");
                    $r                        = $db->fetch_assoc();
                    
                    $db = new DB;
                    $db->query("UPDATE `user` SET `kgx_address`='" . $kgx_address . "' WHERE `userID`='" . $r['userID'] . "' AND `username`='" . $r['username'] . "' AND `mail`='" . $r['mail'] . "'");
                    
                    $_SESSION['userID']       = $r['userID'];
                    $_SESSION['username']     = $r['username'];
                    $_SESSION['mail']         = $r['mail'];
                    $_SESSION['phone']        = $r['phone'];
                    $_SESSION['kgx_address']  = $kgx_address;
                    
                    $dateTime = date("Y-m-d H:i:s");
                    
                    //推薦代碼給付 5 kgx
                    /*
                    if ($recommend_code) {
                        $db = new DB;
                        $db->query("UPDATE `recommend_code` SET `userID`='". $_SESSION['userID'] ."', `status`='1'  WHERE `no`='" . $recommend_code_no . "'");
                        
                        //新增訂單
                        $db = new DB;
                        $db->query("SELECT * FROM `rate_history` ORDER BY `no` DESC LIMIT 0,1");
                        $r = $db->fetch_assoc();
                        $db = new DB;
                        $db->query("INSERT INTO `order_history` VALUES (null, '" . $dateTime . "', '" . $_SESSION['userID'] . "', '1', '0', '0', '5', '', '', '', '1', '1', '" . $r['rate'] . "', '" . $r['rate'] . "', '');");
                        
                        //進行匯款
                        $db = new DB;
                        $db->query("UPDATE `user` SET `kgx`='5' WHERE `userID`='" . $_SESSION['userID'] . "'");
                        //統計發行數量
                        $db = new DB;
                        $db->query("SELECT * FROM `issue_number`");
                        $r = $db->fetch_assoc();
                        $db = new DB;
                        $db->query("UPDATE `issue_number` SET `issue_number`='". ($r['issue_number'] + 5) ."' WHERE `no`='1'");
                    }
                    */
                    /*
                    //贈送 10 kgx，5萬枚為止
                    $db = new DB;
                    $db->query("SELECT * FROM `gift` WHERE `amount` < 50000");
                    if ($db->num_rows() > 0) {
                        $r = $db->fetch_assoc();
                        $db = new DB;
                        $db->query("UPDATE `gift` SET `amount`='" . ($r['amount'] + 10) . "' WHERE `no`='1'");
                        if ($recommend_code) {
                            //新增訂單
                            $db = new DB;
                            $db->query("SELECT * FROM `rate_history` ORDER BY `no` DESC LIMIT 0,1");
                            $r = $db->fetch_assoc();
                            $db = new DB;
                            $db->query("INSERT INTO `order_history` VALUES (null, '" . $dateTime . "', '" . $_SESSION['userID'] . "', '1', '0', '0', '10', '', '', '', '1', '1', '" . $r['rate'] . "', '" . $r['rate'] . "', '');");
                            //進行匯款
                            $db = new DB;
                            $db->query("UPDATE `user` SET `kgx`='15' WHERE `userID`='" . $_SESSION['userID'] . "'");
                            //統計發行數量
                            $db = new DB;
                            $db->query("SELECT * FROM `issue_number`");
                            $r = $db->fetch_assoc();
                            $db = new DB;
                            $db->query("UPDATE `issue_number` SET `issue_number`='". ($r['issue_number'] + 10) ."' WHERE `no`='1'");
                        } else {
                            //新增訂單
                            $db = new DB;
                            $db->query("SELECT * FROM `rate_history` ORDER BY `no` DESC LIMIT 0,1");
                            $r = $db->fetch_assoc();
                            $db = new DB;
                            $db->query("INSERT INTO `order_history` VALUES (null, '" . $dateTime . "', '" . $_SESSION['userID'] . "', '1', '0', '0', '10', '', '', '', '1', '1', '" . $r['rate'] . "', '" . $r['rate'] . "', '');");
                            //進行匯款
                            $db = new DB;
                            $db->query("UPDATE `user` SET `kgx`='10' WHERE `userID`='" . $_SESSION['userID'] . "'");
                            //統計發行數量
                            $db = new DB;
                            $db->query("SELECT * FROM `issue_number`");
                            $r = $db->fetch_assoc();
                            $db = new DB;
                            $db->query("UPDATE `issue_number` SET `issue_number`='". ($r['issue_number'] + 10) ."' WHERE `no`='1'");
                        }
                    }
                    */
                    echo 'ok';
                }
            } else {
                echo 'error';
            }
        } else {
            echo 'inputNull';
        }
        break;
}
?>