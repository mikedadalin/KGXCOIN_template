<?php
  $title = '资产中心';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>
<?php
$db = new DB;
$db->query("SELECT `kgx` FROM `user` WHERE `userID`='" . $_SESSION['userID'] . "'");
$r = $db->fetch_assoc();
$kgx = $r['kgx'];
$show_data_num = 20;
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

  <section class="section-transWallet">
    <div class="container">
      <?php include_once('templates/sidebarbtn.php'); ?>

      <div class="row">
        <div class="col-lg-2">
          <?php include_once('templates/sidebar.php'); ?>
        </div>

        <div class="col-lg-10">

          <div class="card" style="">
            <div class="card-body">
              <h3 class="card-title float-left">KGX 钱包</h3>
              <div class="text-right">
                <p class="card-text kgxInWallet"><?php echo $kgx; ?> KGX</p>
              </div>
            </div>
          </div>

          <h3>交易纪录</h3>
          <nav class="nav nav-tabs tabsline">
            <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="#nav_buytype_btc">比特币</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_eth">乙太坊</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_ltc">莱特币</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_buytype_cny">CNY</a>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav_buytype_btc" role="tabpanel" aria-labelledby="nav_buytype_btc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>KGX/USD</th>
                                    <th>交易地址</th>
                                    <th>备  注</th>
                                </tr>
                            </thead>
                            <tbody id="btc_history">
                              <?php
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='2' ORDER BY `no` DESC");
                                $data_num = $db->num_rows();
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='2' ORDER BY `no` DESC LIMIT 0," . $show_data_num . "");
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
                                            <td>'.$r['currency_amount'].'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$r['kgx_amount'].'</td>
                                            <td>'.$r['ratio2'].'</td>
                                            <td>'.$r['address'].'</td>
                                            <td></td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="8" style="text-align: center;">尚无历史纪录</td>
                                    </tr>
                                    ';
                                }
                              ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" onclick="viewPrePage('BTC');">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <input id="btc_page" type="hidden" value="1">
                                <input id="btc_page_num" type="hidden" value="<?php echo ceil($data_num/$show_data_num); ?>">
                                <li id="page-item-btc-1" class="page-item active"><a class="page-link" onclick="viewPage('BTC',1);">1</a></li>
                                <?php
                                for ($i=1;$i<ceil($data_num/$show_data_num);$i++) {
                                    echo '
                                        <li id="page-item-btc-'.($i+1).'" class="page-item"><a class="page-link" onclick="viewPage(\'BTC\','.($i+1).');">' . ($i+1) . '</a></li>
                                    ';
                                }
                                ?>
                                <li class="page-item" onclick="viewNextPage('BTC');">
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
            <div class="tab-pane fade" id="nav_buytype_eth" role="tabpanel" aria-labelledby="nav_buytype_eth">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>KGX/USD</th>
                                    <th>交易地址</th>
                                    <th>备  注</th>
                                </tr>
                            </thead>
                            <tbody id="eth_history">
                              <?php
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='3' ORDER BY `no` DESC");
                                $data_num = $db->num_rows();
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='3' ORDER BY `no` DESC LIMIT 0," . $show_data_num . "");
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
                                            <td>'.$r['currency_amount'].'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$r['kgx_amount'].'</td>
                                            <td>'.$r['ratio2'].'</td>
                                            <td>'.$r['address'].'</td>
                                            <td></td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="8" style="text-align: center;">尚无历史纪录</td>
                                    </tr>
                                    ';
                                }
                              ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" onclick="viewPrePage('ETH');">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <input id="eth_page" type="hidden" value="1">
                                <input id="eth_page_num" type="hidden" value="<?php echo ceil($data_num/$show_data_num); ?>">
                                <li id="page-item-eth-1" class="page-item active"><a class="page-link" onclick="viewPage('ETH',1);">1</a></li>
                                <?php
                                for ($i=1;$i<ceil($data_num/$show_data_num);$i++) {
                                    echo '
                                        <li id="page-item-eth-'.($i+1).'" class="page-item"><a class="page-link" onclick="viewPage(\'ETH\','.($i+1).');">' . ($i+1) . '</a></li>
                                    ';
                                }
                                ?>
                                <li class="page-item" onclick="viewNextPage('ETH');">
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

            <div class="tab-pane fade" id="nav_buytype_ltc" role="tabpanel" aria-labelledby="nav_buytype_ltc">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>KGX/USD</th>
                                    <th>交易地址</th>
                                    <th>备  注</th>
                                </tr>
                            </thead>
                            <tbody id="ltc_history">
                              <?php
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='4' ORDER BY `no` DESC");
                                $data_num = $db->num_rows();
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='4' ORDER BY `no` DESC LIMIT 0," . $show_data_num . "");
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
                                            <td>'.$r['currency_amount'].'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$r['kgx_amount'].'</td>
                                            <td>'.$r['ratio2'].'</td>
                                            <td>'.$r['address'].'</td>
                                            <td></td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="8" style="text-align: center;">尚无历史纪录</td>
                                    </tr>
                                    ';
                                }
                              ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" onclick="viewPrePage('LTC');">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <input id="ltc_page" type="hidden" value="1">
                                <input id="ltc_page_num" type="hidden" value="<?php echo ceil($data_num/$show_data_num); ?>">
                                <li id="page-item-ltc-1" class="page-item active"><a class="page-link" onclick="viewPage('LTC',1);">1</a></li>
                                <?php
                                for ($i=1;$i<ceil($data_num/$show_data_num);$i++) {
                                    echo '
                                        <li id="page-item-ltc-'.($i+1).'" class="page-item"><a class="page-link" onclick="viewPage(\'LTC\','.($i+1).');">' . ($i+1) . '</a></li>
                                    ';
                                }
                                ?>
                                <li class="page-item" onclick="viewNextPage('LTC');">
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



            <div class="tab-pane fade" id="nav_buytype_cny" role="tabpanel" aria-labelledby="nav_buytype_cny">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>KGX/USD</th>
                                    <th>备  注</th>
                                </tr>
                            </thead>
                            <tbody id="cny_history">
                              <?php
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='6' ORDER BY `no` DESC");
                                $data_num = $db->num_rows();
                                $db = new DB;
                                $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='6' ORDER BY `no` DESC LIMIT 0," . $show_data_num . "");
                                if ($db->num_rows() > 0) {
                                    for ($i = 0; $i < $db->num_rows(); $i++) {
                                        $r = $db->fetch_assoc();
                                        switch ($r['confirm_remittance']) {
                                            case 0:
                                                if ($_POST['from_bank_flag'] == 'unionpay' || $_POST['from_bank_flag'] == 'unionpayq' || $_POST['from_bank_flag'] == 'unionpayc' || $_POST['from_bank_flag'] == 'alipayOrg') {
                                                    $status = '<span class="label label-warning">等待付款</span>';
                                                } else {
                                                    $status = '<span class="label label-warning">等待付款</span> <a class="label label-light-primary" onclick="goToPay(\''.$r['no'].'\',\''.$r['id'].'\',\''.$r['address'].'\',\''.$r['qr'].'\',\''.$r['currency_amount'].'\');">前往付款</a>';
                                                }
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
                                            <td>'.$r['currency_amount'].'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$r['kgx_amount'].'</td>
                                            <td>'.$r['ratio2'].'</td>
                                            <td></td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="7" style="text-align: center;">尚无历史纪录</td>
                                    </tr>
                                    ';
                                }
                              ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" onclick="viewPrePage('CNY');">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <input id="cny_page" type="hidden" value="1">
                                <input id="cny_page_num" type="hidden" value="<?php echo ceil($data_num/$show_data_num); ?>">
                                <li id="page-item-cny-1" class="page-item active"><a class="page-link" onclick="viewPage('CNY',1);">1</a></li>
                                <?php
                                for ($i=1;$i<ceil($data_num/$show_data_num);$i++) {
                                    echo '
                                        <li id="page-item-cny-'.($i+1).'" class="page-item"><a class="page-link" onclick="viewPage(\'CNY\','.($i+1).');">' . ($i+1) . '</a></li>
                                    ';
                                }
                                ?>
                                <li class="page-item" onclick="viewNextPage('CNY');">
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

            <div class="tab-pane fade" id="nav_buytype_bank" role="tabpanel" aria-labelledby="nav_buytype_bank">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>系统回传交易单号</th>
                                    <th>备  注</th>
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

            <div class="tab-pane fade" id="nav_buytype_alipay" role="tabpanel" aria-labelledby="nav_buytype_alipay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>系统回传交易单号</th>
                                    <th>备  注</th>
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
            <div class="tab-pane fade" id="nav_buytype_wechatpay" role="tabpanel" aria-labelledby="nav_buytype_wechatpay">
              <div class="p-t-20 p-b-20">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">存入历史纪录</h4>
                    <h6 class="card-subtitle">存入KGX COIN纪录</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>交易序号</th>
                                    <th>日　期</th>
                                    <th>存款总量</th>
                                    <th>状　态</th>
                                    <th>换得KGX数量</th>
                                    <th>系统回传交易单号</th>
                                    <th>备  注</th>
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
  <script src="assets/scripts/trans_wallet.js"></script>
  <!-- Temp Scripts
  =====================================-->

</body>
</html>