<?php
  $title = '购买KGX 令牌';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>
<?php
//支付寶
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'assets/class/alipay/wappay/service/AlipayTradeService.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'assets/class/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
require dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'assets/class/alipay/config.php';
if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!="") {
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = $_POST['WIDout_trade_no'];

    //订单名称，必填
    $subject = '游戏充值';

    //付款金额，必填
    $total_amount = $_POST['WIDtotal_amount'];

    //商品描述，可空
    $body = '贩售游戏点数 ' . $_POST['WIDbody'] .' 枚';

    //超时时间
    $timeout_express="1m";

    $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setOutTradeNo($out_trade_no);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setTimeExpress($timeout_express);

    $payResponse = new AlipayTradeService($config);
    $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

    return ;
}
?>
<?php
/*
//每日限額
$kgx_amount = 0;
$start = date("Y-m-d H:i:s",strtotime(date("Y-m-d")));
$end = date("Y-m-d H:i:s",strtotime(date("Y-m-d")) + 86400);
$db = new DB;
$db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
if ($db->num_rows() > 0) {
    for ($i=0;$i<$db->num_rows();$i++) {
        $r = $db->fetch_assoc();
        if ($r['confirm_remittance'] == 1 && $r['complete'] == 1) {
            $kgx_amount += $r['kgx_amount'];
        }
    }
}
*/
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

  <section>
    <div class="container">
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-2">
          <?php include_once('templates/sidebar.php'); ?>
        </div>

        <div class="col-md-8 col-lg-7">
          <h3>请选择购买方式</h3>
          <!--
          <h5>※每日每人限購 20,000 KGX</h5>
          <h5>※今日您已購買 <font id="today_buy"><?php //echo $kgx_amount; ?></font> KGX</h5>
          -->
          <nav class="nav nav-tabs tabsline">
            <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="#nav_buytype_btc" onclick="changeCurrency(2);">比特币</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_eth" onclick="changeCurrency(3);">乙太坊</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_ltc" onclick="changeCurrency(4);">莱特币</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_cny" onclick="changeCurrency(6);">CNY</a>
            <?php
                if ($_SESSION['username'] == "liao" || $_SESSION['username'] == "isin168") {
                    echo '<a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_customized" onclick="">客製</a>';
                    $db = new DB;
                    $db->query("SELECT `adjustment` FROM `issue_number` WHERE `no`='1'");
                    $r = $db->fetch_assoc();
                    $adjustment = $r['adjustment'];
                }
            ?>
          </nav>
          <input type="hidden" id="currency_type_id" value="2">

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav_buytype_btc" role="tabpanel" aria-labelledby="nav_buytype_btc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3><span id="previewKGX-1">0</span> KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3><span id="previewBTC">0</span> BTC</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="BtcToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000" value="<?php echo $_SESSION['promo_kgx'] ?>">
                      <span class="help-block text-muted"><small> </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade show" id="nav_buytype_eth" role="tabpanel" aria-labelledby="nav_buytype_eth">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3><span id="previewKGX-2">0</span> KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3><span id="previewETH">0</span> ETH</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="EthToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000" value="<?php echo $_SESSION['promo_kgx'] ?>">
                      <span class="help-block text-muted"><small> </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade show" id="nav_buytype_ltc" role="tabpanel" aria-labelledby="nav_buytype_ltc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3><span id="previewKGX-3">0</span> KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3><span id="previewLTC">0</span> LTC</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="LtcToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000" value="<?php echo $_SESSION['promo_kgx'] ?>">
                      <span class="help-block text-muted"><small> </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade show" id="nav_buytype_cny" role="tabpanel" aria-labelledby="nav_buytype_cny">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3><span id="previewKGX-4">0</span> KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3><span id="previewCNY">0</span> CNY</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="CnyToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小 50 CNY，最多 20,000 KGX" value="<?php echo $_SESSION['promo_kgx'] ?>">
                      <span class="help-block text-muted"><small> </small></span>
                    </div>
                    <div class="form-group">
                      <label for="bank_flag">转出银行</label>
                      <select class="form-control" id="bank_flag">
                        <!--<option value="ALIPAY">支付宝</option>-->
                        <option value="unionpayq">快捷支付</option>
                        <option value="unionpay">網銀支付</option>
                        <option value="unionpayc">銀聯掃碼</option>
                        <option value="alipayOrg">支付宝 (#維護中，請勿使用)</option>
                        
                        <option value="ABC">农业银行</option>
                        <option value="CCB">建设银行</option>
                        <option value="SPDB">浦发银行</option>
                        <option value="CIB">兴业银行</option>
                        <option value="CMBC">民生银行</option>
                        <option value="BCM">交通银行</option>
                        <option value="CNCB">中信银行</option>
                        <option value="CEB">光大银行</option>
                        <option value="CMB">招商银行</option>
                        <option value="GDB">广发银行</option>
                        <option value="BOC">中国银行</option>
                        <option value="HXB">华夏银行</option>
                        <option value="PAB">平安银行</option>
                        <option value="PSBC">中国邮政</option>
                        <option value="SDB">深圳发展银行</option>
                        <option value="BCCB">北京银行</option>
                        <option value="SHB">上海银行</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade" id="nav_buytype_customized" role="tabpanel" aria-labelledby="nav_buytype_customized">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入調整令牌数</label>
                      <input type="number" id="adjustment" class="form-control form-control-lg" min="0" placeholder="请输入調整令牌数" value="<?php echo $adjustment; ?>">
                      <span class="help-block text-muted"><small></small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade show" id="nav_buytype_bank" role="tabpanel" aria-labelledby="nav_buytype_bank">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>7 RMB</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="bankToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000">
                      <span class="help-block text-muted"><small> 最小1 最多20000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>

            <div class="tab-pane fade show" id="nav_buytype_alipay" role="tabpanel" aria-labelledby="nav_buytype_alipay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>7 RMB</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="alipayToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000">
                      <span class="help-block text-muted"><small> 最小1 最多20000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_wechatpay" role="tabpanel" aria-labelledby="nav_buytype_wechatpay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>7 RMB</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">请输入购买令牌数</label>
                      <input type="number" id="wechatpayToKgx" class="form-control form-control-lg" min="1" max="20000" placeholder="最小1 最多20000">
                      <span class="help-block text-muted"><small> 最小1 最多20000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">确认送出</button>
              </div>
            </div>
            
          </div>

        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card card-outline-info">
            <div class="card-body bg-info">
              <p class="c text-white">最新汇率</p>
              <h4 class="text-white card-title">1 KGX = <a id="rateKGXtoUSD-content"></a> USD</h4>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">1 BTC = <a id="rateBTCtoKGX-content"></a> KGX</li>
              <li class="list-group-item">1 ETH = <a id="rateETHtoKGX-content"></a> KGX</li>
              <li class="list-group-item">1 LTC = <a id="rateLTCtoKGX-content"></a> KGX</li>
              <li class="list-group-item">1 CNY = <a id="rateCNYtoKGX-content"></a> KGX</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once('templates/footer.php'); ?>
  <?php unset($_SESSION['promo_kgx']); ?>

  <!-- Scripts
  =====================================-->
  <script src="assets/scripts/funcs.min.js"></script>
  <script src="assets/scripts/functions.js"></script>
  <script src="assets/scripts/trans_buygx.js"></script>
  <?php
  if ($_SESSION['username'] == "liao" || $_SESSION['username'] == "isin168") {
    echo '<script src="assets/scripts/adjustment.js"></script>';
  }
  ?>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>