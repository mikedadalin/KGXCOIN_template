<?php
  $title = '會員登入';
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
              <form class="form-horizontal form-material" id="signinform" action="signin">
                <h3 class="box-title m-b-20">KGX會員登入</h3>

                <div class="floating-labels">
                  <div class="form-group m-b-40">
                    <input type="text" name="input-account" id="input-account" class="form-control" value="" required="" aria-required="true">
                    <span class="bar"></span>
                    <label for="input-account">帳號</label>
                  </div>

                  <div class="form-group m-b-40">
                    <input type="password" name="input-pw" id="input-pw" class="form-control form-control-lg" value="" required="" aria-required="true">
                    <span class="bar"></span>
                    <label for="input-pw">密碼</label>
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

                <div class="form-group clearfix">
                  <div class="col-md-12">
                    <div class="checkbox checkbox-primary pull-left p-t-0">
                      <input id="checkbox-signup" type="checkbox">
                      <label for="checkbox-signup"> 記住我 </label>
                    </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> 忘記密碼?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                  <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">登　入</button>
                  </div>
                </div>
                <div class="form-group m-b-0">
                  <div class="col-sm-12 text-center">
                    <p>還沒有帳號? <a href="signup.php" class="text-info m-l-5"><b>註冊一個</b></a></p>
                  </div>
                </div>
              </form>

              <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                  <div class="col-xs-12">
                    <h3>忘了密碼?</h3>
                    <p class="text-muted">請填入您的Email，系統將發送驗證信給您，收到驗證碼後請點擊鏈結重新設定新密碼</p>
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
  </section>

  <?php include_once('templates/footer.php'); ?>
  
  <!-- Scripts
  =====================================-->
  <script src="assets/scripts/funcs.min.js"></script>
  <script src="assets/scripts/functions.js"></script>


  <!-- Temp Scripts
  =====================================-->
  <script>
    
  </script>

</body>
</html>