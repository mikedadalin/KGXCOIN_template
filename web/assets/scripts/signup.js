$('.mailGetValicode').on('click', function() {
    //發送驗證碼
    if ($('#input-email').val() == '') {
        eval("document.signupform['input-email'].focus()");
    } else if ($('#input-mobile').val() == '') {
        eval("document.signupform['input-mobile'].focus()");
    } else if ($('#input-account').val() == '') {
        eval("document.signupform['input-account'].focus()");
    } else {
        $.ajax({
            url: "assets/class/checkAccountAndEmail.php",
            type: "POST",
            async: false,
            data: {
                "action": 'check',
                "account": $('#input-account').val(),
                "mobile": $('#input-mobile').val(),
                "countryCode": $('#input-countryCode').val(),
                "email": $('#input-email').val()
            },
            success: function(data) {
                switch (data) {
                    case 'ok':
                        /*
                        $.ajax({
                            url: "assets/class/PHPMailer/Mail-Send-VerificationCode.php",
                            type: "POST",
                            async: false,
                            data: {
                                "action": 'email',
                                "email": $('#input-email').val()
                            },
                            success: function(data) {
                                switch (data) {
                                    case 'ok':
                                        swal("已發送驗證碼");
                                        break;
                                }
                            }
                        });
                        */
                        $.ajax({
                            url: "assets/class/aliyun-dysms-php-sdk/api_demo/Sms.php",
                            type: "POST",
                            async: false,
                            data: {
                                "mobile": $('#input-mobile').val(),
                                "countryCode": $('#input-countryCode').val()
                            },
                            success: function(data) {
                                switch (data) {
                                    case 'ok':
                                        swal("已發送驗證碼");
                                        break;
                                }
                            }
                        });
                        break;
                    case 'email':
                        swal('郵箱已被註冊，請更換郵箱。');
                        break;
                    case 'mobile':
                        swal('手机号已被註冊，請更換手机号。');
                        break;
                    case 'account':
                        swal('帐号已被註冊，請更換帐号。');
                        break;
                }
            }
        });
    }
})
$('#checkbox-signup').on('click', function() {
    if (Number($('#checkbox-signup').val()) == 0) {
        $('#checkbox-signup').val(1);
    } else {
        $('#checkbox-signup').val(0);
    }
})
$('form .btn').on('click', function() {
    if (checkInput()) {
        $.ajax({
            url: "assets/class/signup.php",
            type: "POST",
            async: false,
            data: {
                "action": 'signup',
                "account": $('#input-account').val(),
                "email": $('#input-email').val(),
                "pw": $('#input-pw').val(),
                "transpw": $('#input-transpw').val(),
                "name": $('#input-name').val(),
                "mobile": $('#input-mobile').val(),
                "verificationCode": $('#verificationCode').val(),
                "countryCode": $('#input-countryCode').val()
            },
            success: function(data) {
                switch (data) {
                    case 'ok':
                        $.ajax({
                            url: "assets/class/PHPMailer/Mail-Send-Signup.php",
                            type: "POST",
                            async: false,
                            data: {
                                "action": 'signupMail',
                                "account": $('#input-account').val(),
                                "email": $('#input-email').val(),
                                "mobile": $('#input-mobile').val()
                            },
                            success: function(data) {
                                switch (data) {
                                    case 'ok':
                                        signUpSuccess($('#input-account').val());
                                        break;
                                }
                            }
                        });
                        break;
                    case 'exist':
                        swal('帳號或信箱已被註冊');
                        break;
                    case 'inputNull':
                        swal('欄位不可空白');
                        break;
                    case 'error':
                        swal('驗證碼錯誤');
                        break;
                    case 'codeError':
                        swal('特邀代碼錯誤');
                        break;
                }
            }
        });
    }
})

// Sign up success
function signUpSuccess(account) {
    swal(
            account + '歡迎您的加入',
            '即刻前往KGX市場，體驗KGX的強大魅力',
            'success')
        .then((result) => {
            window.location.replace("trans.php");
        });
}

// Check input
function checkInput() {
    var result = false;
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ($('#input-account').val() == '') {
        eval("document.signupform['input-account'].focus()");
    } else if ($('#input-email').val() == '') {
        eval("document.signupform['input-email'].focus()");
    } else if (!regex.test($('#input-email').val())) {
        eval("document.signupform['input-email'].focus()");
    } else if ($('#input-pw').val() == '') {
        eval("document.signupform['input-pw'].focus()");
    } else if ($('#input-repw').val() == '') {
        eval("document.signupform['input-repw'].focus()");
    } else if ($('#input-pw').val() != $('#input-repw').val()) {
        eval("document.signupform['input-repw'].focus()");
        swal('密碼不一致');
    } else if ($('#input-transpw').val() == '') {
        eval("document.signupform['input-transpw'].focus()");
    } else if ($('#input-retranspw').val() == '') {
        eval("document.signupform['input-retranspw'].focus()");
    } else if ($('#input-transpw').val() != $('#input-retranspw').val()) {
        eval("document.signupform['input-retranspw'].focus()");
        swal('交易密碼不一致');
    } else if ($('#input-name').val() == '') {
        eval("document.signupform['input-name'].focus()");
    } else if ($('#input-mobile').val() == '') {
        eval("document.signupform['input-mobile'].focus()");
    } else if ($('#verificationCode').val() == '') {
        eval("document.signupform['verificationCode'].focus()");
    } else if (Number($('#checkbox-signup').val()) != 1) {
        eval("document.signupform['checkbox-signup'].focus()");
        swal('請阅读并同意\n《KGX用户服务协议》');
    } else {
        result = true;
    }
    return result;
}