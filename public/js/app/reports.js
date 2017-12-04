$(document).ready(function () {

    $('#dp3').datepicker();

    $('#sandbox-container input').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
    });

    $('#sandbox-container input').on('show', function(e){
        console.debug('show', e.date, $(this).data('stickyDate'));

        if ( e.date ) {
            $(this).data('stickyDate', e.date);
        }
        else {
            $(this).data('stickyDate', null);
        }
    });

    $('#sandbox-container input').on('hide', function(e){
        console.debug('hide', e.date, $(this).data('stickyDate'));
        var stickyDate = $(this).data('stickyDate');

        if ( !e.date && stickyDate ) {
            console.debug('restore stickyDate', stickyDate);
            $(this).datepicker('setDate', stickyDate);
            $(this).data('stickyDate', null);
        }
    });
});


$("#submit").click(function () {

    var category=$("#category").val();
    var startdate= $("#startdate").val();
    var enddate= $("#enddate").val();

    if (category == '' || category == 0 || category == null) {
        $("#cate").text("Category field is required");
        return false;
    }else{
        $("#cate").text("");
    }

    if (startdate == '') {
        $("#start").text("Start Date Field is required");
        return false;
    }else{
        $("#start").text("");
    }

    if (enddate == '') {
        $("#end").text("End Date  Field is required");
        return false;
    }else{
        $("#end").text("");
    }

});

$("#export").click(function () {

    var category=$("#category").val();
    var startdate= $("#startdate").val();
    var enddate= $("#enddate").val();

    if (category == '' || category == 0 || category == null) {
        $("#cate").text("Category field is required");
        return false;
    }else{
        $("#cate").text("");
    }

    if (startdate == '') {
        $("#start").text("Start Date Field is required");
        return false;
    }else{
        $("#start").text("");
    }

    if (enddate == '') {
        $("#end").text("End Date  Field is required");
        return false;
    }else{
        $("#end").text("");
    }

});