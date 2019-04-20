<?php
session_start();
include("../DB.php");

switch ($_POST['action']) {
    case 'signupMail':
        $mailTitle = 'KGX - 註冊成功';
        break;
}
$_POST['mobile'] = substr_replace($_POST['mobile'],'xxxx',(strlen($_POST['mobile'])-4),4);

// 信件內容
$Show_To_Client = '
    <div style="font-family: \'Roboto\',\'sans-serif\'; text-align: center; color: rgb(100,100,100); font-size: 14px;");">
        <div style="padding: 20px; font-weight: bold; color: rgb(34,177,76); font-size: 20px;">' . $mailTitle . '</div>
        <table align="center">
            <tr>
                <td style="padding: 10px;">帐号 : ' . $_POST['account'] . '</td>
            </tr>
            <tr>
                <td style="padding: 10px;">Email : ' . $_POST['email'] . '</td>
            </tr>
            <tr>
                <td style="padding: 10px;">手机号 : ' . $_POST['mobile'] . '</td>
            </tr>
            <tr>
                <td style="padding: 10px;">恭喜註冊成功</td>
            </tr>
        </table>
    </div>
';


include("PHPMailerAutoload.php");


//===== 寄信到 User 信箱 ===================================
mb_internal_encoding('UTF-8');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host     = "ssl://smtp.mxhichina.com"; //設定SMTP主機 
$mail->Port     = 465; //設定SMTP埠位，預設為25埠。 
//$mail->CharSet = "big5"; //設定郵件編碼

$mail->Username = "service@kgxcoin.com";
$mail->Password = "zzYil6s*ghf";
//mail帳號密碼

$mail->FromName  = "KGX";
// 寄件者名稱(自己要顯示的名稱)
$webmaster_email = "service@kgxcoin.com";
//回覆信件至此信箱
$mail->From      = $webmaster_email;
//設定寄件者信箱
$email           = $_POST['email'];
// 收件者信箱
$name            = $_POST['account'];
// 收件者的名稱or暱稱


$mail->AddAddress($email, $name);
$mail->AddReplyTo($webmaster_email, "Squall.f");

$mail->WordWrap = 50;

$mail->IsHTML(true);

$mail->Subject = $mailTitle;
// 信件標題

$mail->Body = $Show_To_Client;

if (!$mail->Send()) {
    //echo "寄信發生錯誤：" . $mail->ErrorInfo;
    //如果有錯誤會印出原因
} else {
    echo "ok";
}
//============================================================
?>