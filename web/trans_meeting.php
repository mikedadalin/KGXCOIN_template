<?php
  $title = '与创始人见面';
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
          <h3>与创始人见面报名</h3>

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">输入对方KGX专属接受地址</h4>
              
              <p>
                KGXCOIN 于交易所提供后，创始人将会与全球领袖见面传授如何使用机器人挖矿KGXCOIN，让全球领袖更有另一个事业的起端，我们预计有上千人的领袖参与开放日期地点将密切注意公告：
              </p>

              <h4>报名与创始人见面</h4>
              <ol>
                <li>真实护照英文：</li>
                <li>比特币或以太坊地址：</li>
                <li>上传拍照订购机票与价格：</li>
              </ol>

              <h4>报名资格：</h4>
              <p>持有KGX令牌总值10万美金45天以上，并奖励10% KGX</p>
              <p>持有KGX令牌总值10万美金90天以上，并奖励20% KGX</p>
              <p>存入总价值/总KGX 数：<?php echo $USD_amount; ?> 美金/ <?php echo $KGX_amount; ?> KGX</p>

              <div class="row justify-content-md-center">
                <div class="text-center col-8">
                  <button type="button" class="btn btn-lg btn-secondary btn-block btn-kgxout">即刻报名</button>
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