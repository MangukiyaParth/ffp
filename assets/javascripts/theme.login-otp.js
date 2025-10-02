$(function () {

$('.panel-body #otpLogin').validate({
    
    rules: {
        otp: {
            required: true,
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
        $('#otpLogin').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#otpLogin').find(':submit').attr("disabled", true);
        var data = new FormData();
        
        /*Form data*/
        var form_data = $('#otpLogin').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        const urlParams = new URLSearchParams(window.location.search);
        const email = urlParams.get('email');
        
        /* if(!email){
            return false;
        } */
        
        data.append('email', email);
        $.ajax({
            type: 'post',
            url: Admin_url + 'auth/calllogin',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data1 = jQuery.parseJSON(response);
                if (data1.status == 'success') {
                    $('#otpLogin').find(':submit').html('Log In');
                    $('#otpLogin').find(':submit').removeAttr("disabled");
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'dashboard');
                    }, 100);
                } else {
                    $('#otpLogin').find(':submit').html('Log In');
                    $('#otpLogin').find(':submit').removeAttr("disabled");
                    $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data1.message + '</div>');
                }
            }
        });
    }
});
});
