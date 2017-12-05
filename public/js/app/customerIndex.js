$("#search_button").click(function () {

    var category = $("#search_txt").val();

    if (category == '') {
        $("#sear_txt").text("Search Field is required");
        return false;
    }else{
        $("#sear_txt").text("");
    }



    $.ajax({
        method: "get",
        url: '/InventoryControl/public/secure/sear-cux',
        data: {keyword: category}
    }).done(function (data) {
        if (data) {

            var selOpts = "";
            $('#example').html('');

            selOpts += "<thead> <tr>" +
                "<th>#ID</th>" +
                "<th>Customer Code</th>" +
                "<th>Name</th>" +
                "<th>Email</th>" +
                "<th>Telephone</th>" +
                "<th>Address</th>" +
                "<th>Edit</th>" +
                "</tr></thead>";
            var cal = 1;
            $.each(data, function (k, v) {
                var id = data[k].customer_id;
                var customer_code = data[k].customer_code;
                var customer_name = data[k].customer_name;
                var customer_email = data[k].customer_email;
                var customer_telephone = data[k].customer_telephone;
                var customer_address = data[k].customer_address;

                selOpts += "<tr class='gradeX'>" +
                    "<td>" + cal + "</td>" +
                    "<td>" + customer_code + "</td>" +
                    "<td>" + customer_name + "</td>" +
                    "<td>" + customer_email + "</td>" +
                    "<td>" + customer_telephone + "</td>" +
                    "<td>" + customer_address + "</td>" +
                    "<td style='text-align: center'>" +
                    "<a href='/InventoryControl/public/secure/add-customers/"+ id +"'>Edit</a></td>";
                cal ++;
            });
            $('#example').append(selOpts);

        } else {
        }
    });
});