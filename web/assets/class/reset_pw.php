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
    case 'reset_pw':
        if (!$inputNull) {
            
            $result = "";
            
            $db = new DB;
            $db->query("SELECT `no` FROM `forget_password_verification` WHERE `mail`='" . $_POST['mail'] . "' AND `verification_code`='" . $_POST['vercode'] . "'");
            if ($db->num_rows() > 0) {
                if($_POST['newpw'] != $_POST['re-newpw']) {
                    $result = 'newpwno';
                } else {
                    $db = new DB;
                    $db->query("DELETE FROM `forget_password_verification` WHERE `mail`='" . $_POST['mail'] . "'");
                    $db = new DB;
                    $db->query("UPDATE `user` SET `password`='" . md5(md5($_POST['newpw'])) . "' WHERE `mail`='" . $_POST['mail'] . "'");
                    $result = "ok";
                }
            } else {
                $result = 'vercodeno';
            }
            echo $result;
        } else {
            echo 'inputNull';
        }
        break;
}
?>