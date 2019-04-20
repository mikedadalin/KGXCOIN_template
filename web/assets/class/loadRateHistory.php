<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'loadRateHistory':
        $result = '';
        $db = new DB;
        $db->query("SELECT * FROM `rate_history`");
        $data_num = $db->num_rows();
        if ($data_num < 5) {
            $data_num = 0;
        } else {
            $data_num = $data_num - 5;
        }
        $db = new DB;
        $db->query("SELECT * FROM `rate_history` ORDER BY `no` ASC LIMIT ".$data_num.",5");
        for ($i=0;$i<$db->num_rows();$i++) {
            $r = $db->fetch_assoc();
            $result .= '||'.date('m/d H:i',strtotime($r['dateTime'])).'_'.$r['rate'];
        }
        echo $result;
        break;
}
?>