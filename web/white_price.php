<?php
  $title = 'KGXCOIN 即将来临的价格';

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
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-3">
          <?php include_once('templates/white_sidebar.php'); ?>
        </div>

        <div class="col-lg-9">

          <div class="kgxFuturePrice">

            <h2>KGXCOIN 硬币的价格预期在未来将会大幅上涨</h2>

            <p>阶段涨势图</p>
            <p><img src="assets/images/white/price1.png" alt="阶段涨势图" class="img-fluid"></p>

            <p>按月涨势图</p>
            <p><img src="assets/images/white/price2.png" alt="按月涨势图" class="img-fluid"></p>

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