<?php
  $title = '安全验证';
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
          <h3>信箱验证</h3>

          <div class="row justify-content-center">

            <div class="col-12 col-md-6">
              <div class="card">
                <div class="card-body">
                  <form class="form-horizontal form-material" id="signinform" action="signin">
                    <h3 class="box-title m-b-20">进行安全验证</h3>
                    <p>验证完成后，日后每当进行转出交易时，系统将会发送验证码到您的信箱，请在交易时输入验证码才能完成交易</p>

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12 getValideCode">
                        <button class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light" type="button">点击获取验证码</button>
                      </div>
                    </div>

                    <div class="floating-labels">
                      <div class="form-group m-b-40">
                        <input type="text" name="input-validecode" id="input-validecode" class="form-control" value="" required="" aria-required="true">
                        <span class="bar"></span>
                        <label for="input-valideCode">验证码</label>
                      </div>

                    </div>

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12 valideCodeSuccess">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">验证</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div> <!-- card end -->

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
        '验证码已发送',
        '包含验证码的讯息已传送至Email(y****u@g*****.*om)，请立即接收并填入验证码',
        'success'
      )
    }
    function valideCodeSuccess(){
      swal(
        '恭喜您已完成验证',
        '日后每当进行转出交易时，系统将会发送验证码到您的信箱，请在交易时输入验证码才能完成交易',
        'success'
      )
    }
  </script>

</body>
</html>