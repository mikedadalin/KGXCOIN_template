<?php
  $title = '令牌轉出';
?>

<?php include_once('templates/header.php'); ?>

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
          <h3>KGX轉換</h3>

          <nav class="nav nav-tabs tabsline">
            <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="#nav_kgx_in">KGX 轉出</a>
            <a class="nav-item nav-link" data-toggle="tab" role="tab" href="#nav_kgx_out">KGX 轉入</a>
          </nav>

          <div class="tab-content p-t-20 p-b-20" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav_kgx_in" role="tabpanel" aria-labelledby="nav_kgx_in">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">輸入對方KGX專屬接受地址</h4>
                  <!-- <h6 class="card-subtitle">存入KGX COIN紀錄</h6> -->
                  <div class="form-group">
                    <label class="control-label">轉出KGX專屬接受地址</label>
                    <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss'>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">轉出數量</label>
                    <input type="text" id="" class="form-control" placeholder="最多 5,689 KGX" value=''>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label">郵件驗證碼</label>

                    <div class="form-inline row">
                      <div class="form-group mx-sm-3 ">
                        <input type="text" class="form-control" id="staticEmail2" value="email@example.com">
                      </div>
                      <button type="submit" class="btn btn-danger mailGetValicode">發送驗證碼</button>
                    </div>
                    <span class="help-block text-muted"><small> </small></span>
                  </div>

                  <div class="row justify-content-md-center">
                    <div class="text-center col-8">
                      <button type="button" class="btn btn-lg btn-primary btn-block btn-kgxout">轉出KGX</button>
                    </div>
                  </div>

                </div>
              </div> <!-- End card -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">轉出歷史紀錄</h4>
                  <h6 class="card-subtitle">轉出 KGX COIN 紀錄</h6>
                  <div class="table-responsive">
                    <table class="table table-align-middle">
                      <thead>
                        <tr class="text-nowrap">
                          <th>日　期</th>
                          <th>轉出數量</th>
                          <th>轉出地址</th>
                          <th>狀　態</th>
                          <th>帳號餘額</th>
                          <th>備  註</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,000</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,000</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,000</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,000</td>
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
              </div> <!-- End card -->

            </div>

            <div class="tab-pane fade" id="nav_kgx_out" role="tabpanel" aria-labelledby="nav_kgx_out">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">您專屬KGX交易用地址</h4>
                  <h6 class="card-subtitle">存入KGX COIN紀錄</h6>
      
                  <label class='control-label'>禁止充值除KGX之外的其他資產，任何非KGX資產充值將不可找回</label>
                  <div class='input-group mb-3'>
                      <input type='text' id='input-addresscode' class='form-control' placeholder='0xcca393f638c53b084c40746b774dd8a7459865be' value='0xcca393f638c53b084c40746b774dd8a7459865be' aria-label='0xcca393f638c53b084c40746b774dd8a7459865be' aria-describedby='basic-addon2' readonly>
                      <div class='input-group-append'>
                        <button class='btn btn-outline-secondary btn-addresscopy' type='button' data-clipboard-target='#input-addresscode'><i class="fa fa-files-o"></i> 複製</button>
                      </div>
                  </div>
      
                  <div class="row justify-content-md-center"> <!-- 第一次進入顯示生成，生成後未來不顯示 -->
                    <div class="text-center col-8">
                      <button type="button" class="btn btn-lg btn-primary btn-block">生　成</button>
                    </div>
                  </div>
                 
                </div>
              </div> <!-- End card -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">存入歷史紀錄</h4>
                  <h6 class="card-subtitle">存入 KGX COIN 紀錄</h6>
                  <div class="table-responsive">
                    <table class="table table-align-middle">
                      <thead>
                        <tr class="text-nowrap">
                          <th>日　期</th>
                          <th>轉入數量</th>
                          <th>轉入地址</th>
                          <th>狀　態</th>
                          <th>帳號餘額</th>
                          <th>備  註</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>3,600</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>2,400</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,100</td>
                          <td> </td>
                        </tr>
                        <tr>
                          <td>2018/01/01</td>
                          <td>2</td>
                          <td>
                            <input type="text" id="" class="form-control" placeholder="輸入對方KGX專屬接受地址" value='5KYZdUEo39z3FPrtuX2QbbwGnNP5zTd7yyr2SC1j299sBCnWjss' readonly>
                          </td>
                          <td><span class="label label-success">成功</span></td>
                          <td>5,000</td>
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


  <!-- Temp Scripts
  =====================================-->
  <script>
    $('.mailGetValicode').on('click', function(){
      toastr.success('已發送驗證碼~');
    })
    $('.btn-kgxout').on('click', function(){
      swal(
        '成功轉出',
        '為了用戶資金安全，請注意查收',
        'success'
      )
    })
  </script>

  <script>
    var clipboard = new Clipboard('.btn-addresscopy');
    clipboard.on('success', function(e) {
      toastr.success('恭喜您，複製地址成功~');
      e.clearSelection();
    });
    clipboard.on('error', function(e) {
      toastr.error('複製地址失敗~');
    });
    
  </script>





</body>
</html>