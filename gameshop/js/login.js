$('input[type="submit"]').click(function(){
	$.ajax({
	    url: 'api/index.php?action=login',
	    type:'POST',
	    dataType: 'JSON',
	    data: {
	        klantnr: $('#klant').val(),
	        pass: $('#password').val()
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
});