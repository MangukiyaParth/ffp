function notifictaion(title, message, type) {
    new PNotify({
        title: title,
        text: message,
        type: type,
        cornerclass: 'ui-pnotify-sharp'
    });
}

function clearimg() {
    var $el = $('#upfile');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    $('#apupl').html('<h4>Image</h4>');

}

$(function () {
    $("#upfile").change(function () {
        if (typeof (FileReader) != "undefined") {
            var apupl = $("#apupl");
            apupl.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img style='height:183px;width:566px;margin:-1px;border:1px solid #ddd;' src='" + e.target.result + "' /><a href='javascript:void(0)' id='btn-example-file-reset'  style='' onclick='clearimg();' class='stuimgown'  ><i class='fa fa-times'></i></a>");

                        apupl.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});

/*Change password*/
$('#changepass').validate({
    rules: {
        currentpass: {
            required: true,
            minlength: 6,
            maxlength: 15
        },
        newpass: {
            required: true,
            minlength: 6,
            maxlength: 15
        },
        conpass: {
            required: true,
            minlength: 6,
            maxlength: 15,
            equalTo: "#new"
        }
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
        $('#changepass').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#changepass').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#changepass').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });
        $.ajax({
            type: 'post',
            url: Admin_url + 'user/changepass',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#changepass').find(':submit').html('Save');
                    $('#changepass').find(':submit').removeAttr("disabled");
                    $('.msg').html('<div id="" class="massage alert alert-success" style="" >' + data.message + '</div>');

                    setTimeout(function () {
                        window.location.replace(Admin_url + 'users');
                    }, 1500);
                } else {
                    $('#changepass').find(':submit').html('Save');
                    $('#changepass').find(':submit').removeAttr("disabled");
                    $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data.message + '</div>');
                    /* setTimeout(function() { 
                        window.location.replace(Admin_url + 'users');
                     }, 1500);   */
                }
            }
        });
    }
});
/*End of change password*/

/*Admin Setting*/
$('#setting').validate({
    rules: {
        sitename: {
            required: true
        },
        support_call: {
            required: true
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
        $('#setting').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#setting').find(':submit').attr("disabled", true);

        var data = new FormData();

        /*Form data*/
        var form_data = $('#setting').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="site_logo"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("site_logo", file_data[i]);
        }
        /*sharing banner File data*/
        var file_data = $('input[name="sharingBanner"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("sharingBanner", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'setting/save_edit',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#setting').find(':submit').html('Save');
                    $('#setting').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'setting');
                    }, 1500);
                } else {
                    $('#setting').find(':submit').html('Save');
                    $('#setting').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'setting');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*admin Setting*/


/*add user insert*/
$('#useradd').validate({
    rules: {
        mobile1: {
            required: true,
            minlength: 10,
            maxlength: 12,
        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 15
        },
        cpassword: {
            required: true,
            minlength: 4,
            maxlength: 15,
            equalTo: "#password"
        }
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
        $('#useradd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#useradd').find(':submit').attr("disabled", true);

        var data = new FormData();

        /*Form data*/
        var form_data = $('#useradd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'users/insertuser',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {

                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#useradd').find(':submit').html('Save');
                    $('#useradd').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'users');
                    }, 1500);
                } else {
                    $('#useradd').find(':submit').html('Save');
                    $('#useradd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'users');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add user end*/

/*add font insert*/
$('#fontadd').validate({
    rules: {
        image: {
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
        $('#fontadd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#fontadd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#fontadd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });
        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'font/insertFont',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#fontadd').find(':submit').html('Save');
                    $('#fontadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'font');
                    }, 1500);
                } else {
                    $('#fontadd').find(':submit').html('Save');
                    $('#fontadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/*add font end*/


/* photo category */
$('#categoryadd').validate({
    rules: {
        pcat_photo: {
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
        $('#categoryadd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#categoryadd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#categoryadd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'photo/insertCategory',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#categoryadd').find(':submit').html('Save');
                    $('#categoryadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'photo/category');
                    }, 1500);
                } else {
                    $('#categoryadd').find(':submit').html('Save');
                    $('#categoryadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/* photo category */

$('#Slideradd').validate({
    rules: {
        cat_title: {
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
        $('#Slideradd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#Slideradd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#Slideradd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'slider/insertSlider',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#Slideradd').find(':submit').html('Save');
                    $('#Slideradd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'slider/');
                    }, 1500);
                } else {
                    $('#Slideradd').find(':submit').html('Save');
                    $('#Slideradd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$('#whatsappmedia').validate({
    rules: {
        image: {
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
        $('#whatsappmedia').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#whatsappmedia').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#whatsappmedia').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'whatsappmedia/insertMedia',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#whatsappmedia').find(':submit').html('Save');
                    $('#whatsappmedia').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'whatsappmedia/');
                    }, 1500);
                } else {
                    $('#whatsappmedia').find(':submit').html('Save');
                    $('#whatsappmedia').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$('#addReviewForm').validate({
    rules: {
        note: {
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
        $('#addReviewForm').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addReviewForm').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addReviewForm').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'teleUserSales/addReview',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addReviewForm').find(':submit').html('Send Request');
                    $('#addReviewForm').find(':submit').removeAttr("disabled");
                    $("input[type=file]").val("");
                    $("input[type=text]").val("");
                    $("textarea").val("");
                    notifictaion(data.status, data.message, 'success');
                    location.reload();
                    /* setTimeout(function () {
                        window.location.replace(Admin_url + 'slider/');
                    }, 1500); */
                } else {
                    $('#addReviewForm').find(':submit').html('Send Request');
                    $('#addReviewForm').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$('#addPaymentPackForSales').validate({
    rules: {
        pack_id: {
            required: true,
        },
        ampunt: {
            required: true,
        },
        buydatetime: {
            required: true,
        },
        note: {
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
        $('#addPaymentPackForSales').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addPaymentPackForSales').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addPaymentPackForSales').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="images"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("images", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'teleUserSales/addSubscriptionForSales',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addPaymentPackForSales').find(':submit').html('Send Request');
                    $('#addPaymentPackForSales').find(':submit').removeAttr("disabled");
                    $("input[type=file]").val("");
                    $("input[type=text]").val("");
                    $("input[type=number]").val("");
                    $(".pack_id").val("").change();
                    $("textarea").val("");
                    notifictaion(data.status, data.message, 'success');
                    location.reload();
                    /* setTimeout(function () {
                        window.location.replace(Admin_url + 'slider/');
                    }, 1500); */
                } else {
                    $('#addPaymentPackForSales').find(':submit').html('Send Request');
                    $('#addPaymentPackForSales').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$('#addChatHistoryCall').validate({
    rules: {
        call_status: {
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
        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();
        var callStatus = $('input[name="custom_status_list"]:checked').val();
        var allowedValues = [1,4,7,8,9,10,11,12];
        if (allowedValues.includes(parseInt(callStatus))) {
            if(start_time >= end_time){
                alert("please fil end time");
                return false;
            }
        }
        
        $('#addChatHistoryCall').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addChatHistoryCall').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addChatHistoryCall').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        /* var file_data = $('input[name="images"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("images", file_data[i]);
        } */
        $.ajax({
            type: 'post',
            url: Admin_url + 'teleUserSales/addChatHistoryMessage',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addChatHistoryCall').find(':submit').html('Save Call History');
                    $('#addChatHistoryCall').find(':submit').removeAttr("disabled");
                    $(".call_status").val("").change();
                    $("textarea").val("");
                    notifictaion(data.status, data.message, 'success');
                    location.reload();
                    
                } else {
                    $('#addChatHistoryCall').find(':submit').html('Save Call History');
                    $('#addChatHistoryCall').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$(document).ready(function () {
    $('.pack_id').on('change', function () {
        var amount = $(this).find(':selected').attr('data-id');
        $(".ampunt").val(parseInt(amount));
    });
});

$(document).ready(function () {
    $('.statusChanges').on('change', function () {
        var id = $(this).val();
        var custom_review_id = $(this).find(':selected').attr('data-id');
        $.ajax({
            type: 'post',
            url: Admin_url + 'telesales/changesStatusUpdate',
            data: {
                id: id,
                custom_review_id: custom_review_id,
            },
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $("#rem_"+custom_review_id).remove();
                    notifictaion(data.status, data.message, 'success');
                } else {
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    });
});

$(document).ready(function() {
    $('input[type="radio"][name="custom_status_list"]').change(function() {
        if($(this).is(':checked') && $(this).val() == '4') {
            $(".next_schedule_block").show("slow");
            $(".client_percentage_block").hide("slow");
        } else if($(this).is(':checked') && $(this).val() == '7') {
            $(".next_schedule_block").hide("slow");
            $(".client_percentage_block").show("slow");
        }else{
            $(".next_schedule_block").hide("slow");
            $(".client_percentage_block").hide("slow");
        }
    });
});

/* coupon code add start */
$('#CouponCodeADD').validate({
    rules: {
        c_name: {
            required: true,
        },
        c_code: {
            required: true,
        },
        start_date: {
            required: true,
        },
        end_date: {
            required: true,
        },
        total_qty: {
            required: true,
        },
        total_days: {
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
        $('#CouponCodeADD').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#CouponCodeADD').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#CouponCodeADD').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'couponcode/insertCouponCode',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#CouponCodeADD').find(':submit').html('Save');
                    $('#CouponCodeADD').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'couponcode/');
                    }, 1500);
                } else {
                    $('#CouponCodeADD').find(':submit').html('Save');
                    $('#CouponCodeADD').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/* coupon code add end */

/* user custom frame add */
$('#UserFrameCustomAdd').validate({
    rules: {
        frame_name: {
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
        $('#UserFrameCustomAdd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#UserFrameCustomAdd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#UserFrameCustomAdd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        var user_id = $(".user_id").val();
        $.ajax({
            type: 'post',
            url: Admin_url + 'users/insertUserCustomFerame',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#UserFrameCustomAdd').find(':submit').html('Save');
                    $('#UserFrameCustomAdd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'users/viewusers/' + user_id);
                    }, 1500);
                } else {
                    $('#UserFrameCustomAdd').find(':submit').html('Save');
                    $('#UserFrameCustomAdd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

/* frames insert */
$('#Framesadd').validate({
    rules: {
        frame_name: {
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
        $('#Framesadd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#Framesadd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#Framesadd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'frames/insertFrames',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#Framesadd').find(':submit').html('Save');
                    $('#Framesadd').find(':submit').removeAttr("disabled");
                    $("input[type=file]").val("");
                    notifictaion(data.status, data.message, 'success');
                    /*  setTimeout(function () {
                            window.location.replace(Admin_url + 'frames/');
                     }, 1500); */
                } else {
                    $('#Framesadd').find(':submit').html('Save');
                    $('#Framesadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/* frames insert end*/

/* sub frames insert */
$('#SubFramesadd').validate({
    rules: {
        fid: {
            required: true,
        },
        image: {
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
        $('#SubFramesadd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#SubFramesadd').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#SubFramesadd').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image[]"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image[]", file_data[i]);
        }

        $.ajax({
            type: 'post',
            url: Admin_url + 'frames/subInsertFrames',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#SubFramesadd').find(':submit').html('Save');
                    $('#SubFramesadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'frames/subframeindex/');
                    }, 1500);
                } else {
                    $('#SubFramesadd').find(':submit').html('Save');
                    $('#SubFramesadd').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/* sub frames insert end*/

/*add font insert*/
$('#addTamplate').validate({
    rules: {
        cat_id: {
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
        // $('#addTamplate').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        // $('#addTamplate').find(':submit').attr("disabled",true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addTamplate').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'tamplate/isertTamplate',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    //$('#addTamplate').find(':submit').html('Save');
                    // $('#addTamplate').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    /*  setTimeout(function() { 
                            window.location.replace(Admin_url + 'tamplate');
                      }, 1500);   */
                } else {
                    //$('#addTamplate').find(':submit').html('Save');
                    //$('#addTamplate').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/*add font end*/

/*edit user*/
$('#useredit').validate({
    rules: {
        mobile1: {
            required: true,
            minlength: 10,
            maxlength: 12,
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
        $('#useredit').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#useredit').find(':submit').attr("disabled", true);

        var data = new FormData();

        /*Form data*/
        var form_data = $('#useredit').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'users/updateuser',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#useredit').find(':submit').html('Save');
                    $('#useredit').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'users');
                    }, 1500);
                } else {
                    $('#useredit').find(':submit').html('Save');
                    $('#useredit').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'users');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*edit end*/


/*add contact insert*/
$('#addcontact').validate({
    rules: {
        name: {
            required: true,
        },
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
        }
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
        $('#addcontact').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addcontact').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addcontact').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'contact/contactadd',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addcontact').find(':submit').html('Save');
                    $('#addcontact').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'contact');
                    }, 1500);
                } else {
                    $('#addcontact').find(':submit').html('Save');
                    $('#addcontact').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add contact end*/

$('#roleAddForm').validate({
    rules: {
        name: {
            required: true,
        },
        code: {
            required: true,
        }
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
        $('#roleAddForm').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#roleAddForm').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#roleAddForm').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'role/roleUpsert',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#roleAddForm').find(':submit').html('Save');
                    $('#roleAddForm').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'role/');
                    }, 1500);
                } else {
                    $('#roleAddForm').find(':submit').html('Save');
                    $('#roleAddForm').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

$('#addAdminUserForm').validate({
    rules: {
        name: {
            required: true,
        },
        email: {
            required: true,
        },
        roleId: {
            required: true,
        },
        /* password: {
            required: true,
        } */
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
        $('#addAdminUserForm').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addAdminUserForm').find(':submit').attr("disabled", true);
        var data = new FormData();
        /*Form data*/
        var form_data = $('#addAdminUserForm').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'users/upsertAdminUser',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addAdminUserForm').find(':submit').html('Save');
                    $('#addAdminUserForm').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'users/adminList');
                    }, 1500);
                } else {
                    $('#addAdminUserForm').find(':submit').html('Save');
                    $('#addAdminUserForm').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});

function statusChangedd(id, tbl) {

    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'setting/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}

$(document).ready(function () {
    function chang_pass_data(id, type) {
        $('#userid').val(id);
        $('#type').val(type);
    }

    $(document).on('click', '.changepass_view', function () {
        $("#modal_form").modal('show');
        var id = $(this).attr("id");
        var type = $(this).attr("type");
        chang_pass_data(id, type);
    });
});


$(document).ready(function () {
    function updateData(id, replyVal, statusVal) {
        $('#compainId').val(id);
        $('#reply').val(replyVal);
        $('#status').val(statusVal);
    }
    $(document).on('click', '.replayModelShow', function () {
        $("#complainReplyModel").modal('show');
        var id = $(this).attr("id");
        var replyVal = $(this).attr("replyVal");
        var statusVal = $(this).attr("statusVal");
        updateData(id, replyVal, statusVal);

    });

});


$(document).ready(function () {

    $('#refundModalForm').validate({
        rules: {
            refund_id: {
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
        submitHandler: function (form, event) {
            event.preventDefault();
            $('#refundModalForm').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#refundModalForm').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#refundModalForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                type: 'post',
                url: Admin_url + 'Pyments/refundPayment',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    //$("#refundModal").modal('hide');
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#refundModalForm').find(':submit').html('Refund');
                        $('#refundModalForm').find(':submit').attr("disabled", false);
                        $("input[type=text]").val("");
                        $('.msg').html('<div id="" class="massage alert alert-success" style="" >' + data.message + '</div>');
                        /*notifictaion(data.status,data.message,'success');*/
                    } else {
                        $('#refundModalForm').find(':submit').html('Refund');
                        $('#refundModalForm').find(':submit').attr("disabled", false);
                        /*notifictaion(data.status,data.message,'error');*/
                        $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data.message + '</div>');
                    }
                }
            });
        }
    });

    $('#sendPaymentLinkByUser').validate({
        rules: {
            refund_id: {
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
        submitHandler: function (form, event) {
            event.preventDefault();
            $('#sendPaymentLinkByUser').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#sendPaymentLinkByUser').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#sendPaymentLinkByUser').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                type: 'post',
                url: Admin_url + 'Pyments/sendPaymentLinkByUser',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    /* $("#refundModal").modal('hide'); */
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#sendPaymentLinkByUser').find(':submit').html('Send Payment Link');
                        $('#sendPaymentLinkByUser').find(':submit').attr("disabled", true);
                        $(".amount").val(null);
                        $('select[name^="packageid"] option[value=""]').attr("selected","selected");
                        $('.msg').html('<div id="" class="massage alert alert-success" style="" >' + data.message + '</div>');
                        notifictaion(data.status,data.message,'success');
                    } else {
                        $('#sendPaymentLinkByUser').find(':submit').attr("disabled", false);
                        $('#sendPaymentLinkByUser').find(':submit').html('Send Payment Link');
                        notifictaion(data.status,data.message,'error');
                        $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data.message + '</div>');
                    }
                }
            });
        }
    });

    $(document).on('click', '.user_profile', function () {
        $("#userProfile").modal('show');
        $(".msg").html("");
        $('#sendPaymentLinkByUser').find(':submit').attr("disabled", false);
        var id = $(this).attr("id");
        $.ajax({
            type: 'post',
            url: Admin_url + 'users/getUserProfileData',
            data: { id: id },
            success: function (msg) {
                var data = $.parseJSON(msg);
                if (data.status == 'success') {
                    $('.first-part tbody').html('');
                    $('.second-part tbody').html('');
                    $('.third-part tbody').html('');
                    $('.payments tbody').html('');
                    $('.deviceinfo tbody').html('');
                    $('.logoset').html('');
                    var logo = '<img src="' + data.data.photo + '" width="100%">';
                    $('.logoset').html(logo);

                    $('.custom_frames').html("Custom Frames: " + data.data.totalCustomFrame);
                    $(".user_id").val(data.data.id);
                    var firstPart = '<tr><th>Mobile</th><td>' + data.data.mobile +
                        '</td></tr><tr><th>Email</th><td>' + data.data.email +
                        '</td></tr><tr><th>Business Name</th><td>' + data.data.business_name +
                        '</td></tr><tr><th>Business Note</th><td>' + data.data.name +
                        '</td></tr><tr><th>Business Email</th><td>' + data.data.b_email +
                        '</td></tr><tr><th>Expiry Date</th><td class="exp_date">' + data.data.expdate +
                        '</td></tr>';
                    var ispaid = (data.data.ispaid == 0) ? '<i class="fa fa-times-circle iconfsize icolred" data-toggle="tooltip" title="Free"></i>' : '<i class="fa fa-check-circle iconfsize icolgreen" data-toggle="tooltip" title="Paid"></i>';
                    var status = (data.data.status == 1) ? '<i class="pointer fa fa-toggle-on faicon" data-toggle="tooltip" title="Active"></i>' : '<i class="pointer fa fa-toggle-off faicona" data-toggle="tooltip" title="Deactive"></i>';

                    var secondPart = '<tr><th>Business Mobile</th><td>' + data.data.b_mobile2 +
                        '</td><th>Website</th><td>' + data.data.b_website +
                        '</td></tr><tr><th>Address</th><td colspan="3">' + data.data.address +
                        '</td></tr><tr><th>Is Paid</th><td>' + ispaid +
                        '</td><th>Login Status</th><td>' + status +
                        '</td></tr><tr><th>Last Login</th><td>' + data.data.last_login +
                        '</td><th>Note</th><td>' + data.data.note +
                        '</td></tr><tr><th>Created at</th><td>' + data.data.created_date +
                        '</td><th>Uodated at</th><td>' + data.data.updated_date +
                        '</td></tr>';
                    var thirdPart = '<tr><td><b>Sales</b></br>' + data.data.assignDataRow.user_id +
                        '</td><td><b>Lead Status</b></br>' + data.data.assignDataRow.lead_status_title +
                        '</td><td><b>Open Status</b></br>' + data.data.assignDataRow.open_status_time +
                        '</td><td><b>Assign By</b></br>' + data.data.assignDataRow.assign_by +
                        '</td><td><b>Created</b></br>' + data.data.assignDataRow.created_at +
                        '</td><td><b>Uodated</b></br>' + data.data.assignDataRow.updated_at +
                        '</td></tr>';
                    $.each(data.data.payments, function (key, val) {
                        // console.log(val);
                        var payments = '<tr><td><b>Plan </br></b>' + val.plan_name +
                            '</td><td><b>Date</br> </b>' + val.pdate +
                            '</td><td><b>Amount</br></b>' + val.pamount +
                            '</td><td><b>Sale Amount</br></b>' + val.pprice +
                            '</td></tr><tr><td><b>Tran ID</br></b>' + val.ptransactionid +
                            '</td><td><b>Created</br> </b>' + val.created_at +
                            '</td><td><b>Refund ID</br></b>' + val.refund_id +
                            '</td><td><b>Refund Date</br></b>' + val.refundDate +
                            '</td><td><b>User Role</br></b>' + val.userRole +
                            '</td></tr>';
                        $('.payments tbody').append(payments);
                    });
                    $('.packageid').html("");
                    $('.packageid').html('<option value="">-- Select Package--</option>');
                    $.each(data.data.packageList, function (key, val) {
                        var packageList = '<option value="'+val.plan_id+'" data-id="'+val.price+'">'+val.plan_name+'</option>';
                        $('.packageid').append(packageList);
                    });
                    $.each(data.data.deviceInfo, function (key, val) {
                        /* var mainurl = Admin_url + "users/editusers/" + val.n_id; */
                        var urlWithSlash = "/users/deleteDeviceID";
                        urlWithSlash = urlWithSlash.replace(/\/$|$/, '/');
                        urlWithSlash = "'" + urlWithSlash + "'";
                        var deleteFun = 'deleterecord(' + val.n_id + ',' + urlWithSlash + ')';
                        // console.log(val);
                        var deviceInfo = '<tr id="' + val.n_id + '"><td>' + val.device_id +
                            '</td><td>' + val.user_id +
                            '</td><td>' + val.app_version +
                            '</td><td>' + val.oprating_system +
                            '</td><td><a href="javascript:void(0)" onclick="' + deleteFun + '"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>' +
                            '</td></tr>';
                        $('.deviceinfo tbody').append(deviceInfo);
                    });

                    $('.first-part tbody').append(firstPart);
                    $('.second-part tbody').append(secondPart);
                    $('.third-part tbody').append(thirdPart);
                    /* notifictaion(data.status, data.message, 'success'); */
                    /* setTimeout(function() {
                        window.location.replace(url);
                    }, 1500); */
                }
            }
        });
        //$('#userid').val(id);
    });

    /*User Change password*/
    $('#userchangepass1').validate({
        rules: {
            newpassword: {
                required: true,
                minlength: 4,
                maxlength: 15
            },
            confirmpassword: {
                required: true,
                minlength: 4,
                maxlength: 15,
                equalTo: "#newpassword"
            }
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
            $('#userchangepass1').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#userchangepass1').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#userchangepass1').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            var type = $("#type").val();
            $.ajax({
                type: 'post',
                url: Admin_url + 'users/changepass',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#userchangepass1').find(':submit').html('Submit');
                        $('#userchangepass1').find(':submit').removeAttr("disabled");
                        $("input[type=text], input[type=password]").val("");
                        $('.msg').html('<div id="" class="massage alert alert-success" style="" >' + data.message + '</div>');
                        /*notifictaion(data.status,data.message,'success');*/
                        setTimeout(function () {
                            if(type === 'admin') {
                                window.location.replace(Admin_url + 'users/adminList');
                            } else {
                                window.location.replace(Admin_url + 'users');
                            }
                        }, 1500);
                    } else {
                        $('#userchangepass1').find(':submit').html('Submit');
                        $('#userchangepass1').find(':submit').removeAttr("disabled");
                        /*notifictaion(data.status,data.message,'error');*/
                        $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data.message + '</div>');
                        /*setTimeout(function() { */
                        /*    window.location.replace(Admin_url + 'users');*/
                        /* }, 1500);  */
                    }
                }
            });
        }
    });
    /*End of change password*/

    $('#replyForm').validate({
        rules: {
            reply: {
                required: true,
            },
            status: {
                required: true,
            }
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
            $('#replyForm').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#replyForm').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#replyForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                type: 'post',
                url: Admin_url + 'complain/saveReply',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#replyForm').find(':submit').html('Submit');
                        $('#replyForm').find(':submit').removeAttr("disabled");
                        $("input[type=text], input[type=password]").val("");
                        $('.msg').html('<div id="" class="massage alert alert-success" style="" >' + data.message + '</div>');
                        /*notifictaion(data.status,data.message,'success');*/
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'complain');
                        }, 1500);
                    } else {
                        $('#replyForm').find(':submit').html('Submit');
                        $('#replyForm').find(':submit').removeAttr("disabled");
                        /*notifictaion(data.status,data.message,'error');*/
                        $('.msg').html('<div id="" class="massage alert alert-danger" style="" >' + data.message + '</div>');
                        /*setTimeout(function() { */
                        /*    window.location.replace(Admin_url + 'users');*/
                        /* }, 1500);  */
                    }
                }
            });
        }
    });

    $('#updatePlan').validate({
        rules: {
            month: {
                required: true,
            },
            plan_name: {
                required: true,
            },
            price: {
                required: true,
            },
            discount_price: {
                required: true,
            },
            special_title: {
                required: true,
            },
            status: {
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
            $('#updatePlan').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#updatePlan').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#updatePlan').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                type: 'post',
                url: Admin_url + 'subscription/updatePlan',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#updatePlan').find(':submit').html('Save');
                        $('#updatePlan').find(':submit').removeAttr("disabled");
                        $("input[type=text]").val("");
                        notifictaion(data.status, data.message, 'success');
                        $('#mySubUpdateModel').modal({ show: false });
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'subscription');
                        }, 1500);
                    } else {
                        $('#updatePlan').find(':submit').html('Save');
                        $('#updatePlan').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                    }
                }
            });
        }
    });

    /* ---------------------------------------- */
});

function checkall() {
    var value = $('#checkboxExample2').prop('checked');
    if (value == true) {
        $(".case").prop('checked', true);
    } else {
        $(".case").prop('checked', false);
    }
}

$('.delete_all_con').on('click', function (e) {
    var allVals = [];
    $(".case:checked").each(function () {
        allVals.push($(this).attr('data-id'));
    });
    if (allVals.length <= 0) {
        swal("Delete", 'Please Select row', {
            icon: "error",
        });
    } else {
        swal({
            title: "Are you sure Want to Delete.?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: Admin_url + 'contact/delete_contact',
                    type: 'POST',
                    data: 'ids=' + allVals,
                    success: function (data) {
                        var data = jQuery.parseJSON(data);
                        if (data.status == 'success') {
                            swal("Deleted!", data.message, {
                                icon: "success",
                            });
                            $.each(allVals, function (index, value) {
                                setTimeout(function () {
                                    window.location.replace(Admin_url + 'contact/contactus');
                                }, 1500);
                            });
                        } else {
                            swal("Delete Aborted", data.message, {
                                icon: "error",
                            });
                        }
                    }
                });
            } else {
                swal("Relax Delete Aborted", {
                    icon: "error",
                });
            }
        });
    }
});

/*add category insert*/
$('#addcategory').validate({
    rules: {
        name: {
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
        $('#addcategory').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addcategory').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#addcategory').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        var file_data = $('input[name="noti_banner"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("noti_banner", file_data[i]);
        }

        $.ajax({
            type: 'post',
            url: Admin_url + 'category/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addcategory').find(':submit').html('Save');
                    $('#addcategory').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'category');
                    }, 1500);
                } else {
                    $('#addcategory').find(':submit').html('Save');
                    $('#addcategory').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add category end*/

/*Category status change start  */
function statusChanged(id, tbl) {

    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'category/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}
/*Category status changed end */

/*add advertise insert*/
$('#addAdvertise').validate({
    rules: {
        category: {
            required: true,
        },
        title: {
            required: true,
        },
        /* advertise: {
            required: true,
        }, */
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
        $('#addAdvertise').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addAdvertise').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#addAdvertise').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'MyUnit/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addAdvertise').find(':submit').html('Save');
                    $('#addAdvertise').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'MyUnit');
                    }, 1500);
                } else {
                    $('#addAdvertise').find(':submit').html('Save');
                    $('#addAdvertise').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add advertise end*/

/*add advertise insert*/
$('#addsubscription').validate({
    rules: {
        plan_id: {
            required: true,
        },
        title: {
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
        $('#addsubscription').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addsubscription').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#addsubscription').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'subscription/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addsubscription').find(':submit').html('Save');
                    $('#addsubscription').find(':submit').removeAttr("disabled");
                    $("input[type=text]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'subscription');
                    }, 1500);
                } else {
                    $('#addsubscription').find(':submit').html('Save');
                    $('#addsubscription').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add advertise end*/

$('.openBtn').on('click', function () {
    var id = $(this).data('id');
    $('#mySubUpdateModel').modal({ show: true });
    $('.pl_id').val(id);
    $.ajax({
        type: 'post',
        url: Admin_url + 'subscription/getPlanData',
        data: { id: id },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                /* console.log(data.data['plan_id']);
                console.log(data.data.plan_name); */
                $('.month').val(data.data.month);
                $('.plan_name').val(data.data.plan_name);
                $('.price').val(data.data.price);
                $('.discount_price').val(data.data.discount_price);
                $('.special_title').val(data.data.special_title);
                $('.status').val(data.data.status);
            }
        }
    });
});


/*advertise status change start  */
function StatusChanged(id, tbl) {

    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'MyUnit/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}
/*advertise status changed end */

/*add application insert*/
$('#addApplication').validate({
    rules: {
        app_name: {
            required: true,
        },
        app_package_name: {
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
        $('#addApplication').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addApplication').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#addApplication').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }

        $.ajax({
            type: 'post',
            url: Admin_url + 'application/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addApplication').find(':submit').html('Save');
                    $('#addApplication').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'application');
                    }, 1500);
                } else {
                    $('#addApplication').find(':submit').html('Save');
                    $('#addApplication').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add application end*/

/*add skill insert*/
$('#addskill').validate({
    rules: {
        name: {
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
        $('#addskill').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addskill').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#addskill').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'skill/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addskill').find(':submit').html('Save');
                    $('#addskill').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'skill');
                    }, 1500);
                } else {
                    $('#addskill').find(':submit').html('Save');
                    $('#addskill').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'contact');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add skill end*/

/*Skill status change start  */
function SkillstatusChanged(id, tbl) {

    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'skill/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}
/*Skill status changed end */


/*add notification insert*/
$('#addNotification').validate({
    rules: {
        app_id: {
            required: true,
        },
        app_name: {
            required: true,
        },
        app_package_name: {
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
        $('#addNotification').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#addNotification').find(':submit').attr("disabled", true);

        var data = new FormData();

        /*Form data*/
        var form_data = $('#addNotification').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        /*File data*/
        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
        $.ajax({
            type: 'post',
            url: Admin_url + 'notification/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#addNotification').find(':submit').html('Save');
                    $('#addNotification').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date],input[type=file]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'notification');
                    }, 1500);
                } else {
                    $('#addNotification').find(':submit').html('Save');
                    $('#addNotification').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                    /*setTimeout(function() { */
                    /*    window.location.replace(Admin_url + 'users');*/
                    /* }, 1500);  */
                }
            }
        });
    }
});
/*add notification end*/

/*notification status change start  */
function NotificationstatusChanged(id, tbl) {

    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'notification/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}
/*notification status changed end */

/*add developer insert*/
$('#adddeveloper').validate({
    rules: {
        name: {
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
        $('#adddeveloper').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
        $('#adddeveloper').find(':submit').attr("disabled", true);

        var data = new FormData();
        /*Form data*/
        var form_data = $('#adddeveloper').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            type: 'post',
            url: Admin_url + 'developer/add',
            data: data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                /* alert(response);*/
                var data = jQuery.parseJSON(response);
                if (data.status == 'success') {
                    $('#adddeveloper').find(':submit').html('Save');
                    $('#adddeveloper').find(':submit').removeAttr("disabled");
                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'developer');
                    }, 1500);
                } else {
                    $('#adddeveloper').find(':submit').html('Save');
                    $('#adddeveloper').find(':submit').removeAttr("disabled");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    }
});
/*add developer  end*/

/*Developer status change start  */
function DeveloperstatusChanged(id, tbl) {
    var url = window.location.href;
    var seg = id.split('/');
    if (seg[3] == 1) {
        status = '1';
    } else {
        status = '0';
    }
    $.ajax({
        type: 'post',
        url: Admin_url + 'developer/statuschk',
        data: { id: id, status: status },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }
        }
    });
}
/*Developer status changed end */

/*Developer skill add*/
$(document).ready(function () {

    $('#skill').multiselect({
        nonSelectedText: 'Select Skill',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px'
    });

    $('#adddeveloper').on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: Admin_url + 'developer/add',
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#skill option:selected').each(function () {
                    $(this).prop('selected', false);
                });
                $('#skill').multiselect('refresh');
                //alert(data);
            }
        });
    });

    /* multi select tamplet delete and edit */
    $('#master').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });

    $('.delete_all').on('click', function (e) {
        var allVals = [];
        var images = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
            images.push($(this).attr('data-idd'));
        });
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            var check = confirm("Are you sure you want to delete this row?");
            if (check == true) {
                var join_selected_values = allVals.join(",");
                var join_selected_image = images;
                $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    data: {
                        'ids': join_selected_values,
                        'image': join_selected_image,
                    },
                    success: function (data) {
                        $(".sub_chk:checked").each(function () {
                            $(this).parents("tr").remove();
                        });
                        alert("Item Deleted successfully.");
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                $.each(allVals, function (index, value) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
            }
        }
    });

    $('.edit_all').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            //var join_selected_values = allVals.join(",");
            $('#myModal').modal('show');
            $(".edit_id").val(allVals);
            $.ajax({
                url: Admin_url + 'tamplate/getCatPosForModel',
                type: 'POST',
                /*  data: {
                        'ids':join_selected_values,
                    }, */
                success: function (data) {
                    var res = $.parseJSON(data);
                    if (res.status == 'success') {
                        var res_data = res.data;
                        var cat_html = '<option value="">--Select Category--</option>';
                        $(".category_name").append(cat_html);
                        $.each(res_data.cats, function (key, input) {
                            cat_html = '<option value="' + input.mid + '">' + input.mtitle + '</option>';
                            $(".category_name").append(cat_html);
                        });

                        var font_html = '';
                        font_html = '<option value="">Select Font</option>';
                        $(".font_name").append(font_html);
                        $.each(res_data.fonts, function (key, input) {
                            font_html = '<option value="' + input.font_name + '">' + input.font_name + '</option>';
                            $(".font_name").append(font_html);
                        });

                        var lang_html = '';
                        lang_html = '<option value="">Select Language</option>';
                        $(".lang_name").append(lang_html);
                        $.each(res_data.language, function (key, input) {
                            lang_html = '<option value="' + input.language + '">' + input.language + '</option>';
                            $(".lang_name").append(lang_html);
                        });

                        var position_html = '';
                        position_html = '<option value="">Select Position</option>';
                        $(".position_name").append(position_html);
                        $.each(res_data.position, function (key, input) {
                            position_html = '<option value="' + input.pid + '">' + input.p_name + '</option>';
                            $(".position_name").append(position_html);
                        });
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        }
    });

    /* category import */
    var spinner = $('#loader');
    
    $('#import_form').on('submit', function (event) {
        event.preventDefault();
        spinner.show();
        $.ajax({
            url: Admin_url + "category/import",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var data = jQuery.parseJSON(response);
                $('#file').val('');
                if (data.status == 'success') {
                    spinner.hide();
                    notifictaion(data.status, data.message, 'success');
                    setTimeout(function () {
                        window.location.replace(Admin_url + 'category');
                    }, 1500);
                } else {
                    spinner.hide();
                    notifictaion(data.status, data.message, 'error');
                }
            }
        })
    });

    $(".category").select2({
        theme: "bootstrap",
    });
    $(".position").select2({
        theme: "bootstrap"
    });

    function custom_template(obj) {
        var data = $(obj.element).data();
        var text = $(obj.element).text();
        if (data && data['img_src']) {
            img_src = data['img_src'];
            template = $("<div class='text-center'><img src=\"" + img_src + "\" style=\"width:100px;height:100px;\"/><p style=\"font-weight: 600;font-size:14px;text-align:center;\">" + text + "</p></div>");
            return template;
        }
    }

    var options = {
        'templateSelection': custom_template,
        'templateResult': custom_template,
    }

    $('#category_name').on('change', function () {
        var c_type_id = this.value;
        $.ajax({
            url: Admin_url + "tamplate/subCategory",
            type: "POST",
            data: {
                c_type_id: c_type_id
            },
            cache: false,
            success: function (result) {
                var data = jQuery.parseJSON(result);
                if (data.status == 'success') {
                    $("#p_id").html(data.data);
                } else {
                    $("#p_id").html(data.data);
                }
                $('#p_id').select2(options);
                $('.select2-container--default .select2-selection--single').css({ 'height': '130px' });
            }
        });
    });

    /* notification add */
    $('#app_notification').validate({
        rules: {
            title: {
                required: true,
            },
            message: {
                required: true,
            },
            url: {
                required: true,
            }
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
            var data = new FormData();
            /*Form data*/
            var form_data = $('#app_notification').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            /* File data*/
            var file_data = $('input[name="image"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image", file_data[i]);
            }
            $.ajax({
                type: 'post',
                url: Admin_url + 'notificationsend/',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#loading').hide();
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $("input[type=text], textarea").val("");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'notificationsend');
                        }, 1500);
                    } else {
                        $('#app_notification').find(':submit').html('Save');
                        $('#app_notification').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                        /*setTimeout(function() { 
                            window.location.replace(Admin_url + 'setting/slider');
                         }, 1500);  */
                    }
                }
            });
        }
    });

    /* user menual payment add */
    $('#userMenualPyAdd').validate({
        rules: {
            mobile: {
                required: true,
            },
            transationid: {
                required: true,
            },
            select_plan: {
                required: true,
            },
            buyDate: {
                required: true,
            }
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
            var data = new FormData();
            /*Form data*/
            var form_data = $('#userMenualPyAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            $.ajax({
                type: 'post',
                url: Admin_url + 'pyments/userSubPaymentHistory',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                /* beforeSend: function() {
                    $('#loading').show();
                }, */
                success: function (response) {
                    /* $('#loading').hide(); */
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $("input[type=text], textarea").val("");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'pyments');
                        }, 1000);
                    } else {
                        $('#userMenualPyAdd').find(':submit').html('Save');
                        $('#userMenualPyAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                    }
                }
            });
        }
    });

    /* fetch user data user mobile number fetch button*/
    $('.getMobileData').click(function () {
        var mobile = $(".mobile").val();
        $("#transationid").val("");
        $.ajax({
            type: 'post',
            url: Admin_url + 'pyments/getUsrData',
            data: { "mobile": mobile },
            success: function (response) {
                var data = jQuery.parseJSON(response);
                console.log(data.data);
                if (data.status == 'success') {
                    $(':submit').prop('disabled', false);
                    notifictaion(data.status, data.message, 'success');
                    if (data.data.pmonth <= 0) {
                        $("#userid").val(data.data.id);
                    } else {
                        /*  $(':submit').prop('disabled', true); */
                        $("#userid").val(data.data.id);
                    }
                    //var isPade = (data.data.ispaid == 0) ? '<i class="fa fa-times-circle iconfsize icolred" data-toggle="tooltip" title="Free"></i>' : '<i class="fa fa-check-circle iconfsize icolgreen" data-toggle="tooltip" title="Paid"></i>';
                    var isPade = data.data.pstatus;
                    var rowData = '<td>' + data.data.id + '</td><td>' + data.data.mobile + '</td><td>' + data.data.business_name + '</td><td>' + data.data.b_email + '</td><td>' + isPade + '</td><td>' + data.data.expdate + '</td><td>' + data.data.status + '</td><td>' + data.data.last_login + '</td>';
                    $('.insertRow').html(rowData);
                } else {
                    $(':submit').prop('disabled', true);
                    $("#userid").val("");
                    notifictaion(data.status, data.message, 'error');
                }
            }
        });
    });

    $('#addTamplateAdd').validate({
        rules: {
            type: {
                required: true,
            },

            image: {
                required: true,
            },
            category_name: {
                required: true,
            },
            /* p_id: {
                required: true,
            }, */
            font_type: {
                required: true,
            },
            font_size: {
                required: true,
            },
            /* font_color: {
                required: true,
            } */
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
            $('#addTamplateAdd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#addTamplateAdd').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#addTamplateAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            /* File data*/
            var file_data = $('input[name="image[]"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image[]", file_data[i]);
            }
            var file_data = $('input[name="mask[]"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("mask[]", file_data[i]);
            }
            $.ajax({
                type: 'post',
                url: Admin_url + 'tamplate/isertTamplate/',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {

                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#addTamplateAdd').find(':submit').html('Save');
                        $('#addTamplateAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'success');
                    } else {
                        $('#addTamplateAdd').find(':submit').html('Save');
                        $('#addTamplateAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                        /*setTimeout(function() { 
                            window.location.replace(Admin_url + 'setting/slider');
                         }, 1500);  */
                    }
                    $(".totalImg").html("Total Images: " + data.totalImg);
                    $(".countImgNotFound").html("Image Not Found: " + data.countImgNotFound);
                    $(".countRenameImg").html("Total Rename Image: " + data.countRenameImg);
                }
            });
        }
    });

    $('#addVideogifAdd').validate({
        rules: {
            image: {
                required: true,
            },
            category_name: {
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
            $('#addVideogifAdd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#addVideogifAdd').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#addVideogifAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            /* File data*/
            var file_data = $('input[name="image[]"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image[]", file_data[i]);
            }
            $.ajax({
                type: 'post',
                url: Admin_url + 'videogif/isertVideogif/',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#loading').hide();
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#addVideogifAdd').find(':submit').html('Save');
                        $('#addVideogifAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'videogif/addvideogif');
                        }, 1500);
                    } else {
                        $('#addVideogifAdd').find(':submit').html('Save');
                        $('#addVideogifAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                    }
                }
            });
        }
    });

    $('#memListTable').DataTable({
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        /*  "order": [[1, "asc" ]], */
        "ajax": {
            "url": Admin_url + 'tamplate/getLists',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    $('#videogifListTable').DataTable({
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        /*  "order": [[1, "asc" ]], */
        "ajax": {
            "url": Admin_url + 'videogif/getLists',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    $('#userPostServerList').DataTable({
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        /*  "order": [[1, "asc" ]], */
        "ajax": {
            "url": Admin_url + 'Userpost/getUserPostList',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    $('#userTransactionListServerSide').DataTable({
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        /*  "order": [[1, "asc" ]], */
        "ajax": {
            "url": Admin_url + 'users/getUserTransaction',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": true,
        }]
    });

    $('#photoListServer').DataTable({
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        /*  "order": [[1, "asc" ]], */
        "ajax": {
            "url": Admin_url + 'photo/getPhotoListServer',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    /* simple photo upload */
    $('#addphotoAdd').validate({
        rules: {
            image: {
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
            $('#addphotoAdd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#addphotoAdd').find(':submit').attr("disabled", true);

            var data = new FormData();
            /*Form data*/
            var form_data = $('#addphotoAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            /* File data*/
            var file_data = $('input[name="image[]"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image[]", file_data[i]);
            }
            $.ajax({
                type: 'post',
                url: Admin_url + 'photo/isertPhoto/',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#addphotoAdd').find(':submit').html('Save');
                        $('#addphotoAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'photo/addphoto');
                        }, 1500);
                    } else {
                        $('#addphotoAdd').find(':submit').html('Save');
                        $('#addphotoAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                        /* setTimeout(function() {
                            window.location.replace(Admin_url + 'photo');
                        }, 1500); */
                    }
                }
            });
        }
    });

    $('#faqadd').validate({
        rules: {
            quetion: {
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
            $('#faqadd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#faqadd').find(':submit').attr("disabled", true);
            var data = new FormData();
            /*Form data*/
            var form_data = $('#faqadd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
    
            /*File data*/
            /* var file_data = $('input[name="image"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image", file_data[i]);
            } */
            $.ajax({
                type: 'post',
                url: Admin_url + 'faq/insertfaq',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
    
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#faqadd').find(':submit').html('Save');
                        $('#faqadd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'faq/');
                        }, 1500);
                    } else {
                        $('#faqadd').find(':submit').html('Save');
                        $('#faqadd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
    
                    }
                }
            });
        }
    });
    
    $('#WhatsTempAdd').validate({
        rules: {
            template: {
                required: true,
            },
            lang: {
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
            $('#WhatsTempAdd').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#WhatsTempAdd').find(':submit').attr("disabled", true);
            var data = new FormData();
            /*Form data*/
            var form_data = $('#WhatsTempAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
    
            $.ajax({
                type: 'post',
                url: Admin_url + 'whatsapptemp/insertTemp',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
    
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if (data.status == 'success') {
                        $('#WhatsTempAdd').find(':submit').html('Save');
                        $('#WhatsTempAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'success');
                        setTimeout(function () {
                            window.location.replace(Admin_url + 'whatsapptemp/');
                        }, 1500);
                    } else {
                        $('#WhatsTempAdd').find(':submit').html('Save');
                        $('#WhatsTempAdd').find(':submit').removeAttr("disabled");
                        notifictaion(data.status, data.message, 'error');
                    }
                }
            });
        }
    });
    
    $('#WhatsbulkSend').validate({
        rules: {
            cam_title: {
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
            showLoadingSpinner();
            $('#WhatsbulkSend').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');
            $('#WhatsbulkSend').find(':submit').attr("disabled", true);
            var data = new FormData();
            /*Form data*/
            var form_data = $('#WhatsbulkSend').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            
            /*File data*/
            var file_data = $('input[name="image"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("image", file_data[i]);
            }

            swal({
                title: "Are you sure Want to Send?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: Admin_url + 'whatsappbulk/sendBulkCamping',
                        data: data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        /* beforeSend:function()
                        {
                            $('#process').css('display', 'block');
                        }, */
                        success: function (response) {
                            var data = jQuery.parseJSON(response);
                            hideLoadingSpinner();
                            if (data.status == 'success') {
                                /* var percentage = 0;
                                var timer = setInterval(function(){
                                    percentage = percentage + 20;
                                    progress_bar_process(percentage, timer);
                                }, 1000); */

                                $('#WhatsbulkSend').find(':submit').html('Send');
                                $('#WhatsbulkSend').find(':submit').removeAttr("disabled");
                                notifictaion(data.status, data.message, 'success');
                                setTimeout(function () {
                                    window.location.replace(Admin_url + 'whatsappbulk/');
                                }, 1500);
                            } else {
                                $('#WhatsbulkSend').find(':submit').html('Send');
                                $('#WhatsbulkSend').find(':submit').removeAttr("disabled");
                                notifictaion(data.status, data.message, 'error');
                            }
                        }
                    });
                } else {
                    $('#WhatsbulkSend').find(':submit').html('Send');
                    $('#WhatsbulkSend').find(':submit').removeAttr("disabled");
                    swal("Relax Send Aborted", { icon: "error",});
                }
            });
        }
    });

    function progress_bar_process(percentage, timer)
    {
        $('.progress-bar').css('width', percentage + '%');
        if(percentage > 100)
        {
            clearInterval(timer);
            //$('#sample_form')[0].reset();
            $('#process').css('display', 'none');
            $('.progress-bar').css('width', '0%');
            //$('#save').attr('disabled', false);
            //$('#success_message').html("<div class='alert alert-success'>Data Saved</div>");
            setTimeout(function(){
            //$('#success_message').html('');
            }, 5000);
        }
    }

    function showLoadingSpinner() {
        $("#loading-spinner").show();
    }
    function hideLoadingSpinner() {
        $("#loading-spinner").hide();
    }  

    $('#cat_id').on('change', function () {
        var c_type_id = this.value;
        var result = c_type_id.split('_');
        if (result[1] != "0000-00-00") {
            $('.t_event_date').val(result[1]);
        }
    });
});

$(document).ready(function () {
    var table;
    table = $('#userListServerSide').DataTable({
        "pageLength": 100,
        "processing": true,
        "serverSide": true,
        
        "order": [
            [0, "desc"]
        ],
        "ajax": {
            "url": Admin_url + 'users/getUserListServer',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
                data.type = $('#type').val();
                data.version = $('#version').val();
            }
        },
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50,100,500,1000, -1], [10, 25, 50,100,500,1000, "All"]],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                format: {
                    body: function (data, row, column, node) {
                    // Strip HTML tags and return the plain text
                    return $(node).text();
                    }
                }
                }
            },
            'print'
            ],
        /* buttons: [
        'csv', 'excel', 'pdf', 'print'
        ], */
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });

    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    var table;
    table = $('#razorpayPaymentFailedTable').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": false,
        /* "pagingType": "full_numbers", */
        /* "paging": true, */
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "ajax": {
            "url": Admin_url + 'razorpayPayment/getFailedList',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 5]
                }
            },
        ],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

});

$(document).ready(function () {
    var table;
    table = $('#razorpayPaymentSuccessTable').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "ajax": {
            "url": Admin_url + 'razorpayPayment/getSuccessList',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    var table;
    table = $('#dayWiseSubscriptionList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "ajax": {
            "url": Admin_url + 'report/subscription/getDayWiseReport',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },

        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

});

$(document).ready(function () {
    var table;
    table = $('#repeatSubscriptionList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "columns": [
            { "data": "name" },
            { "data": "mobile" },
            { "data": "pstatus" },
            { "data": "total" },
            { "data": "firstDate" },
            { "data": "lastDate" },
        ],
        "ajax": {
            "url": Admin_url + 'report/subscription/getRepeatSubscription',
            "type": "POST",
            "data": function (data) {
                data.pstatus = $('#pstatus').val();
            }
        },

        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    var table;
    table = $('#dayWiseUserRegList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "columns": [
            { "data": "srNo" },
            { "data": "date" },
            { "data": "count" },
        ],
        "ajax": {
            "url": Admin_url + 'report/users/getDayWiseRegReport',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    var table;
    table = $('#complainList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [6, "desc"]
        ],
        "columns": [
            { "data": "com_id" },
            { "data": "name" },
            { "data": "complain_id" },
            { "data": "message" },
            { "data": "reply" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "action" },
        ],
        "ajax": {
            "url": Admin_url + 'complain/getComplainList',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    var table;
    table = $('#adminUserList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "columns": [
            { "data": "id" },
            { "data": "userid" },
            { "data": "name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "role" },
            { "data": "regsiter_date" },
            { "data": "status_btn" },
            { "data": "otp" },
            { "data": "note" },
            { "data": "action" },
        ],
        "ajax": {
            "url": Admin_url + 'users/getAdminUserList',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });
    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});

$(document).ready(function () {
    $(document).on('click', '.switch-success', function () {
        setTimeout(function () {
            if ($(".switch-success .ios-switch").hasClass("on")) {
                $('#status').val(1);
            } else {
                $('#status').val(0);
            }
        }, 1000);
    });

    $(document).on('click', '.roleEditBtn', function () {
        var id = $(this).attr("dataId");
        var title = $(this).attr("dataName");
        var code = $(this).attr("dataCode");
        var dataIsActive = $(this).attr("dataIsActive");
        $('#hId').val(id);
        $('#tName').val(title);
        $('#status').val(dataIsActive);
        $('#tCode').val(code).attr('readonly', true);
        console.log('dataIsActive', dataIsActive);
        if (dataIsActive == '0') {
            $('.switch-success .ios-switch').removeClass('on');
            $('.switch-success .ios-switch').addClass('off');
        } else {
            $('.switch-success .ios-switch').removeClass('off');
            $('.switch-success .ios-switch').addClass('on');
        }
    });

    var table;
    table = $('#adminRoleList').DataTable({
        "pageLength": 50,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        "order": [
            [0, "desc"]
        ],
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "code" },
            { "data": "status" },
            { "data": "action" },
        ],
        "ajax": {
            "url": Admin_url + 'role/getRoleList',
            "type": "POST",
            "data": function (data) {
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }]
    });

    $('#btn-filter').click(function () { //button filter event click
        table.ajax.reload(); //just reload table
    });

    $('#btn-reset').click(function () { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
});
/*Developer skill end*/

$(document).ready(function () {
    $('#application').on('change', function () {
        var value = $(this).val().toLowerCase();
        var table = $(".datatable-tabletools").DataTable();
        $(".datatable-tabletools tbody tr").filter(function () {
            table.on('order.dt search.dt', function () {
                table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).search(value).draw();
        });
    });
});

$('#radioBtn a').on('click', function () {
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#' + tog).prop('value', sel);
    $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
});

/* notification time category data fil karavo */
$(document).ready(function () {

    $('#category_data').on('change', function () {
        var cat_id = this.value;
        $.ajax({
            url: Admin_url + "notificationsend/getCategoryDataById",
            type: "POST",
            data: {
                id: cat_id
            },
            cache: false,
            success: function (result) {
                var data = jQuery.parseJSON(result);
                if (data.status == 'success') {
                    $("#title").val(data.data.mtitle);
                    var mes = (data.data.noti_quote != "") ? data.data.noti_quote + " - Make your own business post" : data.data.mtitle + " - Make your own business post";
                    $("#message").val(mes);
                    $("#url").val("cat_" + data.data.mid);
                } else {
                    $("#title").val();
                }
            }
        });
    });

    /* notification topic select kre to all null thy  */
    $('input[type=radio][name=topictoken]').change(function () {
        if (this.value == '0') {
            $("input[name=imgsend][value='0']").prop('checked', true);
            $('#userFilter option[value=""]').attr("selected", "selected");
        }
    });
});

/* frame status on off */
function statusFrameOnOFF(id, status, filedName) {
    $.ajax({
        type: 'post',
        url: Admin_url + 'frames/statusChange',
        data: { id: id, status: status, filedName: filedName },
        success: function (msg) {
            /*alert(msg);*/
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                notifictaion(data.status, data.message, 'success');
                /* setTimeout(function() {
                    window.location.replace(url);
                }, 500); */
            }
        }
    });
}

function sliderStatusUpdate(id) {
    var status = $("#sh_" + id).val();
    status = status == 0 ? 1 : 0;
    $.ajax({
        type: 'post',
        url: Admin_url + 'slider/sliderUpdateStatus',
        data: { id: id, status: status },
        success: function (msg) {

            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                $("#sh_" + id).val(status);
                notifictaion(data.status, data.message, 'success');
            }
        }
    });
}

function homeCategoryStatusUpdate(id, key) {
    var status = $("#" + key + "_" + id).val();
    status = status == 0 ? 1 : 0;
    $.ajax({
        type: 'post',
        url: Admin_url + 'homeCategory/keyUpdate',
        data: { id: id, key, val: status },
        success: function (msg) {

            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                $("#" + key + "_" + id).val(status);
                notifictaion(data.status, data.message, 'success');
            }
        }
    });
}

function statusUpdate(idKey) {
    var statusVal = $("#" + idKey).val();
    statusVal = statusVal == 0 ? 1 : 0;
    $("#" + idKey).val(statusVal);
}

function copy(that){
    var inp = document.createElement('input');
    document.body.appendChild(inp)
    inp.value = that.textContent
    inp.select();
    document.execCommand('copy',false);
    inp.remove();
    notifictaion("success", "Copy done!", 'success');
}

function copyToClipboard(text) {
    var tempInput = $("<input>");
    $("body").append(tempInput);
    tempInput.val(text).select();
    document.execCommand("copy");
    tempInput.remove();
    notifictaion("success", "Copy done!", 'success');
}

$(".packageid").change(function() {
    var amount = $(this).find(':selected').attr('data-id');
    if(amount > 0){
        $(".amount").val(amount);
    }else{
        $(".amount").val(0);
    }
});

$(".temp_list").change(function() {
    var temp = $(this).find(':selected').attr('data-id');
    var imageUrl = base_url+"media/whatsappTemp/"+temp+".png";
    $('.template_name_display').html(temp);
    $('#myImage').attr('src', imageUrl);
});

$('input[name="typeoffilter"]').change(function() {
    const selectedOption = $(this).val();
    $(".block_filter").show();
    $(".block_bulk").hide();
    $(".block_menually").hide();
    $(".block_retarget").hide();
    if(selectedOption == "filter"){
        $(".block_filter").show();
        $(".block_bulk").hide();
        $(".block_menually").hide();
        $(".block_retarget").hide();
    }else if(selectedOption == "bulk"){
        $(".block_filter").hide();
        $(".block_bulk").show();
        $(".block_menually").hide();
        $(".block_retarget").hide();
    }else if(selectedOption == "manually"){
        $(".block_filter").hide();
        $(".block_bulk").hide();
        $(".block_menually").show();
        $(".block_retarget").hide();
    }else if(selectedOption == "retarget"){
        $(".block_filter").hide();
        $(".block_bulk").hide();
        $(".block_menually").hide();
        $(".block_retarget").show();
    }
});

/* whatsapp bulk add filter end date onchange */
$("#end_date").on("change", function() {
    var endDate = $(this).val(); 
    var startDate = $("#start_date").val(); 
    var filter = $("#filter_type").val(); 
    $.ajax({
        type: 'post',
        url: Admin_url + 'whatsappbulk/filterDataRecordCount',
        data: { 
            endDate: endDate, 
            startDate: startDate, 
            filter: filter, 
        },
        success: function (msg) {
            var data = $.parseJSON(msg);
            if (data.status == 'success') {
                $(".record_count").html("Total Record: "+data.record);
                notifictaion(data.status, data.message, 'success');
            }
        }
    });
});
