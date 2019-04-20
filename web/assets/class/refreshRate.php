<?php
session_start();
include("DB.php");

if ($_POST['action'] == "refreshRate") {
    $result_array = [];
    $db = new DB;
    $db->query("SELECT * FROM `currency_type` ORDER BY `currency_type_id` ASC");
    if ($db->num_rows() > 0) {
        for ($i = 0; $i < $db->num_rows(); $i++) {
            $r = $db->fetch_assoc();
            array_push($result_array, $r['rate']);
        }
        $rateBTCtoKGX = round(($result_array[0]/$result_array[1]),3);
        $rateETHtoKGX = round(($result_array[0]/$result_array[2]),3);
        $rateLTCtoKGX = round(($result_array[0]/$result_array[3]),3);
        $rateCNYtoKGX = round(($result_array[0]/$result_array[5]),3);
        $rateKGXtoUSD = round(($result_array[4]/$result_array[0]),3);
        
        $BTCtoKGXuuid = md5(md5($rateBTCtoKGX));
        $ETHtoKGXuuid = md5(md5($rateETHtoKGX));
        $LTCtoKGXuuid = md5(md5($rateLTCtoKGX));
        $CNYtoKGXuuid = md5(md5($rateCNYtoKGX));
        $KGXtoUSDuuid = md5(md5($rateKGXtoUSD));
        
        echo $rateBTCtoKGX.'||'.$rateETHtoKGX.'||'.$rateLTCtoKGX.'||'.$rateKGXtoUSD.'||e'.$BTCtoKGXuuid.'c||j'.$ETHtoKGXuuid.'n||q'.$LTCtoKGXuuid.'l||m'.$KGXtoUSDuuid.'z||'.$rateCNYtoKGX.'||g'.$CNYtoKGXuuid.'d';
    }
}
?>