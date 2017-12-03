$("#submit").click(function () {

    var title=$("#title").val();
    var description= $("#description").val();

    if (title == '') {
        $("#ons").text("Category Title field is required");
        return false;
    }else{
        $("#ons").text("");
    }

    if (description == '') {
        $("#ins").text("Category Description Field is required");
        return false;
    }else{
        $("#ins").text("");
    }

});

// (function($){
//
//     $('#frm_category').on('submit',function(e){
//         e.preventDefault();
//
//         var data = $(this).serialize();
//
//         $.ajax({
//             method: "POST",
//             url: '/InventoryControl/public/secure/add-categories',
//             data: data
//         }).done(function( msg ) {
//
//             if(msg.status == "SUCCESS"){
//                 location.href='/secure/categories'
//             }else{
//                 $("#ons").text(msg.error);
//             }
//
//         });
//
//     });
// })(jQuery);


