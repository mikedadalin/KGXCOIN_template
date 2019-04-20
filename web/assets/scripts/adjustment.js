$('#adjustment').change(function (){
    var value = Number($('#adjustment').val());
    if (value == '') {
        value = 0;
        $('#adjustment').val(value);
    }
    $.ajax({
        url: "assets/class/adjustment.php",
        async: false,
        type:'POST',
        data: {
            "action": "adjustment",
            "value": value
        },
        success: function(data){
            switch (data) {
                case 'ok':
                    swal('匯率已更新');
                    break;
                case 'no':
                    break;
            }
        }
    });
});