<?php
function checkSignin($type) {
    $result = false;
    $db = new DB;
    $db->query("SELECT * FROM `user` WHERE `userID`='" . $_SESSION['userID'] . "'");
    if ($db->num_rows() > 0) {
        $r = $db->fetch_assoc();
        if ($_SESSION['userID'] == $r['userID'] && $_SESSION['username'] == $r['username'] && $_SESSION['mail'] == $r['mail'] && $_SESSION['phone'] == $r['phone'] && $_SESSION['kgx_address'] == $r['kgx_address']) {
            $result = true;
        }
    }
    switch ($type) {
        case 0:
            if (!$result) {
                unset($_SESSION);
                echo "<script type='text/javascript'>window.location.href='signin.php'</script>"; 
                exit;
            }
            break;
        case 1:
            if ($result) {
                echo "<script type='text/javascript'>window.location.href='trans.php'</script>"; 
                exit;
            }
            break;
    }
}
?>