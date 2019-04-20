<?php
session_start();
include("../DB.php");

//產生驗證碼
$VerificationCode_len = 6;
$VerificationCode     = '';
$word                 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$len                  = strlen($word);

for ($i = 0; $i < $VerificationCode_len; $i++) {
    $VerificationCode .= $word[rand() % $len];
}

$otherContent = '';

switch ($_POST['action']) {
    case 'email':
        $Show_To_Client_ID = 1;
        $mailTitle = 'KGX註冊 - 郵箱驗證碼';
        $db = new DB;
        $db->query("INSERT INTO `signup_verification` VALUES (null, '" . date('Y-m-d H:i:s') . "', '" . $_POST['email'] . "', '" . $VerificationCode . "');");
        $_SESSION['mail'] = $_POST['email'];
        $_SESSION['username'] = '您好';
        break;
    case 'transfer':
        $Show_To_Client_ID = 2;
        $mailTitle = 'KGX轉出 - 驗證碼';
        $db = new DB;
        $db->query("INSERT INTO `transfer_verification` VALUES (null, '" . date('Y-m-d H:i:s') . "', '" . $_SESSION['userID'] . "', '" . $_POST['address'] . "', '" . $VerificationCode . "');");
        break;
    case 'changePassword':
        $Show_To_Client_ID = 3;
        $mailTitle = 'KGX變更密碼 - 驗證碼';
        $db = new DB;
        $db->query("INSERT INTO `change_password_verification` VALUES (null, '" . date('Y-m-d H:i:s') . "', '" . $_SESSION['userID'] . "', '" . $VerificationCode . "');");
        break;
    case 'forgetPassword':
        $Show_To_Client_ID = 4;
        $mailTitle = 'KGX忘記密碼 - 驗證碼';
        $db = new DB;
        $db->query("SELECT `username` FROM `user` WHERE `mail`='" . $_POST['email'] . "'");
        $r = $db->fetch_assoc();
        
        $db = new DB;
        $db->query("INSERT INTO `forget_password_verification` VALUES (null, '" . date('Y-m-d H:i:s') . "', '" . $_POST['email'] . "', '" . $VerificationCode . "');");
        $_SESSION['mail'] = $_POST['email'];
        $_SESSION['username'] = $r['username'].' 您好';
        break;
}

// 信件內容
switch ($Show_To_Client_ID) {
    case 1:
        $Show_To_Client = '
      <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background-color:#eeeeee">
         <tbody>
            <tr>
               <td>
                  <table id="" border="0" cellspacing="0" cellpadding="0" align="center" style="width:640px;padding-left:20px;padding-right:20px;border-collapse:separate">
                     <tbody>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="40" width="100%" style="background:#ffffff;border-radius:8px">
                                             <tbody>
                                                <tr>
                                                   <td id="" style="background-color:#ffffff;border-radius:6px">
                                                      <span style=";font-size:16px;line-height:22px;color:#424242">
                                                         <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                            <tbody>
                                                               <tr>
                                                                  <td id="" style="background-color:#ffffff;border-radius:6px">
                                                                     <span style=";font-size:16px;color:#424242">
                                                                        <table cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td width="40"></td>
                                                                                 <td width="500">
                                                                                    <cite style="text-align:center;display:block;font-style:normal" class="">
                                                                                       <span style="font-size:1px;height:0;color:#fff;display:block">We\'ve <span class="il">reset</span> your password as a precautionary measure.</span>            
                                                                                       <table cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0">
                                                                                          <tbody>
                                                                                             <tr>
                                                                                                <td align="center">
                                                                                                   <div style="width:100%">
                                                                                                       <a href="kgxcoin.com"><img src="http://kgxcoin.com/assets/images/logo.png" border="0" alt="Etsy" height="34" class="CToWUd"></a>
                                                                                                   </div>
                                                                                                </td>
                                                                                             </tr>
                                                                                          </tbody>
                                                                                       </table>
                                                                                    </cite>
                                                                                    <table cellspacing="0" cellpadding="0" width="100%">
                                                                                       <tbody>
                                                                                          <tr>
                                                                                             <td height="40"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td>
                                                                                                <h1 style="margin:0;padding:0;font-size:21px;font-weight:bold;color:#5b5b5b;text-align:center;text-decoration:none">
                                                                                                   ' . $mailTitle . '
                                                                                                </h1>
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">验证码 : ' . $VerificationCode . '</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                       </tbody>
                                                                                    </table>
                                                                                 </td>
                                                                                 <td width="40"></td>
                                                                              </tr>
                                                                              <tr height="20">
                                                                                 <td></td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </span>
                                                                     <div style="background-color:#eeeeee;height:1px;color:#ffffff"></div>

                                                                  </td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td height="18"></td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="padding-bottom:10px">
                                             <tbody>
                                                <tr>
                                                   <td id="" valign="top" width="127">
                                                      <a href="https://kgxcoin.com/" target="_blank" data-saferedirecturl="#">KGXCOIN</a>                                                     
                                                   </td>
                                                   <td id="" valign="top" align="right" width="*" style="font-size:11px;line-height:15px;color:#9d9d9d">
                                                       <span class="">kgxcoin.com<br></span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>';
        break;
    case 2:
        $Show_To_Client = '
      <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background-color:#eeeeee">
         <tbody>
            <tr>
               <td>
                  <table id="" border="0" cellspacing="0" cellpadding="0" align="center" style="width:640px;padding-left:20px;padding-right:20px;border-collapse:separate">
                     <tbody>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="40" width="100%" style="background:#ffffff;border-radius:8px">
                                             <tbody>
                                                <tr>
                                                   <td id="" style="background-color:#ffffff;border-radius:6px">
                                                      <span style=";font-size:16px;line-height:22px;color:#424242">
                                                         <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                            <tbody>
                                                               <tr>
                                                                  <td id="" style="background-color:#ffffff;border-radius:6px">
                                                                     <span style=";font-size:16px;color:#424242">
                                                                        <table cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td width="40"></td>
                                                                                 <td width="500">
                                                                                    <cite style="text-align:center;display:block;font-style:normal" class="">
                                                                                       <span style="font-size:1px;height:0;color:#fff;display:block">We\'ve <span class="il">reset</span> your password as a precautionary measure.</span>            
                                                                                       <table cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0">
                                                                                          <tbody>
                                                                                             <tr>
                                                                                                <td align="center">
                                                                                                   <div style="width:100%">
                                                                                                       <a href="kgxcoin.com"><img src="http://kgxcoin.com/assets/images/logo.png" border="0" alt="Etsy" height="34" class="CToWUd"></a>
                                                                                                   </div>
                                                                                                </td>
                                                                                             </tr>
                                                                                          </tbody>
                                                                                       </table>
                                                                                    </cite>
                                                                                    <table cellspacing="0" cellpadding="0" width="100%">
                                                                                       <tbody>
                                                                                          <tr>
                                                                                             <td height="40"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td>
                                                                                                <h1 style="margin:0;padding:0;font-size:21px;font-weight:bold;color:#5b5b5b;text-align:center;text-decoration:none">
                                                                                                   ' . $mailTitle . '
                                                                                                </h1>
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">验证码 : ' . $VerificationCode . '</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                       </tbody>
                                                                                    </table>
                                                                                 </td>
                                                                                 <td width="40"></td>
                                                                              </tr>
                                                                              <tr height="20">
                                                                                 <td></td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </span>
                                                                     <div style="background-color:#eeeeee;height:1px;color:#ffffff"></div>

                                                                  </td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td height="18"></td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="padding-bottom:10px">
                                             <tbody>
                                                <tr>
                                                   <td id="" valign="top" width="127">
                                                      <a href="https://kgxcoin.com/" target="_blank" data-saferedirecturl="#">KGXCOIN</a>                                                     
                                                   </td>
                                                   <td id="" valign="top" align="right" width="*" style="font-size:11px;line-height:15px;color:#9d9d9d">
                                                       <span class="">kgxcoin.com<br></span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>';
        break;
    case 3:
        $Show_To_Client = '
      <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background-color:#eeeeee">
         <tbody>
            <tr>
               <td>
                  <table id="" border="0" cellspacing="0" cellpadding="0" align="center" style="width:640px;padding-left:20px;padding-right:20px;border-collapse:separate">
                     <tbody>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="40" width="100%" style="background:#ffffff;border-radius:8px">
                                             <tbody>
                                                <tr>
                                                   <td id="" style="background-color:#ffffff;border-radius:6px">
                                                      <span style=";font-size:16px;line-height:22px;color:#424242">
                                                         <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                            <tbody>
                                                               <tr>
                                                                  <td id="" style="background-color:#ffffff;border-radius:6px">
                                                                     <span style=";font-size:16px;color:#424242">
                                                                        <table cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td width="40"></td>
                                                                                 <td width="500">
                                                                                    <cite style="text-align:center;display:block;font-style:normal" class="">
                                                                                       <span style="font-size:1px;height:0;color:#fff;display:block">We\'ve <span class="il">reset</span> your password as a precautionary measure.</span>            
                                                                                       <table cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0">
                                                                                          <tbody>
                                                                                             <tr>
                                                                                                <td align="center">
                                                                                                   <div style="width:100%">
                                                                                                       <a href="kgxcoin.com"><img src="http://kgxcoin.com/assets/images/logo.png" border="0" alt="Etsy" height="34" class="CToWUd"></a>
                                                                                                   </div>
                                                                                                </td>
                                                                                             </tr>
                                                                                          </tbody>
                                                                                       </table>
                                                                                    </cite>
                                                                                    <table cellspacing="0" cellpadding="0" width="100%">
                                                                                       <tbody>
                                                                                          <tr>
                                                                                             <td height="40"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td>
                                                                                                <h1 style="margin:0;padding:0;font-size:21px;font-weight:bold;color:#5b5b5b;text-align:center;text-decoration:none">
                                                                                                   ' . $mailTitle . '
                                                                                                </h1>
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">验证码 : ' . $VerificationCode . '</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                       </tbody>
                                                                                    </table>
                                                                                 </td>
                                                                                 <td width="40"></td>
                                                                              </tr>
                                                                              <tr height="20">
                                                                                 <td></td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </span>
                                                                     <div style="background-color:#eeeeee;height:1px;color:#ffffff"></div>

                                                                  </td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td height="18"></td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="padding-bottom:10px">
                                             <tbody>
                                                <tr>
                                                   <td id="" valign="top" width="127">
                                                      <a href="https://kgxcoin.com/" target="_blank" data-saferedirecturl="#">KGXCOIN</a>                                                     
                                                   </td>
                                                   <td id="" valign="top" align="right" width="*" style="font-size:11px;line-height:15px;color:#9d9d9d">
                                                       <span class="">kgxcoin.com<br></span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>';
        break;
    case 4:
        $Show_To_Client = '
      <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background-color:#eeeeee">
         <tbody>
            <tr>
               <td>
                  <table id="" border="0" cellspacing="0" cellpadding="0" align="center" style="width:640px;padding-left:20px;padding-right:20px;border-collapse:separate">
                     <tbody>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="40" width="100%" style="background:#ffffff;border-radius:8px">
                                             <tbody>
                                                <tr>
                                                   <td id="" style="background-color:#ffffff;border-radius:6px">
                                                      <span style=";font-size:16px;line-height:22px;color:#424242">
                                                         <table id="" border="0" cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                            <tbody>
                                                               <tr>
                                                                  <td id="" style="background-color:#ffffff;border-radius:6px">
                                                                     <span style=";font-size:16px;color:#424242">
                                                                        <table cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;border-radius:8px">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td width="40"></td>
                                                                                 <td width="500">
                                                                                    <cite style="text-align:center;display:block;font-style:normal" class="">
                                                                                       <span style="font-size:1px;height:0;color:#fff;display:block">We\'ve <span class="il">reset</span> your password as a precautionary measure.</span>            
                                                                                       <table cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0">
                                                                                          <tbody>
                                                                                             <tr>
                                                                                                <td align="center">
                                                                                                   <div style="width:100%">
                                                                                                       <a href="kgxcoin.com"><img src="http://kgxcoin.com/assets/images/logo.png" border="0" alt="Etsy" height="34" class="CToWUd"></a>
                                                                                                   </div>
                                                                                                </td>
                                                                                             </tr>
                                                                                          </tbody>
                                                                                       </table>
                                                                                    </cite>
                                                                                    <table cellspacing="0" cellpadding="0" width="100%">
                                                                                       <tbody>
                                                                                          <tr>
                                                                                             <td height="40"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td>
                                                                                                <h1 style="margin:0;padding:0;font-size:21px;font-weight:bold;color:#5b5b5b;text-align:center;text-decoration:none">
                                                                                                   忘记密码了吗？
                                                                                                </h1>
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">
                                                                                                没问题，我们很乐意帮你重设。
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">帳號 : ' . $r['username'] . '</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td style="margin:0;padding-bottom:0;font-size:15px;color:#5b5b5b;text-align:center;text-decoration:none">验证码 : ' . $VerificationCode . '</td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="10"></td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="52" style="text-align:center;padding:0;margin:0;width:100%;background:#559fca;border-radius:2px">
                                                                                                <a style="text-decoration:none;color:#fff;font-size:18px;font-weight:bold;display:block;width:100%;" href="https://kgxcoin.com/reset_pw.php" target="_blank">
                                                                                                重设您的密码
                                                                                                </a>
                                                                                             </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                             <td height="20"></td>
                                                                                          </tr>
                                                                                       </tbody>
                                                                                    </table>
                                                                                 </td>
                                                                                 <td width="40"></td>
                                                                              </tr>
                                                                              <tr height="20">
                                                                                 <td></td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </span>
                                                                     <div style="background-color:#eeeeee;height:1px;color:#ffffff"></div>

                                                                  </td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td height="18"></td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <table id="" border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="padding-bottom:10px">
                                             <tbody>
                                                <tr>
                                                   <td id="" valign="top" width="127">
                                                      <a href="https://kgxcoin.com/" target="_blank" data-saferedirecturl="#">KGXCOIN</a>                                                     
                                                   </td>
                                                   <td id="" valign="top" align="right" width="*" style="font-size:11px;line-height:15px;color:#9d9d9d">
                                                       <span class="">kgxcoin.com<br></span>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="" style="height:20px">
                              <div class="" style="height:20px;min-height:20px;max-height:20px;vertical-align:top;overflow:hidden"></div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>';
        break;
}


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
$email           = $_SESSION['mail'];
// 收件者信箱
$name            = $_SESSION['username'];
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