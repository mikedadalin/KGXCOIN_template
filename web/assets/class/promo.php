<?php
session_start();
include("DB.php");

$db = new DB;
foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($db->conn, $v);
}

switch ($_POST['action']) {
    case 'promo':
        $_SESSION['promo_kgx'] = $_POST['kgx'];
        break;
}
?>