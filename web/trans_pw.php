<?php
  $title = '重设密码';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>

 <!--
==================================== -->

  <div class="page-header-section">
    <div class="container">
      <div class="page-header-area">
        <div class="page-header-content">
          <h2 class='pull-left'><?php echo $title; ?></h2>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-2">
          <?php include_once('templates/sidebar.php'); ?>
        </div>

        <div class="col-lg-10">
          <h3>重设新密码</h3>

          <div class="row justify-content-center">

            <div class="col-12 col-lg-6">

              <div class="login-box card">
                <div class="card-body">
                  <form class="form-horizontal form-material" id="tran_pw_form" name="tran_pw_form" action="">
                    <h3 class="box-title m-b-20">重设新密码</h3>

                    <div class="floating-labels">

                      <div class="form-group m-b-40">
                        <input type="password" name="input-pw" id="input-pw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-pw">目前密码</label>
                      </div>

                      <div class="form-group m-b-40">
                        <input type="password" name="input-newpw" id="input-newpw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-newpw">新密码</label>
                      </div>

                      <div class="form-group m-b-40">
                        <input type="password" name="input-repw" id="input-repw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-repw">重新输入新密码</label>
                      </div>

                      <div class="form-group">
                        <div class="form-inline row getValideCode">
                          <div class="form-group mx-sm-3 ">
                            <input type="text" class="form-control" id="verificationCode" value="">
                          </div>
                          <button type="button" class="btn btn-danger mailGetValicode">发送验证码</button>
                        </div>
                        <label for="verificationCode" class="control-label">邮件验证码</label>
                        <span class="help-block text-muted"><small> </small></span>
                      </div>

                    </div>
                    
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button id="tran_pw_button" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">提　交</button>
                      </div>
                    </div>

                  </form>

                  <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <h3>忘了密码?</h3>
                        <p class="text-muted">请填入您的Email，系统将发送验证信给您，收到验证码后请点击链结重新设定新密码</p>
                      </div>
                    </div>
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block " type="submit">寄　送</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div> <!-- login-box -->

            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

  <?php include_once('templates/footer.php'); ?>
  

  <!-- Scripts
  =====================================-->
  <script src="assets/scripts/funcs.min.js"></script>
  <script src="assets/scripts/functions.js"></script>
  <script src="assets/scripts/trans_pw.js"></script>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>