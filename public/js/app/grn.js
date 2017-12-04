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