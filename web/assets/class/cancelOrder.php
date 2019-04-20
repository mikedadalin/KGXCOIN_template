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
    case 'cancelOrder':
        if (!$inputNull) {
            $db = new DB;
            $db->query("SELECT * FROM `order_history` WHERE `no`='" . $_POST['order_id'] . "' AND `userID`='" . $_SESSION['userID'] . "'");
            if ($db->num_rows() > 0) {
                $r = $db->fetch_assoc();
                if ($r['confirm_remittance'] == 0 && $r['complete'] == 0) {
                    $data = array("cid" => 201, "order_id" => $_POST['order_id'], "time" => time());
                    $data_string = json_encode($data);
                    $dig64 = base64_encode(hash_hmac('sha1', $data_string, 'n11w4mzndYtMnWZiARUbAaSojJBLIYD7Aiot0waF03uMI7n6BwnuJchLgLooFWDk',true));
                    $ch = curl_init('https://www.dsdfpay.com/dsdf/api/revoke_order');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Content-Hmac:'.$dig64));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $result = json_decode($result,true);
                    //print_r($result);
                    $msg_arr = explode(' ',$result['msg']);
                    if ($result['success'] || $msg_arr[3] = 'timeout') {
                        $db = new DB;
                        $db->query("UPDATE `order_history` SET `confirm_remittance`='2' WHERE `no`='" . $_POST['order_id'] . "'");
                        echo 'ok';
                    }
                }
            }
        } else {
            echo 'inputNull';
        }
        break;
}
?>