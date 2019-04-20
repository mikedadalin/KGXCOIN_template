<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'goToOnlineOrder':
        $db = new DB;
        $db->query("SELECT * FROM `order_history` WHERE `no`='" . $_POST['order_id'] . "' AND `userID`='" . $_SESSION['userID'] . "' AND `confirm_remittance`!='1'");
        if ($db->num_rows() > 0) {
            $r = $db->fetch_assoc();
			if ($r['address'] == 'ALIPAY') {
				$type = 'qrcode';
			} else {
				$type = 'online';
			}
            //產生付款轉跳網址
            $data = 'cid=201&uid=' . $_SESSION['userID'] . '&time=' . time() . '&amount=' . $r['currency_amount'] . '&order_id=' . $r['no'] . '&ip=' . $_SERVER["REMOTE_ADDR"];
            $dig64 = base64_encode(hash_hmac('sha1', $data, 'n11w4mzndYtMnWZiARUbAaSojJBLIYD7Aiot0waF03uMI7n6BwnuJchLgLooFWDk', true));
            $url = 'https://www.dsdfpay.com/dsdf/customer_pay/init_din?' . $data . '&sign=' . $dig64 . '&type=' . $type . '&tflag=' . $r['address'];
            //回傳付款網址
            echo 'ok||'.$url;
        } else {
            echo 'no';
        }
        break;
}
?>