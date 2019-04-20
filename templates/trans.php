<?php
  $title = '交易面板';
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

  <section>
    <div class="container">
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-2">
          <?php include_once('templates/sidebar.php'); ?>
        </div>

        <div class="col-lg-10">
          <h3>最新汇率</h3>
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="card card-inverse card-primary" style="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6"><img src="assets/images/logo/kgx_revert.svg" class="img-responsive"></div>
                    <div class="col-6 p-0">
                      <h3 class="card-title">1 KGX</h3>
                      <h5 class="card-subtitle mb-2 text-mute">1.0美元</h5>
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
                      <h5 class="card-subtitle mb-2 text-mute">259563 KGX</h5>
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
                      <h5 class="card-subtitle mb-2 text-mute">256美元</h5>
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
                      <h5 class="card-subtitle mb-2 text-mute">256美元</h5>
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
                  <p class="card-text">6000GX</p>
                  <a href="#" class="btn btn-primary">购买令牌</a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
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
                            <tr>
                              <td>7b1020e2</td>
                              <td>2018/01/01</td>
                              <td><span class="label label-success">成功</span></td>
                              <td>5,000</td>
                            </tr>
                            <tr>
                              <td>7b1020e2</td>
                              <td>2018/01/01</td>
                              <td><span class="label label-warning">等待付款</span></td>
                              <td>5,000</td>
                            </tr>
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
  

  <!-- Temp Scripts
  =====================================-->
  <script>
    var data = {
      labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'],
      series: [
    [
      {meta: 'USD', value: 1.00},
      {meta: 'USD', value: 1.01},
      {meta: 'USD', value: 1.03},
      {meta: 'USD', value: 1.024},
      {meta: 'USD', value: 1.042},
      {meta: 'USD', value: 1.03},
      {meta: 'USD', value: 1.045},
      {meta: 'USD', value: 1.055},
      {meta: 'USD', value: 1.067},
      {meta: 'USD', value: 1.06},
      {meta: 'USD', value: 1.045},
      {meta: 'USD', value: 1.048},
      {meta: 'USD', value: 1.05},
      {meta: 'USD', value: 1.053},
      {meta: 'USD', value: 1.065}
    ]
      ]
    };

    var options = {
      axisX: {
        labelInterpolationFnc: function(value) {
          return '01/' + value;
        }
      },
      low: 1.0,
      high: 1.08,
      fullWidth: true,
      plugins: [
        Chartist.plugins.tooltip()
      ]
    };

    var responsiveOptions = [
      ['screen and (min-width: 641px) and (max-width: 1024px)', {
        showPoint: false,
        axisX: {
          labelInterpolationFnc: function(value) {
            return 'Week ' + value;
          }
        }
      }],
      ['screen and (max-width: 640px)', {
        showLine: false,
        axisX: {
          labelInterpolationFnc: function(value) {
            return 'W' + value;
          }
        }
      }]
    ];

    new Chartist.Line('#kgx-chart', data, options, responsiveOptions);

    var defaultOptions = {
      threshold: 0,
      classNames: {
        aboveThreshold: 'ct-threshold-above',
        belowThreshold: 'ct-threshold-below'
      },
      maskNames: {
        aboveThreshold: 'ct-threshold-mask-above',
        belowThreshold: 'ct-threshold-mask-below'
      }
    };

  </script>

</body>
</html>