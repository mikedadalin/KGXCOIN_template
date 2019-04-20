<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'checkTodayBuyKgx':
        $result = '';
        $kgx_amount = 0;
        $start = date("Y-m-d H:i:s",strtotime(date("Y-m-d")));
        $end = date("Y-m-d H:i:s",strtotime(date("Y-m-d")) + 86400);
        $db = new DB;
        $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
        if ($db->num_rows() > 0) {
            for ($i=0;$i<$db->num_rows();$i++) {
                $r = $db->fetch_assoc();
                if ($r['confirm_remittance'] == 1 && $r['complete'] == 1) {
                    $kgx_amount += $r['kgx_amount'];
                }
            }
        }
        if ($_POST['amount'] <= (20000 - $kgx_amount)) {
            $result .= 'ok||' . $kgx_amount;
        } else {
            $result .= 'no||' . $kgx_amount . '||' . (20000 - $kgx_amount);
        }
        echo $result;
        break;
}
?>