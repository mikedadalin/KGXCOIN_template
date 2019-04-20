/*
function callback(res){
    console.log(res)
        //res（未通过验证）= {ret:1,ticket:null}
        //res（验证成功） = {ret:0,ticket:"String"}
    if(res.ret == 0){
        //alert(res.ticket);   // 票据
        $('#ticket').val(res.ticket);
        $('#randstr').val(res.randstr);
    }
}
*/
/* 阿里雲
var nc_token = ["FFFF00000000017A9DA1", (new Date()).getTime(), Math.random()].join(':');
var NC_Opt = 
{
    renderTo: "#your-dom-id",
    appkey: "FFFF00000000017A9DA1",
    scene: "nc_login",
    token: nc_token,
    customWidth: 300,
    trans:{"key1":"code0"},
    elementID: ["usernameID"],
    is_Opt: 0,
    language: "cn",
    isEnabled: true,
    timeout: 3000,
    times:5,
    apimap: {
        // 'analyze': '//a.com/nocaptcha/analyze.jsonp',
        // 'get_captcha': '//b.com/get_captcha/ver3',
        // 'get_captcha': '//pin3.aliyun.com/get_captcha/ver3'
        // 'get_img': '//c.com/get_img',
        // 'checkcode': '//d.com/captcha/checkcode.jsonp',
        // 'umid_Url': '//e.com/security/umscript/3.2.1/um.js',
        // 'uab_Url': '//aeu.alicdn.com/js/uac/909.js',
        // 'umid_serUrl': 'https://g.com/service/um.json'
    },
    callback: function (data) {
        window.console && console.log(nc_token)
        window.console && console.log(data.csessionid)
        window.console && console.log(data.value)
        window.console && console.log(data.sig)
        window.console && console.log(data.token)
        $('#csessionid').val(data.csessionid);
        $('#token').val(data.token);
        $('#sig').val(data.sig);
    }
}
var nc = new noCaptcha(NC_Opt)
nc.upLang('cn', {
    _startTEXT: "请按住滑块，拖动到最右边",
    _yesTEXT: "验证通过",
    _error300: "哎呀，出错了，点击<a href=\"javascript:__nc.reset()\">刷新</a>再来一次",
    _errorNetwork: "网络不给力，请<a href=\"javascript:__nc.reset()\">点击刷新</a>",
})
*/
function signin() {
    if (checkInput()) {
        $.ajax({
            url: "assets/class/signin.php",
            type: "POST",
            async: false,
            data: {
                "action": 'signin',
                "account": $('#input-account').val(),
                "pw": $('#input-pw').val(),
                "geetest_challenge": $('input[name="geetest_challenge"]').val(),
                "geetest_validate": $('input[name="geetest_validate"]').val(),
                "geetest_seccode": $('input[name="geetest_seccode"]').val()
                /*阿里雲
                "csessionid": $('#csessionid').val(),
                "token": $('#token').val(),
                "sig": $('#sig').val()
                */
                /*騰訊
                "ticket": $('#ticket').val(),
                "randstr": $('#randstr').val()
                */
            },
            success: function(data) {
                var data_array = data.split('}');
                if (data_array.length == 1) {
                    data = data_array[0];
                } else {
                    data = data_array[1];
                }
                switch (data) {
                    case 'ok':
                        document.location.href = 'trans.php';
                        break;
                    case 'no':
                        swal('帳號密碼或驗證錯誤');
                        break;
                    case 'vno':
                        swal('驗證錯誤');
                        break;
                }
            }
        });
    }
}

// Check input
function checkInput() {
    var result = false;
    if ($('#input-account').val() == '') {
        eval("document.signinform['input-account'].focus()");
    } else if ($('#input-pw').val() == '') {
        eval("document.signinform['input-pw'].focus()");
    } else {
        result = true;
    }
    return result;
}

function forgetPassword() {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ($('#forgetPassword_mail').val() == '') {
        eval("document.recoverform['forgetPassword_mail'].focus()");
    } else if (!regex.test($('#forgetPassword_mail').val())) {
        eval("document.recoverform['forgetPassword_mail'].focus()");
    } else {
        $.ajax({
            url: "assets/class/forgetPassword.php",
            type: "POST",
            async: false,
            data: {
                "action": 'forgetPassword',
                "mail": $('#forgetPassword_mail').val()
            },
            success: function(data) {
                switch (data) {
                    case 'ok':
                        //發送驗證碼
                        $.ajax({
                            url: "assets/class/PHPMailer/Mail-Send-VerificationCode.php",
                            type: "POST",
                            async: false,
                            data: {
                                "action": 'forgetPassword',
                                "email": $('#forgetPassword_mail').val()
                            },
                            success: function(data) {
                                switch (data) {
                                    case 'ok':
                                        swal("已發送郵件，請至郵箱確認。");
                                        break;
                                }
                            }
                        });
                        break;
                    case 'no':
                        swal('請確認信箱是否有誤');
                        break;
                }
            }
        });
    }
}
// geetest 驗證
var handlerEmbed = function (captchaObj) {
    $("#embed-submit").click(function (e) {
        var validate = captchaObj.getValidate();
        if (!validate) {
            $("#notice")[0].className = "show";
            setTimeout(function () {
                $("#notice")[0].className = "hide";
            }, 2000);
            e.preventDefault();
        }
    });
    // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
    captchaObj.appendTo("#embed-captcha");
    captchaObj.onReady(function () {
        $("#wait")[0].className = "hide";
    });
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$.ajax({
    // 获取id，challenge，success（是否启用failback）
    url: "assets/class/gt3-php-sdk-master/web/StartCaptchaServlet.php?t=" + (new Date()).getTime(), // 加随机数防止缓存
    type: "get",
    dataType: "json",
    success: function (data) {
        console.log(data);
        // 使用initGeetest接口
        // 参数1：配置参数
        // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
        initGeetest({
            gt: data.gt,
            challenge: data.challenge,
            new_captcha: data.new_captcha,
            product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
            offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
            // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
        }, handlerEmbed);
    }
});
