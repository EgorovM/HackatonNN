$.ajax({

    cache: false,
    url: 'http://172.20.10.3:8000/',
    type: "POST",
    data: {

        login: 'hello'

    },
    success: function(e){
        alert(e);
    },
    error: ws.wrap('MovieTmpl', function () {
        alert('Error loading MovieTmpl.htm!');
    })

});
