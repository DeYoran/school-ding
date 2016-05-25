$('document').ready(function(){
    imgurl = './img/'+getUrlParameter('game')+'.jpg';
    if(getUrlParameter('page') && getUrlParameter('page') != '#'){
        console.log(getUrlParameter('page'));
        page = getUrlParameter('page');
    }
    else{
        page = "home";
    }
    pageurl = './pages/'+page+'.html';
    jsurl = './js/'+page+'.js';

    $.ajax({
        url: imgurl,
        type:'HEAD',
        error: function()
        {
            $('#content').css("background-image", "url(./img/background.jpg)");
        },
        success: function()
        {
            $('#content').css("background-image", "url("+imgurl+")");
        }
    });

    $.ajax({
        url: pageurl,
        type:'GET',
        error: function(jqXhr, text, error)
        {
            $('#pageheader').css("background-image", "url(./img/headers/404.png)");
            $('#pagecontent').html("<h3>"+text+"</h3>"+error);
            console.log(jqXhr);
        },
        success: function(data, test, jqXhr)
        {
            $('#pageheader').css("background-image", "url(./img/headers/"+page+".png)");
            $('#pagecontent').html(data);
            $('#pagecontent').addClass(page);
            $.getScript('js/'+page+'.js', function(){
                //script loaded and parsed
            }).fail(function(){
                if(arguments[0].readyState==0){
                    //script failed to load
                }else{
                    console.log(arguments);
                    throw arguments[2].toString();
                }
            });            $('a[href="#"]').click(function(){
                return false;
            });
        }
    });

    $.ajax({
        url: imgurl,
        type:'GET',
        error: function()
        {
            $('#content').css("background-image", "url(./img/background.jpg)");
        },
        success: function()
        {
            $('#content').css("background-image", "url("+imgurl+")");
        }
    });

});

function getUrlParameter(sParam)
{
    if(sParam == "page"){
        sParam = 3;
    }
    var sPageURL = window.location.href;
    var sURLVariables = sPageURL.split('/');
    if(sURLVariables[2] == "localhost"){
        sURLVariables.shift();
    }
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        if(i === sParam){
            return sURLVariables[i];
        }
    }
}   

function popup(titel, html)
{
    phtml = 
    '<div id="popupbackground">'+
        '<div id="popup">'+
            '<div id="popuptitel">'+titel+'<a id="close" href="#"><i class="fa fa-times"></i></a></div>'+
            '<div id="popupinhoud">'+html+'</div>'+
        '</div>';
    '</div>';
    $('body').append(phtml);
    $('body').css({overflow: 'hidden'});
    $('#close').click(function(){
        console.log('sdsd');
        $('#popupbackground').remove();
        $('body').css({overflow: 'scroll'});
    });
}