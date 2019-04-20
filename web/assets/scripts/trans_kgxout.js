$('.mailGetValicode').on('click', function() {
    //發送驗證碼
    if ($('#address').val() == '') {
        eval("document.transferform['address'].focus()");
    } else {
        $.ajax({
            url: "assets/class/PHPMailer/Mail-Send-VerificationCode.php",
            type: "POST",
            async: false,
            data: {
                "action": 'transfer',
                "address": $('#address').val()
            },
            success: function(data) {
                switch (data) {
                    case 'ok':
                        toastr.success('已發送驗證碼');
                        break;
                }
            }
        });
    }
})
$('.btn-kgxout').on('click', function() {
    if (checkInput()) {
        $.ajax({
            url: "assets/class/transfer.php",
            type: "POST",
            async: false,
            data: {
                "action": 'transfer',
                "address": $('#address').val(),
                "amount": $('#amount').val(),
                "verificationCode": $('#verificationCode').val()
            },
            success: function(data) {
                switch (data) {
                    case 'ok':
                        swal(
                            '成功轉出',
                            '為了用戶資金安全，請注意查收',
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        });
                        break;
                    case 'no':
                        swal('餘額不足');
                        break;
                    case 'address':
                        swal('查無地址');
                        break;
                    case 'error':
                        swal('驗證碼錯誤');
                        break;
                    case 'inputNull':
                        swal('欄位不可空白');
                        break;
                }
            }
        });
    }
})

// Check input
function checkInput() {
    var result = false;
    if ($('#address').val() == '') {
        eval("document.transferform['address'].focus()");
    } else if ($('#amount').val() == '') {
        eval("document.transferform['amount'].focus()");
    } else if ($('#verificationCode').val() == '') {
        eval("document.transferform['verificationCode'].focus()");
    } else {
        result = true;
    }
    return result;
}

var clipboard = new Clipboard('.btn-addresscopy');
clipboard.on('success', function(e) {
    toastr.success('恭喜您，複製地址成功~');
    e.clearSelection();
});
clipboard.on('error', function(e) {
    toastr.error('複製地址失敗~');
});