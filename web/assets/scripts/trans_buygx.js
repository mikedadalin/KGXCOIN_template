$('#nav_buytype_btc .btn').on('click', function() {
    if ($('#BtcToKgx').val() != '' && $('#BtcToKgx').val() > 0) {
        coinToKgx();
        //checkTodayBuyKgx('BtcToKgx');
    }
})
$('#nav_buytype_eth .btn').on('click', function() {
    if ($('#EthToKgx').val() != '' && $('#EthToKgx').val() > 0) {
        coinToKgx();
        //checkTodayBuyKgx('EthToKgx');
    }
})
$('#nav_buytype_ltc .btn').on('click', function() {
    if ($('#LtcToKgx').val() != '' && $('#LtcToKgx').val() > 0) {
        coinToKgx();
        //checkTodayBuyKgx('LtcToKgx');
    }
})
$('#nav_buytype_cny .btn').on('click', function() {
    if ($('#CnyToKgx').val() != '' && $('#CnyToKgx').val() > 0) {
        if ($('#bank_flag').val() == 'unionpayq') {
            if (Number($('#previewCNY').html()) < 150) {
                swal('快捷支付\n金額不可低於 150 人民币');
            } else {
                coinToKgx();
                //checkTodayBuyKgx('CnyToKgx');
            }
        } else {
            if (Number($('#previewCNY').html()) < 50) {
                swal('第三方支付\n金額不可低於 50 人民币');
            } else {
                coinToKgx();
                //checkTodayBuyKgx('CnyToKgx');
            }
        }
    }
})

$('#nav_buytype_bank .btn').on('click', function() {
    coinToKgx();
})
$('#nav_buytype_alipay .btn').on('click', function() {
    coinToKgx();
})
$('#nav_buytype_wechatpay .btn').on('click', function() {
    coinToKgx();
})
function checkTodayBuyKgx(type) {
    $.ajax({
        url: "assets/class/checkTodayBuyKgx.php",
        type: "POST",
        async: false,
        data: {
            "action": 'checkTodayBuyKgx',
            "amount": $('#' + type).val()
        },
        success: function(data) {
            var data_array = data.split('||');
            switch (data_array[0]) {
                case 'ok':
                    $('#today_buy').html(data_array[1]);
                    coinToKgx();
                    break;
                case 'no':
                    $('#today_buy').html(data_array[1]);
                    $('#' + type).val(data_array[2]);
                    swal({
                        type: "info",
                        title: "每日限購 20,000 KGX",
                        text: "",
                        html: "<div>今日您已購買: " + data_array[1] + " KGX</div><div>剩餘購買額度: " + data_array[2] + " KGX</div>",
                        confirmButtonColor: '#3085d6',
                        confirmButtonClass: 'btn btn-danger',
                        confirmButtonText: '關閉視窗',
                        buttonsStyling: false
                    });
                    break;
            }
        }
    });
}
// Virtual currenc to KGX
function coinToKgx() {
    var limit = true;
    switch (Number($('#currency_type_id').val())) {
        case 2:
            var currency_type = '比特幣';
            var currency_amount = $('#previewBTC').html();
            var kgx_amount = $('#BtcToKgx').val();
            var id = 'previewBTC';
            var id2 = 'rateBTCtoKGX';
            var id3 = 'BtcToKgx-uuid';
            break;
        case 3:
            var currency_type = '乙太坊';
            var currency_amount = $('#previewETH').html();
            var kgx_amount = $('#EthToKgx').val();
            var id = 'previewETH';
            var id2 = 'rateETHtoKGX';
            var id3 = 'EthToKgx-uuid';
            break;
        case 4:
            var currency_type = '萊特幣';
            var currency_amount = $('#previewLTC').html();
            var kgx_amount = $('#LtcToKgx').val();
            var id = 'previewLTC';
            var id2 = 'rateLTCtoKGX';
            var id3 = 'LtcToKgx-uuid';
            break;
        case 6:
            var currency_type = '人民币';
            var currency_amount = $('#previewCNY').html();
            var kgx_amount = $('#CnyToKgx').val();
            var id = 'previewCNY';
            var id2 = 'rateCNYtoKGX';
            var id3 = 'CnyToKgx-uuid';
            if ($('#bank_flag').val() == 'ALIPAY' && Number(currency_amount) > 10000) {
                limit = false;
            }
            break;
    }
    if (limit) {
        swal({
            title: "確認購買",
            html: '<a id="check_amount">' + currency_amount + '</a> ' + currency_type + '共可換得 ' + kgx_amount + ' 個KGX令牌',
            type: "info",
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonText: '確認'
        })
        .then((result) => {
            if (result.value) {
                //儲存訂單
                var currency_amount = $('#' + id).html();
                var ratio = $('#' + id2).html();
                var ratio2 = $('#rateKGXtoUSD').html();
                var uuid = $('#' + id3).val();
                var uuid2 = $('#KgxToUSD-uuid').val();
                $.ajax({
                    url: "assets/class/order.php",
                    type: "POST",
                    async: false,
                    data: {
                        "action": 'order',
                        "currency_type_id": $('#currency_type_id').val(),
                        "currency_amount": currency_amount,
                        "kgx_amount": kgx_amount,
                        "ratio": ratio,
                        "ratio2": ratio2,
                        "uuid": uuid,
                        "uuid2": uuid2,
                        "from_bank_flag": $('#bank_flag').val()
                    },
                    success: function(data) {
                        var data_array = data.split('||');
                        switch (data_array[0]) {
                            case 'ok':
                                var QR = data_array[1];
                                var address = data_array[2];
                                swal({
                                    type: "success",
                                    title: "感謝您的購買",
                                    text: "",
                                    html: "<div class='row'><div class='col-4'><img src='assets/qr_code/" + QR + "' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請在三十分鐘內將 " + currency_amount + " " + currency_type + " 轉入下列地址或是掃描二維碼以完成交易</label> <input type='text' id='input-addresscode' class='form-control' value='" + address + "' aria-label='" + address + "' aria-describedby='basic-addon2' readonly> <div class='input-group-append'> <button class='btn btn-outline-secondary btn-addresscopy' type='button' data-clipboard-target='#input-addresscode'><i class='fa fa-files-o'></i> 複製</button> </div></div></div></div>",
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonClass: 'btn btn-danger',
                                    confirmButtonText: '關閉視窗',
                                    buttonsStyling: false
                                });
                                break;
                            case 'dsdfpay':
                                switch (data_array[1]) {
                                    case 'qrcode':
                                        switch (data_array[2]) {
                                            case 'show':
                                                var QR = data_array[3];
                                                swal({
                                                    type: "success",
                                                    title: "感謝您的購買",
                                                    text: "",
                                                    html: "<div class='row'><div class='col-4'><img src='assets/qr_code/" + QR + "' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請在四分鐘內將 " + currency_amount + " " + currency_type + " 轉入<br>(掃描二維碼以完成交易)</label></div></div></div>",
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonClass: 'btn btn-danger',
                                                    confirmButtonText: '關閉視窗',
                                                    buttonsStyling: false
                                                });
                                                break;
                                            case 'jump':
                                                swal({
                                                    title: "感謝您的購買",
                                                    type: "info",
                                                    confirmButtonText: '前往付款'
                                                })
                                                .then((result) => {
                                                    if (result.value) {
                                                        window.open(data_array[3], '_blank');
                                                    }
                                                });
                                                break;
                                            case 'image':
                                                var QR = data_array[3];
                                                swal({
                                                    type: "success",
                                                    title: "感謝您的購買",
                                                    text: "",
                                                    html: "<div class='row'><div class='col-4'><img src='" + QR + "' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請在四分鐘內將 " + currency_amount + " " + currency_type + " 轉入<br>(掃描二維碼以完成交易)</label></div></div></div>",
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonClass: 'btn btn-danger',
                                                    confirmButtonText: '關閉視窗',
                                                    buttonsStyling: false
                                                });
                                                break;
                                        }
                                        break;
                                    case 'remit':
                                        swal({
                                            type: "success",
                                            title: "感謝您的購買",
                                            text: "",
                                            html: "<a>請將 " + currency_amount + " " + currency_type + " 轉入下方帳戶以完成交易<br>银行编码: " + data_array[2] + "<br>收款卡号: " + data_array[3] + "<br>收款卡姓名: " + data_array[4] + "<br>收款卡开户行: " + data_array[5] + "</a>",
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonClass: 'btn btn-danger',
                                            confirmButtonText: '關閉視窗',
                                            buttonsStyling: false
                                        });
                                        break;
                                    case 'online':
                                        if ($('#bank_flag').val() == 'unionpay' || $('#bank_flag').val() == 'unionpayq' || $('#bank_flag').val() == 'unionpayc') {
                                            var temp_array = data_array[2].split('&&');
                                            var url = 'https://www.hanpays.com/paysv1/pay.aspx';
                                            var args = {scode: temp_array[0], orderid: temp_array[1], paytype: temp_array[2], amount: temp_array[3], productname: temp_array[4], currcode: temp_array[5], userid: temp_array[6], callbackurl: temp_array[7], sign: temp_array[8]};
                                            var form = $("<form method='post' target='_blank'></form>"), input;
                            　　　　　　　　//jquery方式
                                            $(document.body).append(form);
                                            form.attr({"action":url});
                                            $.each(args,function(key,value){
                                                input = $("<input type='hidden'>");
                                                input.attr({"name":key});
                                                input.val(value);
                                                form.append(input);
                                            });
                                            console.log(args);
                                            form.submit();
                                        } else if ($('#bank_flag').val() == 'alipayOrg') {
                                            var temp_array = data_array[2].split('&&');
                                            var args = {WIDout_trade_no: temp_array[0], WIDtotal_amount: temp_array[1], WIDbody: temp_array[2]};
                                            var form = $("<form method='post' target='_blank'></form>"), input;
                            　　　　　　　　//jquery方式
                                            $(document.body).append(form);
                                            form.attr({"action":'https://kgxcoin.com/trans_buygx.php'});
                                            $.each(args,function(key,value){
                                                input = $("<input type='hidden'>");
                                                input.attr({"name":key});
                                                input.val(value);
                                                form.append(input);
                                            });
                                            console.log(args);
                                            form.submit();
                                        } else {
                                            swal({
                                                title: "感謝您的購買",
                                                type: "info",
                                                confirmButtonText: '前往付款'
                                            })
                                            .then((result) => {
                                                if (result.value) {
                                                    window.open(data_array[2], '_blank');
                                                }
                                            });
                                        }
                                        break;
                                }
                                break;
                            case 'dsdfpayno':
                                swal('訂單創建失敗');
                                break;
                            case 'inputNull':
                                swal('欄位不可空白');
                                break;
                        }
                    }
                });
            } else {
                swal("您已取消購買!");
            }
        });
    } else {
        swal("支付宝單筆上限 10000 人民币");
    }
}

function changeCurrency(currency_type_id) {
    $('#currency_type_id').val(currency_type_id);
}

var clipboard = new Clipboard('.btn-addresscopy');
clipboard.on('success', function(e) {
    // console.info('Action:', e.action);
    // console.info('Text:', e.text);
    // console.info('Trigger:', e.trigger);
    toastr.success('恭喜您，複製地址成功~');
    e.clearSelection();
});
clipboard.on('error', function(e) {
    // console.error('Action:', e.action);
    // console.error('Trigger:', e.trigger);
    toastr.error('複製地址失敗~');
});