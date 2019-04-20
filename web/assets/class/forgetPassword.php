<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'forgetPassword':
        $db = new DB;
        $db->query("SELECT * FROM `user` WHERE `mail`='" . $_POST['mail'] . "'");
        if ($db->num_rows() > 0) {
            echo 'ok';
        } else {
            echo 'no';
        }
        break;
}
?>