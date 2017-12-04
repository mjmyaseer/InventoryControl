$("#submit").click(function () {
    alert('ssss');
    var email=$("#email").val();
    var password= $("#password").val();

    if (email == '') {
        $("#ons").text("Email field is required");
        return false;
    }else{
        $("#ons").text("");
    }

    if (password == '') {
        $("#ins").text("Password Field is required");
        return false;
    }else{
        $("#ins").text("");
    }

});


(function($,session){

//console.log('testttt')

    $('#frm_signup').on('submit',function(e){
        e.preventDefault();

        var data = $(this).serialize();

        //Call API

        $.ajax({
            method: "POST",
            url: '/api/sign-up',
            data: data
        }).done(function( msg ) {

            if(msg.status == "SUCCESS"){
                location.href='/'
            }else{
                alert(msg.error);
            }

        });

    });



    $('#alert_message').css('display','none');  //clear error displaying section
    $('#login_form').on('submit',function(e){
        e.preventDefault();

        var options = {
            data    : $(this).serialize(),
            method  : $(this).attr('method'),
            url     : $(this).attr('action')
        };

        $.ajax(options).done(function(data){
            if(data.status == "SUCCESS"){
                session.set(data.user);     //call session.set method with token parameter (see session.js)
                location.href ='secure/dashboard.html';

            }else{

                $('#alert_message > .alert-body').html(data.error);
                $('#alert_message').css('display','block');
            }
        });


    });

})(jQuery,new Session());

//above parameter pasing method is called "Dependancy Injection"
//this is a self involking method

