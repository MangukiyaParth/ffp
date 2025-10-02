$(function () {
var loginFormData = '';

$('.panel-body #loginform').validate({
    rules: {
        email: {
            required: true,
        },
        password: {
            required: true,
            minlength: 6,
            maxlength: 25
        },
    },

    highlight: function (element) {
        $(element).addClass("field-error");
    },
    unhighlight: function (element) {
        $(element).removeClass("field-error");
    },
    errorPlacement: function (error, element) {
        return false;

    },
    submitHandler: function (form) {
        //$('#loginform').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#loginform').find(':submit').attr("disabled", true);

        var data = new FormData();

        /*Form data*/
        var form_data = $('#loginform').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        var emailValue = $("#email").val();

        $.ajax({
            type: 'post',
            url: Admin_url + 'auth/sentotp',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response1) {
                
                var data1 = jQuery.parseJSON(response1);
                    $('#loginform').find(':submit').html('Log In');
                    $('#loginform').find(':submit').removeAttr("disabled");
                   

                if (data1.status == 'success') {
                    $('#loginform').find(':submit').html('Log In');
                    $('#loginform').find(':submit').removeAttr("disabled");
                    $('#otpLogin').removeClass('d-none');
                    $('#loginform').addClass('d-none');

                    setTimeout(function () {
                        window.location.replace(Admin_url + 'login/otp?email='+emailValue);
                    }, 100);
                    
                } else {
                    $('#loginform').find(':submit').html('Log In');
                    $('#loginform').find(':submit').removeAttr("disabled");
                    $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data1.message + '</div>');
                }
                
            }
        });


    }
});


});
