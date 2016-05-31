var html = null;
$.ajax({
    url: 'api/index.php',
    type:'GET',
    dataType: 'JSON',
    data: {
        action: 'getGames',
        platform: getUrlParameter(4)
    },
    error: function(jqXhr, text, error)
    {
        console.log(error);
    },
    success: function(data, test, jqXhr)
    {
        console.log(data);
        $('#pagecontent').append(data.html);
    }
});