<?php
  $title = '注册會員';
?>

<?php include_once('templates/header.php'); ?>

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
                <form class="form-horizontal form-material" id="signupform" action="signup">
                  <h3 class="box-title m-b-20">註冊 KGX 會員</h3>

                  <div class="floating-labels">
                    <div class="form-group m-b-40">
                      <input type="text" name="input-account" id="input-account" class="form-control" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-account">帳號</label>
                    </div>

                    <div class="form-group m-b-40">
                      <input type="email" name="input-email" id="input-email" class="form-control" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-email">Email</label>
                    </div>

                    <div class="form-group m-b-40">
                      <input type="password" name="input-pw" id="input-pw" class="form-control" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-pw">密碼</label>
                    </div>

                    <div class="form-group m-b-40">
                      <input type="password" name="input-repw" id="input-repw" class="form-control form-control-lg" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-repw">重新輸入密碼</label>
                    </div>

                    <div class="form-group m-b-40">
                      <input type="password" name="input-transpw" id="input-transpw" class="form-control form-control-lg" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-transpw">交易密碼</label>
                      <span class="help-block text-muted"><small> 请输入4-6位數字交易密碼 </small></span>
                    </div>

                    <div class="form-group m-b-40">
                      <input type="text" name="input-mobile" id="input-mobile" class="form-control" value="" required="" aria-required="true" >
                      <span class="bar"></span>
                      <label for="input-mobile">手機號</label>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-body">
                      <div class="checkbox checkbox-primary p-10">
                        <input id="googlevalidator" type="checkbox">
                        <label for="googlevalidator"> 套用GOOGLE不是機器人驗證 </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group m-b-40">
                    <div class="col-md-12">
                      <div class="checkbox checkbox-primary p-t-0">
                        <input id="checkbox-signup" type="checkbox">
                        <label for="checkbox-signup"> 我已阅读并同意《KGX用户服务协议》 </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                      <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">註　冊</button>
                    </div>
                  </div>
                  <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                      <p>我是會員? <a href="signin.php" class="text-info m-l-5"><b>登入</b></a></p>
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

  <!-- Temp Scripts
  =====================================-->
  <script>
    $('form .btn').on('click', function() {
      signUpSuccess();
    })

    // Sign up success
    function signUpSuccess(){
      swal(
        'XXX 歡迎您的加入',
        '即刻前往KGX市場，體驗KGX的強大魅力',
        'success')
      .then((result) => {
        window.location.replace("trans.php");
      });
    }
  </script>

</body>
</html>