$("#submit").click(function () {

    var firstname = $("#first_name").val();
    var lastname = $("#last_name").val();
    var email = $("#email").val();

    if (firstname == '') {
        $("#fname").text("First Name field is required");
        return false;
    } else {
        $("#fname").text("");
    }

    if (lastname == '') {
        $("#lname").text("Last Name Field is required");
        return false;
    } else {
        $("#lname").text("");
    }

    if (email == '') {
        $("#mail").text("Email Field is required");
        return false;
    } else {
        $("#mail").text("");
    }

});