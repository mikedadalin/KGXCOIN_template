<?php
  $title = '購買KGX 令牌';
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

        <div class="col-md-8 col-lg-7">
          <h3>請選擇購買方式</h3>
          <nav class="nav nav-tabs tabsline">
            <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="#nav_buytype_btc">比特幣</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_eth">乙太坊</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_ltc">萊特幣</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_bank">銀聯</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_alipay">支付寶</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_wechatpay">微信</a>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav_buytype_btc" role="tabpanel" aria-labelledby="nav_buytype_btc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>0.0001 BTC</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="btcToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_eth" role="tabpanel" aria-labelledby="nav_buytype_eth">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>0.0001 ETH</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="EthToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_ltc" role="tabpanel" aria-labelledby="nav_buytype_ltc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <div class="row text-center">
                      <div class="col-4"><h3>1 KGX</h3></div>
                      <div class="col-4"><h3>=</h3></div>
                      <div class="col-4"><h3>0.0001 LTC</h3></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="LtcToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
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
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="bankToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
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
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="alipayToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
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
                      <label class="control-label">請輸入購買令牌數</label>
                      <input type="text" id="wechatpayToKgx" class="form-control form-control-lg" placeholder="最小100 最大100,000">
                      <span class="help-block text-muted"><small> 最小100 最大100,000 </small></span>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary btn-block">確認送出</button>
              </div>
            </div>
            
          </div>

        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card card-outline-info">
            <div class="card-body bg-info">
              <p class="c text-white">最新匯率</p>
              <h4 class="text-white card-title">1 KGX = 1 USD</h4>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">1 BTC = 2563 KGX</li>
              <li class="list-group-item">1 ETH = 256 KGX</li>
              <li class="list-group-item">1 LTC = 256 KGX</li>
            </ul>
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
    $('#nav_buytype_btc .btn').on('click', function() {
      coinToKgx();
    })
    $('#nav_buytype_eth .btn').on('click', function() {
      coinToKgx();
    })
    $('#nav_buytype_ltc .btn').on('click', function() {
      coinToKgx();
    })

    $('#nav_buytype_bank .btn').on('click', function() {
      cashToKgx();
    })
    $('#nav_buytype_alipay .btn').on('click', function() {
      cashToKgx();
    })
    $('#nav_buytype_wechatpay .btn').on('click', function() {
      cashToKgx();
    })

    // Virtual currenc to KGX
    function coinToKgx(){
      swal({
        title: "確認購買",
        text: "2 比特幣共可換得10,000個KGX令牌",
        type: "info",
        showCancelButton: true,
        cancelButtonText: '取消',
        confirmButtonText: '確認'
      })
      .then((result) => {
        if (result.value) {
          swal({
            type: "success",
            title: "感謝您的購買",
            text: "",
            html: "<div class='row'><div class='col-4'><img src='assets/images/qrcode.png' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請在三十分鐘內將XX幣轉入下列地址或是掃描二維碼以完成交易</label> <input type='text' id='input-addresscode' class='form-control' placeholder='0xcca393f638c53b084c40746b774dd8a7459865be' value='0xcca393f638c53b084c40746b774dd8a7459865be' aria-label='0xcca393f638c53b084c40746b774dd8a7459865be' aria-describedby='basic-addon2' readonly> <div class='input-group-append'> <button class='btn btn-outline-secondary btn-addresscopy' type='button' data-clipboard-target='#input-addresscode'><i class='fa fa-files-o'></i> 複製</button> </div></div></div></div>",
            confirmButtonColor: '#3085d6',
            confirmButtonClass: 'btn btn-danger',
            confirmButtonText: '關閉視窗',
            buttonsStyling: false
          });
        } else {
          swal("您已取消購買!");
        }
      });
    }

    // Cash to KGX
    function cashToKgx(){
      swal({
        title: "確認購買",
        text: "1,000RMB共換得100個KGX令牌",
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

  <script>
    var clipboard = new Clipboard('.btn-addresscopy');
    clipboard.on('success', function(e) {
      // console.info('Action:', e.action);
      // console.info('Text:', e.text);
      // console.info('Trigger:', e.trigger);
      toastr.success('恭喜您，複製地址成功~');
      e.clearSelection();
    });
    clipboard.on('error', function(e) {
      // console.error('Action:', e.action);
      // console.error('Trigger:', e.trigger);
      toastr.error('複製地址失敗~');
    });
    
  </script>



</body>
</html>