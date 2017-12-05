$(document).ready(function () {

    var max_fields = 10; //maximum input boxes allowed

    var wrapper = $("#input_fields_wrap"); //Fields wrapper

    var add_button = $("#add_field_button"); //Add button ID


    var x = 1; //initlal text box count

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text

        e.preventDefault();
        $(this).parent('div').remove();
        x--;

    })

    $('#sandbox-container input').datepicker({
        autoclose: true,
        format: "dd MM yyyy",
    });

    $('#sandbox-container input').on('show', function (e) {
        console.debug('show', e.date, $(this).data('stickyDate'));

        if (e.date) {
            $(this).data('stickyDate', e.date);
        }
        else {
            $(this).data('stickyDate', null);
        }
    });

    $('#sandbox-container input').on('hide', function (e) {
        console.debug('hide', e.date, $(this).data('stickyDate'));
        var stickyDate = $(this).data('stickyDate');

        if (!e.date && stickyDate) {
            console.debug('restore stickyDate', stickyDate);
            $(this).datepicker('setDate', stickyDate);
            $(this).data('stickyDate', null);
        }
    });
});

$("#category").change(function () {

    var category = $("#category").val();

    $.ajax({
        method: "get",
        url: '/InventoryControl/public/secure/cat-items',
        data: {id: category}
    }).done(function (data) {
        if (data) {
            var selOpts = "";
            $('#items').html('');
            $.each(data, function (k, v) {
                var id = data[k].id;
                var val = data[k].title;
                selOpts += "<option value='" + id + "'>" + val + "</option>";
            });
            $('#items').append(selOpts);

        } else {

        }
    });
});

