<?php
  $title = '会员登入';
?>

<?php include_once('templates/header.php'); ?>
<?php
/*
// geetest 驗證
require_once 'assets/class/gt3-php-sdk-master/lib/class.geetestlib.php';
require_once 'assets/class/gt3-php-sdk-master/lib/class.geetestlib.php';
require_once 'assets/class/gt3-php-sdk-master/config/config.php';
$GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
session_start();
$data = array(
        "client_type" => "unknown", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
        "ip_address" => $_SERVER["REMOTE_ADDR"] # 请在此处传输用户请求验证时所携带的IP
    );
$status = $GtSdk->pre_process($data, 1);
$_SESSION['gtserver'] = $status;
$_SESSION['user_id'] = $data['user_id'];
//echo $_SESSION['gtserver'].'<br>'.$_SESSION['user_id'].'<br>'.$GtSdk->get_response_str();
*/
?>
<?php checkSignin(1); ?>
<?php $_SESSION['ali_captcha'] = false; ?>
 <!--
==================================== -->

  <div class="page-header-section">
    <div class="container">
      <div class="page-header-area">
        <div class="page-header-content">
          <h2><?php echo $title; ?></h2>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">

      <div class="row justify-content-center">

        <div class="col-12 col-lg-5">

          <div class="login-box card">
            <div class="card-body">
              <form class="form-horizontal form-material" name="signinform" id="signinform">
                <h3 class="box-title m-b-20">KGX会员登入</h3>

                <div class="floating-labels">
                  <div class="form-group m-b-40">
                    <input type="text" name="input-account" id="input-account" class="form-control" value="" required="" aria-required="true" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^d]/g,''))">
                    <span class="bar"></span>
                    <label for="input-account">帐号</label>
                  </div>

                  <div class="form-group m-b-40">
                    <input type="password" name="input-pw" id="input-pw" class="form-control form-control-lg" value="" required="" aria-required="true" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^d]/g,''))">
                    <span class="bar"></span>
                    <label for="input-pw">密码</label>
                  </div>
                </div>
                
                <!--騰訊
                <div class="form-group text-center m-t-20">
                  <button type="button" id="TencentCaptcha" data-appid="2000100641" data-cbfn="callback" class="btn btn-block btn-danger">验证</button>
                  <input type="hidden" id="ticket">
                  <input type="hidden" id="randstr">
                </div>
                -->
                <!--阿里雲
                <div id="your-dom-id" class="nc-container"></div>
                <input type="hidden" id="csessionid">
                <input type="hidden" id="token">
                <input type="hidden" id="sig">
                -->
                <div id="embed-captcha"></div>
                <p id="wait" class="show">正在加载验证码......</p>
                <p id="notice" class="hide">请先完成验证</p>

                <div class="form-group clearfix">
                  <div class="col-md-12">
                    <div class="checkbox checkbox-primary pull-left p-t-0">
                    </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> 忘记密码?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                  <div class="col-xs-12">
                    <button id="embed-submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button" onclick="signin();">登　入</button>
                  </div>
                </div>
                <div class="form-group m-b-0">
                  <div class="col-sm-12 text-center">
                    <p>还没有帐号? <a href="signup.php" class="text-info m-l-5"><b>注册一个</b></a></p>
                  </div>
                </div>
              </form>

              <form class="form-horizontal" name="recoverform" id="recoverform">
                <div class="form-group ">
                  <div class="col-xs-12">
                    <h3>忘了密码?</h3>
                    <p class="text-muted">请填入您的Email，系统将发送重设信件给您，收到后请点击链结重新设定新密码</p>
                  </div>
                </div>
                <div class="form-group ">
                  <div class="col-xs-12">
                    <input id="forgetPassword_mail" class="form-control" type="text" required="" placeholder="Email"> </div>
                </div>
                <div class="form-group text-center m-t-20">
                  <div class="col-xs-12">
                    <button class="btn btn-primary btn-lg btn-block " type="button" onclick="forgetPassword();">寄　送</button>
                  </div>
                </div>
              </form>
            </div>
          </div> <!-- login-box -->

        </div>

      </div>
    </div>
  </section>

  <?php include_once('templates/footer.php'); ?>
  
  <!-- Scripts
  =====================================-->
  <script src="assets/scripts/funcs.min.js"></script>
  <script src="assets/scripts/functions.js"></script>
  <script src="assets/class/gt3-php-sdk-master/static/gt.js"></script>
  <script src="assets/scripts/signin.js"></script>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>