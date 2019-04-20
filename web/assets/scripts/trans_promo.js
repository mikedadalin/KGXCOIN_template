// Promo to KGX
function promo(type){
    var rate = Number($('#rateKGXtoUSD').html());
    switch (type) {
        case 1:
            var kgx = Math.round(eval(60000/rate));
            var amount = eval(kgx*rate);
            break;
        case 2:
            var kgx = Math.round(eval(40000/rate));
            var amount = eval(kgx*rate);
            break;
        case 3:
            var kgx = Math.round(eval(20000/rate));
            var amount = eval(kgx*rate);
            break;
    }
    swal({
        title: "確認購買優惠1",
        text: kgx + " KGX 總計 " + amount + " USD",
        type: "info",
        showCancelButton: true,
        cancelButtonText: '取消',
        confirmButtonText: '確認'
    })
    .then((result) => {
        if (result.value) {
            $.ajax({
                url: "assets/class/promo.php",
                type: "POST",
                async: false,
                data: {
                    "action": 'promo',
                    "kgx": kgx
                },
                success: function(data) {
                    swal(
                        '感謝您的購買',
                        '即將前往支付頁面',
                        'success'
                    )
                    .then((result) => {
                        window.location.replace("trans_buygx.php");
                    });
                    console.log('前往支付頁面');
                }
            });
        } else {
            swal("您已取消購買!");
        }
    });
}