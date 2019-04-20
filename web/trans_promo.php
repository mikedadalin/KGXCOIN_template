<?php
  $title = '优惠活动';
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

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">现价 1 KGX = <a id="rateKGXtoUSD-content"></a> USD</h1>
              <p class="lead">为了缩短ICO时间我们 不定时发布优惠活动3大优惠：</p>
            </div>
          </div>

          <div class="row">
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img1.png" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">优惠1</h3>
                  <p>购买6万美金</p>
                  <h4 class="text-primary">低于现价30%</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button onclick="promo(1);" class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light"  type="button">购买</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img2.png" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">优惠2</h3>
                  <p>购买4万美金</p>
                  <h4 class="text-primary">低于限价20%</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button onclick="promo(2);" class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="button">购买</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img3.png" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">优惠3</h3>
                  <p>购买2万美金</p>
                  <h4 class="text-primary">低于现价10%</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button onclick="promo(3);" class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="button">购买</button>
                    </div>
                  </div>
                </div>
              </div>
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
  <script src="assets/scripts/trans_promo.js"></script>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>