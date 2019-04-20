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
    case 'transfer':
        if (!$inputNull && is_numeric($_POST['amount'])) {
            $db = new DB;
            $db->query("SELECT * FROM `transfer_verification` WHERE `userID`='" . $_SESSION['userID'] . "' AND `transfer_address`='" . $_POST['address'] . "' AND `verification_code`='" . $_POST['verificationCode'] . "'");
            if ($db->num_rows() > 0) {
                $r = $db->fetch_assoc();
                
                $db = new DB;
                $db->query("DELETE FROM `transfer_verification` WHERE `no`='" . $r['no'] . "'");
                
                //確認餘額
                $db = new DB;
                $db->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $_SESSION['userID'] . "'");
                if ($db->num_rows() > 0) {
                    $r = $db->fetch_assoc();
                    if ($r['kgx'] >= $_POST['amount']) {
                        $kgxA = $r['kgx'];
                        
                        $db2 = new DB;
                        $db2->query("SELECT `userID`, `kgx_address`, `kgx` FROM `user` WHERE `kgx_address`='" . $_POST['address'] . "'");
                        if ($db2->num_rows() > 0) {
                            $r2 = $db2->fetch_assoc();
                            $kgxB = $r2['kgx'];
                            
                            $dateTime = date("Y-m-d H:i:s");
                            
                            //新增匯款
                            $db = new DB;
                            $db->query("INSERT INTO `transfer_history` VALUES (null, '" . $dateTime . "', '" . $_SESSION['userID'] . "', '" . $_POST['address'] . "', '" . $_POST['amount'] . "', '0', '" . $kgxA . "', '" . $kgxB . "');");
                            
                            //進行匯款
                            $db = new DB;
                            $db->query("UPDATE `user` SET `kgx`='" . ($kgxA-$_POST['amount']) . "' WHERE `userID`='" . $_SESSION['userID'] . "'");
                            $db = new DB;
                            $db->query("UPDATE `user` SET `kgx`='" . ($kgxB+$_POST['amount']) . "' WHERE `userID`='" . $r2['userID'] . "'");
                            $db = new DB;
                            $db->query("UPDATE `transfer_history` SET `complete`='1', `a_balance`='" . ($kgxA-$_POST['amount']) ."', `b_balance`='" . ($kgxB+$_POST['amount']) ."' WHERE `dateTime`='" . $dateTime . "' AND `userID`='" . $_SESSION['userID'] . "' AND `transfer_address`='" . $r2['kgx_address'] . "'");
                            
                            echo 'ok';
                        } else {
                            echo 'address';
                        }
                    } else {
                        //餘額不足
                        echo 'no';
                    }
                } else {
                    //餘額不足
                    echo 'no';
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