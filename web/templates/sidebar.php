
          <!-- Sidebar navigation open/off -->
            <aside class="sidebar">
              <span class="sidebar-close"><i class="material-icons close fa fa-close"></i></span>
              <div class="sidebar-nav">

                <h3 class="widget-title">KGX 市场</h3>
                <ul>
                  <li class="active">
                    <a href="trans.php">
                      <i class="fa fa-tachometer"></i> <span class="hide-menu">面板</span>
                    </a>
                  </li>
                  <li>
                    <a href="trans_buygx.php">
                      <i class="fa fa-caret-square-o-right"></i> <span class="hide-menu">购买KGX 令牌</span>
                    </a>
                  </li>
                  <li>
                    <a href="trans_wallet.php">
                      <i class="fa fa-usd" aria-hidden="true"></i> <span class="hide-menu">资产中心</span>
                    </a>
                  </li>
                  <li>
                    <a href="trans_kgxout.php">
                      <i class="fa fa-sign-out"></i> <span class="hide-menu">令牌转出</span>
                    </a>
                  </li>
                  <li>
                    <a href="trans_reward.php">
                      <i class="fa fa-tasks"></i> <span class="hide-menu">奖励</span>
                    </a>
                  </li>
                  <li>
                    <a href="trans_pw.php">
                      <i class="fa fa-user-secret"></i> <span class="hide-menu">更改密码</span>
                    </a>
                  </li>
                  <?php
                  $username_array = array("liao", "erictestapi", "isin168", "love1215520");
                  if (in_array($_SESSION['username'], $username_array)) {
                    echo '
                    <li>
                      <a href="km.php">
                        <i class="fa fa-search"></i> <span class="hide-menu">資料查詢</span>
                      </a>
                    </li>
                    ';
                  }
                  ?>
                </ul>
                </div>
            </aside>
            <!-- End Sidebar navigation -->