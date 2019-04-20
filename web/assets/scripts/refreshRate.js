function refreshRate(type){
    switch (type) {
        case 1:
            if (document.getElementById("rateKGXtoUSD-content")) {
                $('#rateBTCtoKGX-content').html($('#rateBTCtoKGX').html());
                $('#rateETHtoKGX-content').html($('#rateETHtoKGX').html());
                $('#rateLTCtoKGX-content').html($('#rateLTCtoKGX').html());
                $('#rateCNYtoKGX-content').html($('#rateCNYtoKGX').html());
                $('#rateKGXtoUSD-content').html($('#rateKGXtoUSD').html());
            }
            if (document.getElementById("trans_KGX")) {
                $('#trans_KGXToUSD').html('= ' + eval(Number($('#trans_KGX').html())*Number($('#rateKGXtoUSD').html())) + ' USD');
            }
            if (document.getElementById("currency_type_id")) {
                if ($('#BtcToKgx').val()!='') {
                    $('#BtcToKgx').val(Number($('#BtcToKgx').val()));
                    if ($('#BtcToKgx').val() == 0) {
                        $('#BtcToKgx').val(0);
                    }
                    if ($('#BtcToKgx').val() > 20000) {
                        $('#BtcToKgx').val(20000);
                    }
                    $('#previewKGX-1').html($('#BtcToKgx').val());
                    /*
                    var temp_value = eval(Number($('#BtcToKgx').val())*Number($('#rateKGXtoUSD').html()));
                    if (temp_value >= 60000) {
                        $('#previewBTC').html(eval(eval($('#BtcToKgx').val() / Number($('#rateBTCtoKGX').html()))*0.7));
                    } else if (temp_value >= 40000) {
                        $('#previewBTC').html(eval(eval($('#BtcToKgx').val() / Number($('#rateBTCtoKGX').html()))*0.8));
                    } else if (temp_value >= 20000) {
                        $('#previewBTC').html(eval(eval($('#BtcToKgx').val() / Number($('#rateBTCtoKGX').html()))*0.9));
                    } else {
                        $('#previewBTC').html(eval($('#BtcToKgx').val() / Number($('#rateBTCtoKGX').html())));
                    }
                    */
                    $('#previewBTC').html(eval($('#BtcToKgx').val() / Number($('#rateBTCtoKGX').html())));
                }
                if ($('#EthToKgx').val()!='') {
                    $('#EthToKgx').val(Number($('#EthToKgx').val()));
                    if ($('#EthToKgx').val() == 0) {
                        $('#EthToKgx').val(0);
                    }
                    if ($('#EthToKgx').val() > 20000) {
                        $('#EthToKgx').val(20000);
                    }
                    $('#previewKGX-2').html($('#EthToKgx').val());
                    /*
                    var temp_value = eval(Number($('#EthToKgx').val())*Number($('#rateKGXtoUSD').html()));
                    if (temp_value >= 60000) {
                        $('#previewETH').html(eval(eval($('#EthToKgx').val() / Number($('#rateETHtoKGX').html()))*0.7));
                    } else if (temp_value >= 40000) {
                        $('#previewETH').html(eval(eval($('#EthToKgx').val() / Number($('#rateETHtoKGX').html()))*0.8));
                    } else if (temp_value >= 20000) {
                        $('#previewETH').html(eval(eval($('#EthToKgx').val() / Number($('#rateETHtoKGX').html()))*0.9));
                    } else {
                        $('#previewETH').html(eval($('#EthToKgx').val() / Number($('#rateETHtoKGX').html())));
                    }
                    */
                    $('#previewETH').html(eval($('#EthToKgx').val() / Number($('#rateETHtoKGX').html())));
                }
                if ($('#LtcToKgx').val()!='') {
                    $('#LtcToKgx').val(Number($('#LtcToKgx').val()));
                    if ($('#LtcToKgx').val() == 0) {
                        $('#LtcToKgx').val(0);
                    }
                    if ($('#LtcToKgx').val() > 20000) {
                        $('#LtcToKgx').val(20000);
                    }
                    $('#previewKGX-3').html($('#LtcToKgx').val());
                    /*
                    var temp_value = eval(Number($('#LtcToKgx').val())*Number($('#rateKGXtoUSD').html()));
                    if (temp_value >= 60000) {
                        $('#previewLTC').html(eval(eval($('#LtcToKgx').val() / Number($('#rateLTCtoKGX').html()))*0.7));
                    } else if (temp_value >= 40000) {
                        $('#previewLTC').html(eval(eval($('#LtcToKgx').val() / Number($('#rateLTCtoKGX').html()))*0.8));
                    } else if (temp_value >= 20000) {
                        $('#previewLTC').html(eval(eval($('#LtcToKgx').val() / Number($('#rateLTCtoKGX').html()))*0.9));
                    } else {
                        $('#previewLTC').html(eval($('#LtcToKgx').val() / Number($('#rateLTCtoKGX').html())));
                    }
                    */
                    $('#previewLTC').html(eval($('#LtcToKgx').val() / Number($('#rateLTCtoKGX').html())));
                }
                if ($('#CnyToKgx').val()!='') {
                    $('#CnyToKgx').val(Number($('#CnyToKgx').val()));
                    if ($('#CnyToKgx').val() == 0) {
                        $('#CnyToKgx').val(0);
                    }
                    if ($('#CnyToKgx').val() > 20000) {
                        $('#CnyToKgx').val(20000);
                    }
                    $('#previewKGX-4').html($('#CnyToKgx').val());
                    /*
                    var temp_value = eval(Number($('#CnyToKgx').val())*Number($('#rateKGXtoUSD').html()));
                    if (temp_value >= 60000) {
                        $('#previewCNY').html(eval(eval($('#CnyToKgx').val() / Number($('#rateCNYtoKGX').html()))*0.7));
                    } else if (temp_value >= 40000) {
                        $('#previewCNY').html(eval(eval($('#CnyToKgx').val() / Number($('#rateCNYtoKGX').html()))*0.8));
                    } else if (temp_value >= 20000) {
                        $('#previewCNY').html(eval(eval($('#CnyToKgx').val() / Number($('#rateCNYtoKGX').html()))*0.9));
                    } else {
                        $('#previewCNY').html(eval($('#CnyToKgx').val() / Number($('#rateCNYtoKGX').html())));
                    }
                    */
                    $('#previewCNY').html(eval(Math.ceil(eval($('#CnyToKgx').val() / Number($('#rateCNYtoKGX').html()))*100)/100));
                }
                if (document.getElementById("check_amount")) {
                    switch ($('#currency_type_id').val()) {
                        case '2':
                            $('#check_amount').html($('#previewBTC').html());
                            break;
                        case '3':
                            $('#check_amount').html($('#previewETH').html());
                            break;
                        case '4':
                            $('#check_amount').html($('#previewLTC').html());
                            break;
                        case '6':
                            $('#check_amount').html($('#previewCNY').html());
                            break;
                    }
                }
            }
            break;
        case 2:
            $.ajax({
                url: "assets/class/refreshRate.php",
                type: "POST",
                async: false,
                data: {
                    "action": 'refreshRate'
                },
                success: function(data) {
                    var data_array = data.split('||');
                    $('#rateBTCtoKGX').html(data_array[0]);
                    $('#rateETHtoKGX').html(data_array[1]);
                    $('#rateLTCtoKGX').html(data_array[2]);
                    $('#rateKGXtoUSD').html(data_array[3]);
                    $('#BtcToKgx-uuid').val(data_array[4]);
                    $('#EthToKgx-uuid').val(data_array[5]);
                    $('#LtcToKgx-uuid').val(data_array[6]);
                    $('#KgxToUSD-uuid').val(data_array[7]);
                    $('#rateCNYtoKGX').html(data_array[8]);
                    $('#CnyToKgx-uuid').val(data_array[9]);
                }
            });
            /*
            var window_w = $('body').width();
            if (window_w <= 576) {
                var li_w = $("#rate-ul").width()/5;
                var ul_left = Number($("#rate-ul").css('left').replace('px',''));
                var ul_left_n = $("#rate-ul").css('left').replace('px','');
                ul_left_n = Number(ul_left_n.replace('-',''));
                if (ul_left_n < (li_w*3)) {
                    $("#rate-ul").animate({
                        left: String(eval(ul_left-li_w)) + 'px'
                    }, li_w, 'swing');
                } else {
                    $("#rate-ul").animate({
                        left: '0px'
                    }, 0, 'swing');
                }
            }*/
            break;
    }
}
setInterval('refreshRate(1)', 500);
setInterval('refreshRate(2)', 4000);