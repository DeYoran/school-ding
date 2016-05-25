setTimeout(function(){
$("#addToCart").click(function(){
    $.ajax({
    url: 'api/index.php',
    type:'GET',
    dataType: 'text',
    data: {
        action: 'addToCart',
        game: getUrlParameter(4),
        aantal: 1
    },
    success: function(a, b, c){
        console.log(a);
        console.log(b);
        console.log(c);
        
    },
    error:function(a,b,c){
        console.log(a);
        console.log(b);
        console.log(c);
    }
    });
});
},1000);
$.ajax({
    url: 'api/index.php',
    type:'GET',
    dataType: 'text',
    data: {
        action: 'getGameInfo',
        game: getUrlParameter(4),
    },
    success: function(a, b, c){
        $('#pagecontent').html(a);
    },
    error:function(a,b,c){
        console.log(a);
        console.log(b);
        console.log(c);
    }
});