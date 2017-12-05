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
        url: '/InventoryControl/public/secure/sear-supp',
        data: {keyword: category}
    }).done(function (data) {
        if (data) {
            var selOpts = "";
            $('#example').html('');

            selOpts += "<thead> <tr>" +
                "<th>#ID</th>" +
                "<th>Supplier Code</th>" +
                "<th>Name</th>" +
                "<th>Telephone</th>" +
                "<th>Email</th>" +
                "<th>Address</th>" +
                "<th>Edit</th>" +
                "</tr></thead>";
            var cal = 1;
            $.each(data, function (k, v) {
                var id = data[k].supplier_id;
                var supplier_code = data[k].supplier_code;
                var supplier_name = data[k].supplier_name;
                var supplier_email = data[k].supplier_email;
                var supplier_telephone = data[k].supplier_telephone;
                var supplier_address = data[k].supplier_address;


                selOpts += "<tr class='gradeX'>" +
                    "<td>" + cal + "</td>" +
                    "<td>" + supplier_code + "</td>" +
                    "<td>" + supplier_name + "</td>" +
                    "<td>" + supplier_email + "</td>" +
                    "<td>" + supplier_telephone + "</td>" +
                    "<td>" + supplier_address + "</td>" +
                    "<td style='text-align: center'>" +
                    "<a href='/InventoryControl/public/secure/add-suppliers/"+ id +"'>Edit</a></td>";
                cal ++;
            });
            $('#example').append(selOpts);

        } else {
        }
    });
});