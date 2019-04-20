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
    case 'trans_pw':
        if (!$inputNull) {
            
            $result = "";

            $db = new DB;
            // validate verify code 
            $db->query("SELECT `no` FROM `change_password_verification` WHERE `userID`='" .$_SESSION['userID'] . "' AND `verification_code`='" . $_POST['vercode'] . "'");
            if ($db->num_rows() > 0) {
                $r                    = $db->fetch_assoc();
                
                // the verfiy code is right, then delete the record in database
                $db->query("DELETE FROM `change_password_verification` WHERE `userID`='" . $_SESSION['userID'] . "'");

                // validate old password enter correct or not   
                $db->query("SELECT `password` FROM `user` WHERE `userID`='" .$_SESSION['userID'] . "' AND `password`='" . md5(md5($_POST['oldpw'])) . "'");
                if ($db->num_rows() > 0) {
                    $r                     = $db->fetch_assoc();                
                    
                    // validate old password and new password the same or not
                    if($_POST['oldpw'] == $_POST['newpw']) {
                        $result = 'thesameno';
                    } else {
                        // validate new password and re-enter new password
                        if($_POST['newpw'] != $_POST['re-newpw']) {
                            // password enter different
                            $result = 'newpwno';
                            // passed all validation 
                        } else {
                                $db->query("UPDATE `user` SET `password`='" . md5(md5($_POST['newpw'])) . "' WHERE `userID`='" . $_SESSION['userID'] . "'");
                                $result = "ok";
                        }
                    }
                }
                // the oldpw doesn't match the password in database
                else {
                    $result = 'oldpwno';
                }
            }
            else {
                //  verify code is wrong
                $result = 'vercodeno';
            }
            

            echo $result;

        } else {
            echo 'inputNull';
        }
        break;
}
?>