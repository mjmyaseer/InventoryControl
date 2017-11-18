(function($){

    $('#frm_category').on('submit',function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: '/api/v1/saveCategory',
            data: data
        }).done(function( msg ) {

            if(msg.status == "SUCCESS"){
                location.href='/secure/categories.html'
            }else{
                alert(msg.error);
            }

        });

    });



})(jQuery);