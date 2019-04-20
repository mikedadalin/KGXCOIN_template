function cancelOrder(order_id) {
    swal({
        title: "取消訂單",
        html: '<a>確認要取消訂單 ?</a>',
        type: "info",
        showCancelButton: true,
        cancelButtonText: '取消',
        confirmButtonText: '確認'
    })
    .then((result) => {
        if (result.value) {
            $.ajax({
                url: "assets/class/cancelOrder.php",
                type: "POST",
                async: false,
                data: {
                    "action": 'cancelOrder',
                    "order_id": order_id
                },
                success: function(data) {
                    switch (data) {
                        case 'ok':
                            swal(
                                '成功取消訂單',
                                '',
                                'success'
                            ).then((result) => {
                                window.location.reload();
                            });
                            break;
                    }
                }
            });
        }
    });
}
function goToPay(no,id,address,qr,currency_amount) {
    switch (id) {
        case 'show':
            swal({
                type: "success",
                title: "感謝您的購買",
                text: "",
                html: "<div class='row'><div class='col-4'><img src='assets/qr_code/" + qr + "' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請將 " + currency_amount + " 人民币 轉入<br>(掃描二維碼以完成交易)</label></div></div></div>",
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
                    window.open(address, '_blank');
                }
            });
            break;
        case 'image':
            swal({
                type: "success",
                title: "感謝您的購買",
                text: "",
                html: "<div class='row'><div class='col-4'><img src='" + address + "' class='img-responsive'></div><div class='col-8 text-left'><div class='input-group mb-3'><label class='control-label'>請將 " + currency_amount + " 人民币 轉入<br>(掃描二維碼以完成交易)</label></div></div></div>",
                confirmButtonColor: '#3085d6',
                confirmButtonClass: 'btn btn-danger',
                confirmButtonText: '關閉視窗',
                buttonsStyling: false
            });
            break;
        case 'remit':
            var data_array = address.split('||');
            swal({
                type: "success",
                title: "感謝您的購買",
                text: "",
                html: "<a>請將 " + currency_amount + " 人民币 轉入下方帳戶以完成交易<br>银行编码: " + data_array[0] + "<br>收款卡号: " + data_array[1] + "<br>收款卡姓名: " + data_array[2] + "<br>收款卡开户行: " + data_array[3] + "</a>",
                confirmButtonColor: '#3085d6',
                confirmButtonClass: 'btn btn-danger',
                confirmButtonText: '關閉視窗',
                buttonsStyling: false
            });
            break;
        case 'online':
            $.ajax({
                url: "assets/class/goToOnlineOrder.php",
                type: "POST",
                async: false,
                data: {
                    "action": 'goToOnlineOrder',
                    "order_id": no
                },
                success: function(data) {
                    var data_array = data.split('||');
                    switch (data_array[0]) {
                        case 'ok':
                            swal({
                                title: "感謝您的購買",
                                type: "info",
                                confirmButtonText: '前往付款'
                            })
                            .then((result) => {
                                if (result.value) {
                                    window.open(data_array[1], '_blank');
                                }
                            });
                            break;
                    }
                }
            });
            break;
    }
}
function viewPage(type,go_page) {
    var refresh = false;
    switch (type) {
        case 'BTC':
            $('#page-item-btc-' + $('#btc_page').val()).attr('class', 'page-item');
            $('#page-item-btc-' + go_page).attr('class', 'page-item active');
            $('#btc_page').val(go_page);
            var html_id = 'btc_history';
            refresh = true;
            break;
        case 'ETH':
            $('#page-item-eth-' + $('#eth_page').val()).attr('class', 'page-item');
            $('#page-item-eth-' + go_page).attr('class', 'page-item active');
            $('#eth_page').val(go_page);
            var html_id = 'eth_history';
            refresh = true;
            break;
        case 'LTC':
            $('#page-item-ltc-' + $('#ltc_page').val()).attr('class', 'page-item');
            $('#page-item-ltc-' + go_page).attr('class', 'page-item active');
            $('#ltc_page').val(go_page);
            var html_id = 'ltc_history';
            refresh = true;
            break;
        case 'CNY':
            $('#page-item-cny-' + $('#cny_page').val()).attr('class', 'page-item');
            $('#page-item-cny-' + go_page).attr('class', 'page-item active');
            $('#cny_page').val(go_page);
            var html_id = 'cny_history';
            refresh = true;
            break;
    }
    if (refresh) {
        $.ajax({
            url: "assets/class/refreshOrderHistory.php",
            type: "POST",
            async: false,
            data: {
                "action": 'refreshOrderHistory',
                "type": type,
                "page": go_page
            },
            success: function(data) {
                $('#' + html_id).html(data);
            }
        });
    }
}
function viewPrePage(type) {
    var refresh = false;
    switch (type) {
        case 'BTC':
            if (Number($('#btc_page').val()) != 1) {
                $('#page-item-btc-' + String($('#btc_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#btc_page').val()) - 1);
                $('#page-item-btc-' + go_page).attr('class', 'page-item active');
                $('#btc_page').val(go_page);
                var html_id = 'btc_history';
                refresh = true;
            }
            break;
        case 'ETH':
            if (Number($('#eth_page').val()) != 1) {
                $('#page-item-eth-' + String($('#eth_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#eth_page').val()) - 1);
                $('#page-item-eth-' + go_page).attr('class', 'page-item active');
                $('#eth_page').val(go_page);
                var html_id = 'eth_history';
                refresh = true;
            }
            break;
        case 'LTC':
            if (Number($('#ltc_page').val()) != 1) {
                $('#page-item-ltc-' + String($('#ltc_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#ltc_page').val()) - 1);
                $('#page-item-ltc-' + go_page).attr('class', 'page-item active');
                $('#ltc_page').val(go_page);
                var html_id = 'ltc_history';
                refresh = true;
            }
            break;
        case 'CNY':
            if (Number($('#cny_page').val()) != 1) {
                $('#page-item-cny-' + String($('#cny_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#cny_page').val()) - 1);
                $('#page-item-cny-' + go_page).attr('class', 'page-item active');
                $('#cny_page').val(go_page);
                var html_id = 'cny_history';
                refresh = true;
            }
            break;
    }
    if (refresh) {
        $.ajax({
            url: "assets/class/refreshOrderHistory.php",
            type: "POST",
            async: false,
            data: {
                "action": 'refreshOrderHistory',
                "type": type,
                "page": go_page
            },
            success: function(data) {
                $('#' + html_id).html(data);
            }
        });
    }
}
function viewNextPage(type) {
    var refresh = false;
    switch (type) {
        case 'BTC':
            if (Number($('#btc_page').val()) != Number($('#btc_page_num').val())) {
                $('#page-item-btc-' + String($('#btc_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#btc_page').val()) + 1);
                $('#page-item-btc-' + go_page).attr('class', 'page-item active');
                $('#btc_page').val(go_page);
                var html_id = 'btc_history';
                refresh = true;
            }
            break;
        case 'ETH':
            if (Number($('#eth_page').val()) != Number($('#eth_page_num').val())) {
                $('#page-item-eth-' + String($('#eth_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#eth_page').val()) + 1);
                $('#page-item-eth-' + go_page).attr('class', 'page-item active');
                $('#eth_page').val(go_page);
                var html_id = 'eth_history';
                refresh = true;
            }
            break;
        case 'LTC':
            if (Number($('#ltc_page').val()) != Number($('#ltc_page_num').val())) {
                $('#page-item-ltc-' + String($('#ltc_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#ltc_page').val()) + 1);
                $('#page-item-ltc-' + go_page).attr('class', 'page-item active');
                $('#ltc_page').val(go_page);
                var html_id = 'ltc_history';
                refresh = true;
            }
            break;
        case 'CNY':
            if (Number($('#cny_page').val()) != Number($('#cny_page_num').val())) {
                $('#page-item-cny-' + String($('#cny_page').val())).attr('class', 'page-item');
                var go_page = (Number($('#cny_page').val()) + 1);
                $('#page-item-cny-' + go_page).attr('class', 'page-item active');
                $('#cny_page').val(go_page);
                var html_id = 'cny_history';
                refresh = true;
            }
            break;
    }
    if (refresh) {
        $.ajax({
            url: "assets/class/refreshOrderHistory.php",
            type: "POST",
            async: false,
            data: {
                "action": 'refreshOrderHistory',
                "type": type,
                "page": go_page
            },
            success: function(data) {
                $('#' + html_id).html(data);
            }
        });
    }
}