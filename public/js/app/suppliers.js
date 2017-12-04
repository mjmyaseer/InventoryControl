(function ($, session) {

    // $('#frm_supplier').on('submit',function(e){
    //     e.preventDefault();
    //
    //     var data = $(this).serialize();
    //
    //     $.ajax({
    //         method: "POST",
    //         url: '/api/v1/saveSupplier',
    //         data: data,
    //         headers: { 'token': session.get().token }
    //     }).done(function( msg ) {
    //
    //         if(msg.status == "SUCCESS"){
    //             location.href='/secure/suppliers.html'
    //         }else{
    //             alert(msg.error);
    //         }
    //
    //     });
    //
    // });


    $("#submit").click(function () {

        var supplier_code = $("#supplier_code").val();
        var supplier_name = $("#supplier_name").val();
        var supplier_telephone = $("#supplier_telephone").val();
        var supplier_email = $("#supplier_email").val();
        var supplier_address = $("#supplier_address").val();

        if (supplier_code == '') {
            $("#supp_code").text("Supplier Code field is required");
            return false;
        } else {
            $("#supp_code").text("");
        }

        if (supplier_name == '') {
            $("#supp_name").text("Supplier Name Field is required");
            return false;
        } else {
            $("#supp_name").text("");
        }

        if (supplier_telephone == '') {
            $("#sup_phone").text("Supplier Phone Field is required");
            return false;
        } else {
            $("#sup_phone").text("");
        }

        if (supplier_email == '') {
            $("#email").text("Supplier Email Field is required");
            return false;
        } else {
            $("#email").text("");
        }

        if (supplier_address == '') {
            $("#address").text("Supplier Address Field is required");
            return false;
        } else {
            $("#address").text("");
        }

    });


})(jQuery, new Session());