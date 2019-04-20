<?php
  $title = '優惠活動';
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
          <!-- <h3> </h3> -->

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">現價 KGX = 0.2 USD</h1>
              <p class="lead">為了縮短ICO時間我們 不定時發佈優惠活動3大優惠：</p>
            </div>
          </div>

          <div class="row">
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img1.jpg" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">優惠1</h3>
                  <p>購買100,000顆KGX</p>
                  <h4 class="text-primary">每顆 0.1 USD</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">購買</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img2.jpg" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">優惠2</h3>
                  <p>購買70,000顆KGX</p>
                  <h4 class="text-primary">每顆 0.12 USD</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">購買</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-4'>
              <div class="card">
                <img class="card-img-top img-responsive" src="assets/images/promo/img3.jpg" alt="Card image cap">
                <div class="card-body text-center">
                  <h3 class="text-info">優惠3</h3>
                  <p>購買3,000顆KGX</p>
                  <h4 class="text-primary">每顆 0.14 USD</h4>
                  <div class="form-group text-center m-t-20">
                    <div class="col-12">
                      <button class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">購買</button>
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

  <!-- Temp Scripts
  =====================================-->
  <script>

    $('.card .btn').on('click', function() {
      promoToKgx();
    })
    // Promo to KGX
    function promoToKgx(){
      swal({
        title: "確認購買優惠1",
        text: "100,000KGX 總計10,000USD",
        type: "info",
        showCancelButton: true,
        cancelButtonText: '取消',
        confirmButtonText: '確認'
      })
      .then((result) => {
        if (result.value) {
          swal(
          '感謝您的購買',
          '即將前往支付頁面',
          'success'
          );
          console.log('前往支付頁面');
        } else {
          swal("您已取消購買!");
        }
      });
    }
  </script>

</body>
</html>