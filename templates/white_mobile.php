<?php
  $title = '白皮書摘要';

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

  <section class="section-white">
    <div class="container">

      <div class="row">
        <div class="col-lg-3">
          <?php include_once('templates/white_sidebar.php'); ?>
        </div>

        <div class="col-lg-9">
          <h3>KGXCOIN 移动应用程序</h3>

          <div class="row">
            <div class="col-md-6">
              <img src="assets/images/white/mobile_walle.png" alt="">
              <h4>钱包</h4>
              <p>您可以轻松创建自己的钱包以方便操作。</p>
            </div>

            <div class="col-md-6">
              <img src="assets/images/white/mobile_trans.png" alt="">
              <h4>交易</h4>
              <p>鼓励投资者使用KGX 移动应用程序购买代币。</p>
            </div>

            <div class="col-md-6">
              <img src="assets/images/white/mobile_deposit.png" alt="">
              <h4>存款和转帐</h4>
              <p>通过KGX 专有黑科技区块链应用程序可更快转帐或存款。检查交易记录。</p>
            </div>

            <div class="col-md-6">
              <img src="assets/images/white/mobile_ios_android.png" alt="">
              <h4>Android 和IOS 版本</h4>
              <p>应用程序将被开发，包括所有功能，并可用于安卓和IOS。</p>
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
    
  </script>

</body>
</html>