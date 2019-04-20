<?php
session_start();
include("DB.php");

if ($_POST['action'] == "refreshOrderHistory") {
    $show_data_num = 20;
    $result = '';
    if ($_POST['page'] == 1) {
        $start = 0;
    } else {
        $start = (($_POST['page']-1)*$show_data_num);
    }
    switch ($_POST['type']) {
        case 'BTC':
            $currency_type_id = 2;
            $display_type = 1;
            break;
        case 'ETH':
            $currency_type_id = 3;
            $display_type = 1;
            break;
        case 'LTC':
            $currency_type_id = 4;
            $display_type = 1;
            break;
        case 'CNY':
            $currency_type_id = 6;
            $display_type = 2;
            break;
    }
    $db = new DB;
    $db->query("SELECT * FROM `order_history` WHERE `userID`='" . $_SESSION['userID'] . "' AND `currency_type_id`='" . $currency_type_id . "' ORDER BY `no` DESC LIMIT " . $start . "," . $show_data_num . "");
    if ($db->num_rows() > 0) {
        switch ($display_type) {
            case 1:
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
                    $result .= '
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
                break;
            case 2:
                for ($i = 0; $i < $db->num_rows(); $i++) {
                    $r = $db->fetch_assoc();
                    switch ($r['confirm_remittance']) {
                        case 0:
                            $status = '<span class="label label-warning">等待付款</span> <a class="label label-light-primary" onclick="goToPay(\''.$r['no'].'\',\''.$r['id'].'\',\''.$r['address'].'\',\''.$r['qr'].'\',\''.$r['currency_amount'].'\');">前往付款</a>';
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
                    $result .= '
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
                break;
        }
        echo $result;
    } else {
        switch ($display_type) {
            case 1:
                $result .= '
                <tr>
                    <td colspan="8" style="text-align: center;">尚无历史纪录</td>
                </tr>
                ';
                break;
            case 2:
                $result .= '
                <tr>
                    <td colspan="7" style="text-align: center;">尚无历史纪录</td>
                </tr>
                ';
                break;
        }
        echo $result;
    }
}
?>