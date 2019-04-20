<?php
session_start();
include("DB.php");

$db = new DB;
$db->query("SELECT * FROM `order_history` WHERE `currency_type_id`='6' AND `confirm_remittance`='0'");
if ($db->num_rows() > 0) {
    for ($i = 0; $i < $db->num_rows(); $i++) {
        $r = $db->fetch_assoc();
        $time = time() - $r['create_time'];
        
        if ($r['id'] == 'show' || $r['id'] == 'jump' || $r['id'] == 'image') {
            if ($time >= 240) {
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `confirm_remittance`='3' WHERE `no`='" . $r['no'] . "'");
            }
        } elseif ($r['id'] == 'remit' || $r['id'] == 'online') {
            if ($time >= 900) {
                $db2 = new DB;
                $db2->query("UPDATE `order_history` SET `confirm_remittance`='3' WHERE `no`='" . $r['no'] . "'");
            }
        } else {
            $db2 = new DB;
            $db2->query("UPDATE `order_history` SET `confirm_remittance`='3' WHERE `no`='" . $r['no'] . "'");
        }
    }
}
?>