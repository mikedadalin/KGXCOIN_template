<?php
  $title = '令牌转出';
?>

<?php include_once('templates/header.php'); ?>
<?php checkSignin(0); ?>

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
          <h3>KGX转换</h3>

          <nav class="nav nav-tabs tabsline">
            <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="#nav_kgx_in">KGX 转出</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_kgx_out">KGX 转入</a>
          </nav>

          <div class="tab-content p-t-20 p-b-20" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav_kgx_in" role="tabpanel" aria-labelledby="nav_kgx_in">
              <div class="card">
                <div class="card-body">
                  <form name="transferform" id="transferform">
                  <h4 class="card-title">输入对方KGX专属接受地址</h4>
                  <div class="form-group">
                    <label class="control-label">转出KGX专属接受地址</label>
                    <input type="text" id="address" class="form-control" placeholder="输入对方KGX专属接受地址" value=''>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">转出数量</label>
                    <input type="number" id="amount" class="form-control" min="0" value=''>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label">邮件验证码</label>

                    <div class="form-inline row">
                      <div class="form-group mx-sm-3 ">
                        <input type="text" class="form-control" id="verificationCode" placeholder="输入验证码">
                      </div>
                      <button type="button" class="btn btn-danger mailGetValicode">发送验证码</button>
                    </div>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>

                  <div class="row justify-content-md-center">
                    <div class="text-center col-8">
                      <button type="button" class="btn btn-lg btn-primary btn-block btn-kgxout">转出KGX</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div> <!-- End card -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">转出历史纪录</h4>
                  <h6 class="card-subtitle">转出 KGX COIN 纪录</h6>
                  <div class="table-responsive">
                    <table class="table table-align-middle">
                      <thead>
                        <tr class="text-nowrap">
                          <th>日　期</th>
                          <th>转出数量</th>
                          <th>转出地址</th>
                          <th>状　态</th>
                          <th>帐号余额</th>
                          <th>备  注</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $db = new DB;
                            $db->query("SELECT * FROM `transfer_history` WHERE `userID`='" . $_SESSION['userID'] . "' ORDER BY `no` DESC");
                            if ($db->num_rows() > 0) {
                                for ($i = 0; $i < $db->num_rows(); $i++) {
                                    $r = $db->fetch_assoc();
                                    if($r['complete']==1){ $status = '成功'; }else{ $status = '失败'; }
                                    echo '
                                    <tr>
                                        <td>'.$r['dateTime'].'</td>
                                        <td>'.$r['kgx_amount'].'</td>
                                        <td>
                                            <input type="text" class="form-control"  value='.$r['transfer_address'].' readonly>
                                        </td>
                                        <td><span class="label label-success">'.$status.'</span></td>
                                        <td>'.$r['a_balance'].'</td>
                                        <td> </td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td colspan="6" style="text-align: center;">尚无历史纪录</td>
                                </tr>
                                ';
                            }
                        ?>
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
              </div> <!-- End card -->

            </div>

            <div class="tab-pane fade" id="nav_kgx_out" role="tabpanel" aria-labelledby="nav_kgx_out">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">您专属KGX交易用地址</h4>
                  <h6 class="card-subtitle">存入KGX COIN纪录</h6>
      
                  <label class='control-label'>禁止充值除KGX之外的其他资产，任何非KGX资产充值将不可找回</label>
                  <div class='input-group mb-3'>
                      <input type='text' id='input-addresscode' class='form-control' placeholder='0xcca393f638c53b084c40746b774dd8a7459865be' value='<?php echo $_SESSION['kgx_address']; ?>' aria-label='0xcca393f638c53b084c40746b774dd8a7459865be' aria-describedby='basic-addon2' readonly>
                      <div class='input-group-append'>
                        <button class='btn btn-outline-secondary btn-addresscopy' type='button' data-clipboard-target='#input-addresscode'><i class="fa fa-files-o"></i> 复制</button>
                      </div>
                  </div>
                 
                </div>
              </div> <!-- End card -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">存入历史纪录</h4>
                  <h6 class="card-subtitle">存入 KGX COIN 纪录</h6>
                  <div class="table-responsive">
                    <table class="table table-align-middle">
                      <thead>
                        <tr class="text-nowrap">
                          <th>日　期</th>
                          <th>转入数量</th>
                          <th>转入地址</th>
                          <th>状　态</th>
                          <th>帐号余额</th>
                          <th>备  注</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $db = new DB;
                            $db->query("SELECT * FROM `transfer_history` WHERE `transfer_address`='" . $_SESSION['kgx_address'] . "' ORDER BY `no` DESC");
                            if ($db->num_rows() > 0) {
                                for ($i = 0; $i < $db->num_rows(); $i++) {
                                    $r = $db->fetch_assoc();
                                    if($r['complete']==1){ $status = '成功'; }else{ $status = '失败'; }
                                    echo '
                                    <tr>
                                        <td>'.$r['dateTime'].'</td>
                                        <td>'.$r['kgx_amount'].'</td>
                                        <td>
                                            <input type="text" class="form-control"  value='.$r['transfer_address'].' readonly>
                                        </td>
                                        <td><span class="label label-success">'.$status.'</span></td>
                                        <td>'.$r['b_balance'].'</td>
                                        <td> </td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td colspan="6" style="text-align: center;">尚无历史纪录</td>
                                </tr>
                                ';
                            }
                        ?>
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
              </div> <!-- End card -->

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
  <script src="assets/scripts/trans_kgxout.js"></script>
  <!-- Temp Scripts
  =====================================-->
  <script>
  </script>

</body>
</html>