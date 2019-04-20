// Check input
function checkInput() {
    var result = false;
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ($('#input-mail').val() == '') {
        eval("document.tran_pw_form['input-mail'].focus()");
        swal('請輸入Email');
    } else if (!regex.test($('#input-mail').val())) {
        eval("document.tran_pw_form['input-mail'].focus()");
        swal('Email格式錯誤');
    } else if ($('#input-newpw').val() == '') {
        eval("document.tran_pw_form['input-newpw'].focus()");
        swal('請輸入新密碼');
    } else if ($('#input-repw').val() == '') {
        eval("document.tran_pw_form['input-repw'].focus()");
        swal('請再輸入新密碼');
    } else if ($('#verificationCode').val() == '') {
        eval("document.tran_pw_form['verificationCode'].focus()");
        swal('請輸入驗證碼');
    } else {
        result = true;
    }
    return result;
}

// 重設密碼 ajax
$("#tran_pw_button").click(function() {
    checkInput();
    $.ajax({
        url: "assets/class/reset_pw.php",
        type: "POST",
        async: false,
        data: {
            "action": "reset_pw",
            "mail": $("#input-mail").val(),
            "newpw": $("#input-newpw").val(),
            "re-newpw": $("#input-repw").val(),
            "vercode": $("#verificationCode").val()
        },
        success: function(data) {
            switch (data) {
                case 'ok':
                    swal(
                        '密碼修改完成',
                        '即將前往登入頁面',
                        'success'
                    )
                    .then((result) => {
                        window.location.replace("signin.php");
                    });
                    break;
                case 'newpwno':
                    swal('新密碼兩次輸入不一樣');
                    break;
                case 'vercodeno':
                    swal('驗證碼錯誤');
                    break;
            }
        }
    })
});