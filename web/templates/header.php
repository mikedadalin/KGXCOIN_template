<?php
    if ($_SERVER['HTTP_HOST'] != 'kgxcoin.com') {
        header('Location: https://kgxcoin.com');
        exit;
    }
    session_start();
    include('assets/class/DB.php');
    include('assets/class/function.php');
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
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">关于</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="qna.php">常见问题</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="white.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    白皮书
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="white_about.php">关于</a>
                                    <a class="dropdown-item" href="white_goal.php">KGXCOIN的细节</a>
                                    <a class="dropdown-item" href="white_chance.php">KGX投资机会</a>
                                    <a class="dropdown-item" href="white_contract.php">以太坊区块链技术</a>
                                    
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="partner.php">合作伙伴</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="team.php">KGXCOIN 团队</a>
                            </li>

                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['userID'])) {
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="trans.php">KGX 市場</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">登出</a>
                                </li>
                                ';
                            } else {
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="signin.php">登入</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signup.php">註冊</a>
                                </li>
                                ';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
                
            </div>
        </div>
    </div>
  </section>