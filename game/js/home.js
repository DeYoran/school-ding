var html = null;

$.ajax({
    url: 'api/index.php',
    type:'GET',
    dataType: 'JSON',
    data: {
        action: 'getNews',
        platform: getUrlParameter(4)
    },
    error: function(jqXhr, text, error)
    {
        console.log(error);
    },
    success: function(data, test, jqXhr)
    {
        console.log(data);
        $('#news').append(data.html);
    }
});

$('.videolink').click(function(){
    $('.videolink').removeClass('active');
    vid = $(this).attr('data-link');
    html = ''+
    '<div class="video" ><object id="video" type="application/x-shockwave-flash" style="width:624px; height: 351px;" data="//www.youtube.com/v/'+vid+'?color2=FBE9EC&amp;version=3">'+
        '<param name="movie" value="//www.youtube.com/v/'+vid+'?color2=FBE9EC&amp;version=1" />'+
        '<param name="allowFullScreen" value="true" />'+
        '<param name="allowscriptaccess" value="always" />'+
        '</object>'+
    '</div>';
    $('.video').html(html);
    $(this).addClass('active');
    return false();
});

var headerslider = function(){
    obj = $('.showcasebutton.active');
    img =  $('.showcaseimg.active');
    img.removeClass('active');
    next = obj.next();
    nexti = img.next();
    obj.removeClass('active');
    if(next.hasClass('showcasebutton')){
        next.addClass('active');
        nexti.addClass('active');
    }
    else{
        $('.showcasebutton').first().addClass('active');
        $('.showcaseimg').first().addClass('active');
    }
}
headerTimer = setInterval(headerslider,6000);

$('.showcasebutton').click(function(){
    $('.showcasebutton').removeClass('active');
    $(this).addClass('active');
    nth = $(this).prevAll().size()+1;
    $('.showcaseimg').removeClass('active');
    $('.showcaseimg:nth-of-type('+nth+')').addClass('active');
    clearInterval(headerTimer);
    headerTimer = setInterval(headerslider,6000);
});