$('.getValideCode .btn').on('click', function() {
    getValideCode();
})
$('.valideCodeSuccess .btn').on('click', function() {
    valideCodeSuccess();
})

function getValideCode() {
    //發送驗證碼
    $.ajax({
        url: "assets/class/PHPMailer/Mail-Send-VerificationCode.php",
        type: "POST",
        async: false,
        data: {
            "action": 'changePassword'
        },
        success: function(data) {
            switch (data) {
                case 'ok':
                    toastr.success('已發送驗證碼');
                    break;
                // case 'nook':
            }
        }
    });

    // swal(
    //     '驗證碼已發送',
    //     '包含驗證碼的訊息已傳送至Email(y****u@g*****.*om)，請立即接收並填入驗證碼',
    //     'success'
    // )
}

function valideCodeSuccess() {
    swal(
        '恭喜您已完成驗證',
        '日後每當進行轉出交易時，系統將會發送驗證碼到您的信箱，請在交易時輸入驗證碼才能完成交易',
        'success'
    )
}

// Check input
function checkInput() {
    var result = false;
    if ($('#input-pw').val() == '') {
        eval("document.tran_pw_form['input-pw'].focus()");
        swal('請輸入目前密碼');
    } else if ($('#input-newpw').val() == '') {
        eval("document.tran_pw_form['input-newpw'].focus()");
        swal('請輸入新密碼');
    } else if ($('#input-repw').val() == '') {
        eval("document.tran_pw_form['input-repw'].focus()");
        swal('請再輸入新密碼');
    } else if ($('#verificationCode').val() == '') {
        eval("document.tran_pw_form['verificationCode'].focus()");
        swal('請輸入驗證碼');
    }
      else {
        result = true;
    }
    return result;
}


// 重設密碼 ajax
$("#tran_pw_button").click(function() {
    checkInput();
    $.ajax({
        url: "assets/class/trans_pw.php",
        type: "POST",
        async: false,
        data: {
            "action": "trans_pw",
            "oldpw": $("#input-pw").val(),
            "newpw": $("#input-newpw").val(),
            "re-newpw": $("#input-repw").val(),
            "vercode": $("#verificationCode").val()
        },
        success: function(data) {
            switch (data) {     
                case 'ok':
                    swal('密碼修改完成');
                    break;
                case 'oldpwno':
                    swal('目前輸入密碼錯誤');
                    break;
                case 'newpwno':
                    swal('新密碼兩次輸入不一樣');
                    break;
                case 'thesameno':
                    swal('新密碼與舊密碼重複');
                    break;
                case 'vercodeno':
                    swal('驗證碼錯誤');
                    break;
            }
        }
    })
});