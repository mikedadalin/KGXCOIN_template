<?php
  $title = '奖励';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>
<?php
    $KGX_amount = 0;
    $USD_amount = 0;
    $db = new DB;
    $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `complete`='1'");
    if ($db->num_rows() > 0) {
        for ($i = 0; $i < $db->num_rows(); $i++) {
            $r = $db->fetch_assoc();
            $KGX_amount += $r['kgx_amount'];
            $USD_amount += ($r['kgx_amount']*$r['ratio2']);
        }
    }
?>
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

          <h2 class="text-center m-b-30">奖励资格</h2>

          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body text-center">
                  <p>持有KGX股份总值10万美金45天以上</p>
                  <h2>奖励10%KGX</h2>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body text-center">
                  <p>持有KGX股份总值10万美金90天以上</p>
                  <h2>奖励20%KGX</h2>
                </div>
              </div>
            </div>
          </div>


          <div class="card card-inverse card-success">
            <div class="card-body text-center">
              <h3 class="text-white">持有总价值/总KGX 数：<small> <?php echo $USD_amount; ?> 美金/ <?php echo $KGX_amount; ?> KGX</small></h3>
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