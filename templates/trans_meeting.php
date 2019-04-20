<?php
  $title = '與創始人見面';
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
          <h3>與創始人見面報名</h3>

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">輸入對方KGX專屬接受地址</h4>
              <!-- <h6 class="card-subtitle">存入KGX COIN紀錄</h6> -->
              
              <p>
                KGXCOIN 於交易所提供後，創始人將會與全球領袖見面傳授如何使用機器人挖礦KGXCOIN，讓全球領袖更有另一個事業的起端，我們預計有上千人的領袖參與開放日期地點將密切注意公告：
              </p>
              <h4>報名與創始人見面</h4>
              <ol>
                <li>真實護照英文：</li>
                <li>比特幣或以太坊地址：</li>
                <li>上傳拍照訂購機票與價格：</li>
              </ol>

              <p>報名資格：持有KGX令牌總值20萬美金90天以上，並獎勵10%KGX</p>
              <p>持有KGX令牌總值20萬美金180天以上，並獎勵20%KGX</p>
              <p>存入KGX令牌：存入枚 到達20萬美金自動倒數剩餘？天</p>
              <p>提領枚隨時能取出，低於20萬美金 天數重新歸0</p>
              <p>存入總價值/總KGX 數：？？美金/？？KGX</p>

              <div class="row justify-content-md-center">
                <div class="text-center col-8">
                  <button type="button" class="btn btn-lg btn-primary btn-block btn-kgxout">即刻報名</button>
                </div>
              </div>

            </div>
          </div> <!-- End card -->

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