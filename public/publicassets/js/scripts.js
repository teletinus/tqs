$(document).ready(function () {
    $('.btn-increment').on('click', function(){
            $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/api/increment",
            beforeSend: function () {
            },
            success: function (data) {
                if(data.status == 'ok'){
                    $('span.value').html(data.value.value);
                }
            }
        });
    });
    
       $('.btn-decrement').on('click', function(){
            $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/api/decrement",
            beforeSend: function () {
            },
            success: function (data) {
                if(data.status == 'ok'){
                    $('span.value').html(data.value.value);
                }
            }
        });
    });
});