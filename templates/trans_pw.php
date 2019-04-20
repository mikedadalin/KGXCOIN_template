<?php
  $title = '重設密碼';
?>

<?php include_once('templates/header.php'); ?>

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
          <h3>重設新密碼</h3>

          <div class="row justify-content-center">

            <div class="col-12 col-lg-6">

              <div class="login-box card">
                <div class="card-body">
                  <form class="form-horizontal form-material" id="signinform" action="signin">
                    <h3 class="box-title m-b-20">重設新密碼</h3>

                    <div class="floating-labels">

                      <div class="form-group m-b-40">
                        <input type="password" name="input-pw" id="input-pw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-pw">目前密碼</label>
                      </div>

                      <div class="form-group m-b-40">
                        <input type="password" name="input-newpw" id="input-newpw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-newpw">新密碼</label>
                      </div>

                      <div class="form-group m-b-40">
                        <input type="password" name="input-repw" id="input-repw" class="form-control form-control-lg" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-repw">重新輸入新密碼</label>
                      </div>

                      <div class="form-group">
                        <label class="control-label">郵件驗證碼</label>

                        <div class="form-inline row">
                          <div class="form-group mx-sm-3 ">
                            <input type="text" class="form-control" id="staticEmail2" value="email@example.com">
                          </div>
                          <button type="submit" class="btn btn-danger mailGetValicode">發送驗證碼</button>
                        </div>
                        <span class="help-block text-muted"><small> </small></span>
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

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">提　交</button>
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

    $('.getValideCode .btn').on('click', function() {
      getValideCode();
    })
    $('.valideCodeSuccess .btn').on('click', function() {
      valideCodeSuccess();
    })
    // Promo to KGX
    function getValideCode(){
      swal(
        '驗證碼已發送',
        '包含驗證碼的訊息已傳送至Email(y****u@g*****.*om)，請立即接收並填入驗證碼',
        'success'
      )
    }
    function valideCodeSuccess(){
      swal(
        '恭喜您已完成驗證',
        '日後每當進行轉出交易時，系統將會發送驗證碼到您的信箱，請在交易時輸入驗證碼才能完成交易',
        'success'
      )
    }
  </script>

</body>
</html>