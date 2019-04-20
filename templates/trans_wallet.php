<?php
  $title = '資產中心';
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
          <h3>交易紀錄</h3>
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
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_eth" role="tabpanel" aria-labelledby="nav_buytype_eth">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_ltc" role="tabpanel" aria-labelledby="nav_buytype_ltc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_bank" role="tabpanel" aria-labelledby="nav_buytype_bank">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_alipay" role="tabpanel" aria-labelledby="nav_buytype_alipay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade show" id="nav_buytype_wechatpay" role="tabpanel" aria-labelledby="nav_buytype_wechatpay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入歷史紀錄</h4>
                    <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序號</th>
                                    <th>日　期</th>
                                    <th>存款總量</th>
                                    <th>狀　態</th>
                                    <th>換得KGX數量</th>
                                    <th>系統回傳交易單號</th>
                                    <th>備  註</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-warning">等待付款</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-danger">失效</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td>尚未支付</td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                              <tr>
                                <td>7b1020e2</td>
                                <td>2018/01/01</td>
                                <td>2</td>
                                <td><span class="label label-success">成功</span></td>
                                <td>5,000</td>
                                <td>b3625798b944bfd38a9a</td>
                                <td> </td>
                              </tr>
                                
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
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






</body>
</html>