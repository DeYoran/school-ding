$('document').ready(function()
{
    $.ajax({
        url: 'api/index.php',
        type:'GET',
        dataType: 'text',
        data: {
            action: 'getBasket'
        },
        success: function(a, b, c){
            $('#basketTable').append(a);
        },
        error:function(a,b,c){
            console.log(a);
            console.log(b);
            console.log(c);
        }
    });

    $.ajax({
        url: 'api/index.php',
        type:'GET',
        dataType: 'text',
        data: {
            action: 'getTotaal'
        },
        success: function(a, b, c){
            $('#total').append(a);
        },
        error:function(a,b,c){
            console.log(a);
            console.log(b);
            console.log(c);
        }
    });

    $('#order').click(function(){
         $.ajax({
            url: 'api/index.php',
            type:'GET',
            dataType: 'text',
            data: {
                action: 'order'
            },
            success: function(a, b, c){
                //window.location.href = '/game/';
            },
            error:function(a,b,c){
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });

});