<?php
    session_start();
    include('assets/class/DB.php');
    include('assets/class/function.php');
    checkSignin(0);
    $username_array = array("liao", "erictestapi", "isin168", "love1215520");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="KGX COIN">
  
  <meta name="author" content="KU">

  <title>KGX COIN - <?php echo $title; ?></title>

<!-- Mobile Specific Meta
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
  
  <!-- CSS
  ================================================== -->
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="assets/style/funcs.min.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/style/screen.css">


<style>
table {
    font-size: 15px;
    margin: 20px 0px;
    text-align: center;
    border-collapse: collapse;
    border-radius: 15px;
}
td {
    padding: 7px 15px;
    border: 1px rgb(180, 180, 180) solid;
}
input {
    font-size: 15px;
    text-align: center;
}
input[type="text"] {
    /*padding: 5px 15px;
    border-radius: 15px;*/
}
input[type="button"] {
    /*padding: 5px 15px;
    background-color: #fff;
    border-radius: 15px;*/
}
input[type="submit"] {
    /*padding: 5px 15px;
    background-color: #fff;
    border-radius: 15px;*/
}
.table_2 {
    background-color: #2a5172;
    color: #fff;
}
.table_2 td {
    border: 0px;
}
.tr_0 td {}
.tr_1 td {
    background-color: #c4e1ff;
}
.title {
    background-color: #19193c;
    color: #fff;
}
.content_r {
    text-align: right;
}
.note {
    border: 0px;
    text-align: left;
    color: #00aeae;
}
.status_0 {
    color: orange;
}
.status_1 {
    color: #01b468;
}
.status_2 {
    color: #8e8e8e;
}
.status_3 {
    color: #ff60af;
}
</style>
  <!-- Script -->
  <script src="assets/scripts/jquery-2.2.3.js"></script>
  <script src="assets/scripts/refreshRate.js"></script>
  <!--<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>-->
  <script type="text/javascript" charset="utf-8" src="//g.alicdn.com/sd/ncpc/nc.js?t=<?php echo date("YmdH"); ?>"></script>
</head>

<body id="body">
 <!--
  Start Preloader
  ==================================== -->
  <div id="preloader">
    <div class="preloader">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div>
  </div> 
  <!--
  End Preloader
  ==================================== -->


<!--
Fixed Navigation
==================================== -->
  <section class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <marquee direction="left">
                <ul id="rate-ul" class="currency-status">
                    <li id="rate-li-1">
                        <a href="#">
                            <i class="tf-ion-arrow-down-b down-status"></i>
                            <span>BTC/KGX</span>
                            <span id="rateBTCtoKGX"></span>
                            <input type="hidden" id="BtcToKgx-uuid">
                        </a>
                    </li>
                    <li id="rate-li-2">
                        <a href="#">
                            <i class="tf-arrow-dropup up-status"></i>
                            <span>ETH/KGX</span>
                            <span id="rateETHtoKGX"></span>
                            <input type="hidden" id="EthToKgx-uuid">
                        </a>
                    </li>
                    <li id="rate-li-3">
                        <a href="#">
                            <i class="tf-arrow-dropup up-status"></i>
                            <span>LTC/KGX</span>
                            <span id="rateLTCtoKGX"></span>
                            <input type="hidden" id="LtcToKgx-uuid">
                        </a>
                    </li>
                    <li id="rate-li-4">
                        <a href="#">
                            <i class="tf-arrow-dropup up-status"></i>
                            <span>CNY/KGX</span>
                            <span id="rateCNYtoKGX"></span>
                            <input type="hidden" id="CnyToKgx-uuid">
                        </a>
                    </li>
                    <li id="rate-li-5">
                        <a href="#">
                            <i class="tf-arrow-dropup up-status"></i>
                            <span>KGX/USD</span>
                            <span id="rateKGXtoUSD"></span>
                            <input type="hidden" id="KgxToUSD-uuid">
                        </a>
                    </li>
                </ul>
                </marquee>
            </div>
        </div>
    </div>
  </section>


<?php
if (in_array($_SESSION['username'], $username_array)) {
?>

  <section class="header navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="tf-ion-android-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="km.php?func=user" class="nav-link"><input type="button" class="btn btn-primary" value="會員查詢"></a>
                            </li>
                            <li class="nav-item">
                                <a href="km.php?func=report" class="nav-link"><input type="button" class="btn btn-primary" value="報表"></a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
            </div>
        </div>
    </div>
</section>



<section>
    <div class="container">
<?php
    switch ($_GET['func']) {
        case 'user';
            echo '
                <form action="km.php?func=user" method="post">
                    <table class="table table_2">
                        <tr>
                            <td colspan="2">會員查詢</td>
                        </tr>
                        <tr>
                            <td><input name="data_1" id="data_1" type="text" placeholder="输入帳號" value=""> OR <input name="data_2" id="data_2" type="text" placeholder="输入郵箱" value=""></td>
                            <td><input type="submit" class="btn btn-themecolor" value="查詢"></td>
                        </tr>
                    </table>
                </form>
            ';
            if (isset($_POST['data_1']) && isset($_POST['data_2'])) {
                //會員資料
                echo '
                    <table class="table">
                        <tr class="title">
                            <td>會員編號</td>
                            <td>姓名</td>
                            <td>帳號</td>
                            <td>郵箱</td>
                            <td>手機</td>
                            <td>地址</td>
                            <td>KGX 餘額</td>
                        </tr>
                ';
                $search_ok = false;
                $search_order_ok = false;
                if ($_POST['data_1']!='') {
                    $db = new DB;
                    $data = mysqli_real_escape_string($db->conn, $_POST['data_1']);
                    $search_ok = true;
                    $search_type = 'username';
                } elseif ($_POST['data_2']!='') {
                    $db = new DB;
                    $data = mysqli_real_escape_string($db->conn, $_POST['data_2']);
                    $search_ok = true;
                    $search_type = 'mail';
                } else {}
                
                if ($search_ok) {
                    $db->query("SELECT * FROM `user` WHERE `" . $search_type . "`='" . $data . "'");
                    if ($db->num_rows() > 0) {
                        $r = $db->fetch_assoc();
                        echo '
                            <tr>
                                <td>' . $r['userID'] . '</td>
                                <td>' . $r['name'] . '</td>
                                <td>' . $r['username'] . '</td>
                                <td>' . $r['mail'] . '</td>
                                <td>' . $r['phone'] . '</td>
                                <td>' . $r['kgx_address'] . '</td>
                                <td>' . $r['kgx'] . '</td>
                            </tr>
                        ';
                        $search_order_ok = true;
                    } else {
                        echo '
                            <tr>
                                <td colspan="7">查無會員</td>
                            </tr>
                        ';
                    }
                } else {
                    echo '
                        <tr>
                            <td colspan="7">請輸入帳號或郵箱</td>
                        </tr>
                    ';
                }
                echo '</table>';
                
                
                
                //訂單資料
                if ($search_order_ok) {
                    echo '
                        <table class="table">
                            <tr class="title">
                                <td>訂單編號</td>
                                <td>下單時間</td>
                                <td>幣別</td>
                                <td>應付數量</td>
                                <td>平台收入</td>
                                <td>購得 KGX 數量</td>
                                <td>訂單狀態</td>
                                <td>完成交易</td>
                            </tr>
                    ';
                    $db = new DB;
                    $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $r['userID'] . "' ORDER BY `no` DESC");
                    if ($db->num_rows() > 0) {
                        for ($i=0;$i<$db->num_rows();$i++) {
                            $r = $db->fetch_assoc();
                            switch ($r['currency_type_id']) {
                                case 1:
                                    $currency_type = '贈送';
                                    break;
                                case 2:
                                    $currency_type = 'BTC';
                                    break;
                                case 3:
                                    $currency_type = 'ETH';
                                    break;
                                case 4:
                                    $currency_type = 'LTC';
                                    break;
                                case 6:
                                    $currency_type = 'CNY';
                                    break;
                            }
                            switch ($r['confirm_remittance']) {
                                case 0:
                                    $confirm_remittance = '<font class="status_0">等待付款</font>';
                                    break;
                                case 1:
                                    $confirm_remittance = '<font class="status_1">完成付款</font>';
                                    break;
                                case 2:
                                    $confirm_remittance = '<font class="status_2">撤銷</font>';
                                    break;
                                case 3:
                                    $confirm_remittance = '<font class="status_3">超時</font>';
                                    break;
                            }
                            switch ($r['complete']) {
                                case 0:
                                    $complete = '<font class="status_0">尚未完成</font>';
                                    break;
                                case 1:
                                    $complete = '<font class="status_1">完成交易</font>';
                                    break;
                            }
                            if ((floor($i/3)%2) == 0) {
                                $class = 'tr_0';
                            } else {
                                $class = 'tr_1';
                            }
                            echo '
                                <tr class="' . $class . '">
                                    <td>' . $r['no'] . '</td>
                                    <td>' . $r['dateTime'] . '</td>
                                    <td>' . $currency_type . '</td>
                                    <td>' . $r['currency_amount'] . '</td>
                                    <td>' . $r['income'] . '</td>
                                    <td>' . $r['kgx_amount'] . '</td>
                                    <td>' . $confirm_remittance . '</td>
                                    <td>' . $complete . '</td>
                                </tr>
                            ';
                        }
                    } else {
                        echo '
                            <tr>
                                <td colspan="6">尚無交易資料</td>
                            </tr>
                        ';
                    }
                    echo '</table>';
                }
            }
            break;
        case 'report';//報表
                echo '
                <table class="table">
                    <tr>
                        <td colspan="8" class="note">※ USD 為預售，匯率 0.016 USD</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="title">統計報表</td>
                    </tr>
                    <tr>
                        <td rowspan="2">月份</td>
                        <td rowspan="2" colspan="2">KGX 銷售數量</td>
                        <td colspan="5">收入</td>
                    </tr>
                    <tr>
                        <td>BTC</td>
                        <td>ETH</td>
                        <td>LTC</td>
                        <td>CNY</td>
                        <td>USD</td>
                    </tr>
                ';
                for ($i=0;$i<11;$i++) {
                    $month_order_kgx_total = 0;
                    $month_order_btc_income_total = 0;
                    $month_order_eth_income_total = 0;
                    $month_order_ltc_income_total = 0;
                    $month_order_cny_income_total = 0;
                    $month_presale_kgx_total = 0;
                    
                    //從 2018.02 開始
                    $j = $i+1;
                    $start = date("Y-m-d H:i:s",strtotime("2018-02 +$i month"));
                    $end = date("Y-m-d H:i:s",strtotime("2018-02 +$j month"));
                    
                    $db = new DB;
                    $db->query("SELECT * FROM `order_history` WHERE `confirm_remittance`='1' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
                    if ($db->num_rows() > 0) {
                        for ($ii=0;$ii<$db->num_rows();$ii++) {
                            $r = $db->fetch_assoc();
                            if ($r['userID'] == '102') {
                            } elseif ($r['userID'] == '103') {
                            } elseif ($r['currency_amount'] == 0) {
                            } else {
                                switch ($r['currency_type_id']) {
                                    case 2:
                                        $month_order_btc_income_total += $r['income'];
                                        break;
                                    case 3:
                                        $month_order_eth_income_total += $r['income'];
                                        break;
                                    case 4:
                                        $month_order_ltc_income_total += $r['income'];
                                        break;
                                    case 6:
                                        $month_order_cny_income_total += $r['income'];
                                        break;
                                }
                                $month_order_kgx_total += $r['kgx_amount'];
                            }
                        }
                    }
                    $db = new DB;
                    $db->query("SELECT * FROM `transfer_history` WHERE `userID`='102' AND `complete`='1' AND `datetime`>='" . $start . "' AND `datetime`<'" . $end . "'");
                    if ($db->num_rows() > 0) {
                        for ($ii=0;$ii<$db->num_rows();$ii++) {
                            $r = $db->fetch_assoc();
                            $month_presale_kgx_total += $r['kgx_amount'];
                        }
                    }
                    if ((floor($i/2)%2) == 0) {
                        $class = 'tr_0';
                    } else {
                        $class = 'tr_1';
                    }
                    
                    echo '
                    <tr class="' . $class . '">
                        <td rowspan="2">' . date("Y-m",strtotime("2018-02 +$i month")) . '</td>
                        <td>銷售</td>
                        <td class="content_r">' . $month_order_kgx_total . '</td>
                        <td rowspan="2" class="content_r">' . $month_order_btc_income_total . '</td>
                        <td rowspan="2" class="content_r">' . $month_order_eth_income_total . '</td>
                        <td rowspan="2" class="content_r">' . $month_order_ltc_income_total . '</td>
                        <td rowspan="2" class="content_r">' . $month_order_cny_income_total . '</td>
                        <td rowspan="2" class="content_r">' . ($month_presale_kgx_total*0.016) . '</td>
                    </tr>
                    <tr class="' . $class . '">
                        <td>預售</td>
                        <td class="content_r">' . $month_presale_kgx_total . '</td>
                    </tr>
                    ';
                }
                echo '</table>';
            break;
    }
} else {
    echo "<script type='text/javascript'>window.location.href='index.php'</script>";
}
?>


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