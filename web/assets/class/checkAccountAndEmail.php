<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'check':
        $db = new DB;
        $db->query("SELECT * FROM `user` WHERE `username`='" . $_POST['account'] . "'");
        if ($db->num_rows() > 0) {
            echo 'account';
        } else {
            $db = new DB;
            $db->query("SELECT * FROM `user` WHERE `mail`='" . $_POST['email'] . "'");
            if ($db->num_rows() > 0) {
                echo 'email';
            } else {
                $db = new DB;
                $db->query("SELECT * FROM `user` WHERE (`countryCode`='' OR `countryCode`='" . $_POST['countryCode'] . "') AND `phone`='" . $_POST['mobile'] . "'");
                if ($db->num_rows() > 0) {
                    echo 'mobile';
                } else {
                    echo 'ok';
                }
            }
        }
        break;
}
?>