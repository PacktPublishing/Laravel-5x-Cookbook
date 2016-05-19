(function($){
    $(document).ready(function(){
        var token = false;
        $.ajax({
            type: "GET",
            url: '/api/v1/token',
            data: [],
            success: successToken
        });

        function successToken(response){
            token = response;
            post();
        }

        function success(response){
            console.log('made request');
        }

        function post(){
            $.ajax({
                type: "POST",
                url: '/api/v1/test',
                data: { '_token': token } ,
                success: success
            });
        }
    });
})(jQuery);
