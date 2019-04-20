<?php
  $title = '交易面板';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>
<?php
$db = new DB;
$db->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $_SESSION['userID'] . "'");
$r = $db->fetch_assoc();
$kgx = $r['kgx'];
?>
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

  <section class="section-trans">
    <div class="container">
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-2">
          <?php include_once('templates/sidebar.php'); ?>
        </div>

        <div class="col-lg-10">
          <h3>最新汇率</h3>
          <div class="row exchange">
            <div class="col-lg-3 col-6">
              <div class="card card-inverse card-primary" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6"><img src="assets/images/logo/kgx_revert.svg" class="img-responsive"></div>
                    <div class="col-6 p-0">
                      <h3 class="card-title">1 KGX</h3>
                      <h5 class="card-subtitle mb-2 text-mute"><a id="rateKGXtoUSD-content"></a> 美元</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="card card-inverse card-success" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6"><img src="assets/images/logo/bitcoin_revert.svg" class="img-responsive"></div>
                    <div class="col-6 p-0">
                      <h3 class="card-title">1 BTC</h3>
                      <h5 class="card-subtitle mb-2 text-mute"><a id="rateBTCtoKGX-content"></a> KGX</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="card card-inverse card-dark" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6"><img src="assets/images/logo/eth_revert.svg" class="img-responsive"></div>
                    <div class="col-6 p-0">
                      <h3 class="card-title">1 ETH</h3>
                      <h5 class="card-subtitle mb-2 text-mute"><a id="rateETHtoKGX-content"></a> KGX</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="card card-inverse card-megna" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6"><img src="assets/images/logo/litecoin_revert.svg" class="img-responsive"></div>
                    <div class="col-6 p-0">
                      <h3 class="card-title">1 LTC</h3>
                      <h5 class="card-subtitle mb-2 text-mute"><a id="rateLTCtoKGX-content"></a> KGX</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" style="">
            <div class="card-body">
              <h3 class="card-title">KGX 趋势</h3>
              <div id="kgx-chart" style="width:100%;height:210px;"></div>
            </div>
          </div>

          <h3>资产中心</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="">
                <div class="card-body" style="height: 226px;">
                  <h3 class="card-title">KGX 钱包</h3>
                  <div class="text-right">
                    <p class="card-text kgxInWallet"><font id="trans_KGX"><?php echo $kgx; ?></font> KGX</p>
                    <hr>
                    <p class="card-text" id="trans_KGXToUSD">= 0 美元</p>
                  </div>
                  <div class="text-center">
                    <a href="trans_buygx.php" class="btn btn-primary">购买令牌</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body" style="height: 226px;">
                  <h3 class="card-title">存入纪录</h3>
                  <div class="table-responsive">
                      <table class="mb-0 table">
                          <thead>
                              <tr class="text-nowrap">
                                  <th>交易序号</th>
                                  <th>日　期</th>
                                  <th>状　态</th>
                                  <th>换得KGX</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' ORDER BY `no` DESC LIMIT 0,2");
                                if ($db->num_rows() > 0) {
                                    for ($i = 0; $i < $db->num_rows(); $i++) {
                                        $r = $db->fetch_assoc();
                                        switch ($r['confirm_remittance']) {
                                            case 0:
                                                $status = '<span class="label label-warning">等待付款</span>';
                                                break;
                                            case 1:
                                                switch ($r['complete']) {
                                                    case 0:
                                                        $status = '<span class="label label-warning">等待完成交易</span>';
                                                        break;
                                                    case 1:
                                                        $status = '<span class="label label-success">成功</span>';
                                                        break;
                                                    case 2:
                                                        $status = '<span class="label label-danger">失效</span>';
                                                        break;
                                                }
                                                break;
                                            case 2:
                                                $status = '<span class="label label-danger">撤銷</span>';
                                                break;
                                            case 3:
                                                $status = '<span class="label label-danger">超時</span>';
                                                break;
                                        }
                                        echo '
                                        <tr>
                                            <td>'.$r['no'].'</td>
                                            <td>'.date("Y-m-d",strtotime($r['dateTime'])).'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$r['kgx_amount'].'</td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="4" style="text-align: center;">尚无历史纪录</td>
                                    </tr>
                                    ';
                                }
                            ?>
                          </tbody>
                      </table>
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
  <script src="assets/scripts/trans.js"></script>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>