(function ($, session) {

    // $('#frm_customer').on('submit',function(e){
    //     e.preventDefault();
    //
    //     var data = $(this).serialize();
    //
    //     $.ajax({
    //         method: "POST",
    //         url: '/api/v1/saveCustomer',
    //         data: data,
    //         headers: { 'token': session.get().token }
    //     }).done(function( msg ) {
    //
    //         if(msg.status == "SUCCESS"){
    //             location.href='/secure/customers.html'
    //         }else{
    //             alert(msg.error);
    //         }
    //
    //     });
    //
    // });

    $("#submit").click(function () {

        var customer_code = $("#customer_code").val();
        var customer_name = $("#customer_name").val();
        var customer_email = $("#customer_email").val();
        var customer_telephone = $("#customer_telephone").val();
        var customer_address = $("#customer_address").val();
        cus_code
        cus_name
        cus_email
        cus_telephone
        cus_address

        if (customer_code == '') {
            $("#cus_code").text("Customer Code field is required");
            return false;
        } else {
            $("#cus_code").text("");
        }

        if (customer_name == '') {
            $("#cus_name").text("Customer Name Field is required");
            return false;
        } else {
            $("#cus_name").text("");
        }

        if (customer_email == '') {
            $("#cus_email").text("Customer Email Field is required");
            return false;
        } else {
            $("#cus_email").text("");
        }

        if (customer_telephone == '') {
            $("#cus_telephone").text("Customer Telephone Field is required");
            return false;
        } else {
            $("#cus_telephone").text("");
        }

        if (customer_address == '') {
            $("#cus_address").text("Customer Address Field is required");
            return false;
        } else {
            $("#cus_address").text("");
        }

    });


})(jQuery, new Session());