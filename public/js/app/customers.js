(function($,session){

    $('#frm_customer').on('submit',function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: '/api/v1/saveCustomer',
            data: data,
            headers: { 'token': session.get().token }
        }).done(function( msg ) {

            if(msg.status == "SUCCESS"){
                location.href='/secure/customers.html'
            }else{
                alert(msg.error);
            }

        });

    });



})(jQuery,new Session());