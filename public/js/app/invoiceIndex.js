$("#search_button").click(function () {

    var category = $("#search_txt").val();

    if (category == '') {
        $("#sear_txt").text("Search Field is required");
        return false;
    } else {
        $("#sear_txt").text("");
    }


    $.ajax({
        method: "get",
        url: '/InventoryControl/public/secure/sear-customers',
        data: {keyword: category}
    }).done(function (data) {
        if (data) {

            var selOpts = "";
            $('#example').html('');

            selOpts += "<thead> <tr>" +
                "<th>#ID</th>" +
                "<th>Customer Name</th>" +
                "<th>Item</th>" +
                "<th>Quantity</th>" +
                "<th>Dispatch Date</th>" +
                "<th>Unit Price</th>" +
                "<th>Return</th>" +
                "</tr></thead>";
            var cal = 1;
            $.each(data, function (k, v) {
                var id = data[k].id;
                var customer_name = data[k].customer_name;
                var title = data[k].title;
                var sales_quantity = data[k].sales_quantity;
                var dispatch_date = data[k].dispatch_date;
                var unit_price = data[k].unit_price;
                var returns = data[k].status;
                var returnState = '';
                var stat = '';

                if (returns == 1) {

                    returnState = "Return Order";
                    stat = '';

                } else if (returns == 2) {
                    returnState = "Order Returned";
                    stat = 'disabled';
                }

                selOpts += "<tr class='gradeX'>" +
                    "<td>" + cal + "</td>" +
                    "<td>" + customer_name + "</td>" +
                    "<td>" + title + "</td>" +
                    "<td>" + sales_quantity + "</td>" +
                    "<td>" + dispatch_date + "</td>" +
                    "<td>" + unit_price + "</td>" +
                    "<td width='20px'><button type='button' class='btn btn-info btn-sm'" + stat + " >"
                    + returnState + "</button></td>" +
                    "</tr>";
                cal ++;
            });
            $('#example').append(selOpts);


        } else {
        }
    });
});