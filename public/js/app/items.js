(function($,session){

    // $('#frm_item').on('submit',function(e){
    //     e.preventDefault();
    //
    //     var data = $(this).serialize();
    //
    //     $.ajax({
    //         method: "POST",
    //         url: '/InventoryControl/public/secure/add-items',
    //         data: data,
    //         headers: { 'token': session.get().token }
    //     }).done(function( msg ) {
    //
    //         if(msg.status == "SUCCESS"){
    //             location.href='/secure/items.html'
    //         }else{
    //             alert(msg.error);
    //         }
    //
    //     });
    //
    // });
})(jQuery,new Session());

$("#submit").click(function () {

    var title=$("#title").val();
    var description= $("#description").val();
    var unit_price= $("#unit_price").val();
    var max_retail_price= $("#max_retail_price").val();
    var reorder_level= $("#reorder_level").val();

    if (title == '') {
        $("#title_sp").text("Item Title field is required");
        return false;
    }else{
        $("#title_sp").text("");
    }

    if (description == '') {
        $("#desc_sp").text("Item Description Field is required");
        return false;
    }else{
        $("#desc_sp").text("");
    }

    if (unit_price == '') {
        $("#unitp_sp").text("Unit Price Field is required");
        return false;
    }else{
        $("#unitp_sp").text("");
    }

    if (max_retail_price == '') {
        $("#maxret_sp").text("Max Retail Price Field is required");
        return false;
    }else{
        $("#maxret_sp").text("");
    }

    if (reorder_level == '') {
        $("#reorder_sp").text("Re-Order Level Field is required");
        return false;
    }else{
        $("#reorder_sp").text("");
    }

});