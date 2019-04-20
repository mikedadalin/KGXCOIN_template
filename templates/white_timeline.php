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
          <h3>KGXCOIN 的时间线</h3>

          <div class="kgxcoinTimeline">
            <h3 class="text-center">最好价格$0.05</h3>

            <ul class="kgxcoinTimelineList">
              <li>2月15日 預售</li>
              <li>3月15日 集體銷售 第二階段</li>
              <li>4月15日 第二階段</li>
              <li>5月15日 第三階段</li>
            </ul>

            <div class="kgxcoinTimelineStart">
              <p>KGX 代币将在2018 年8 月8 日</p>
              <p>开始可在代币销售（ICO）</p>
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