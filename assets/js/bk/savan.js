function notifictaion(title, message, type) {

    new PNotify({

        title: title,

        text: message,

        type: type,

        cornerclass: 'ui-pnotify-sharp'

    });

}

function deleterecord(id, path) {
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
                    type: 'post',
                    url: Admin_url + path,
                    data: {
                        id: id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.status == 'success') {
                            swal("Deleted!", data.message, {
                                icon: "success",
                            });
                            if (id == "rem") {
                                $('.' + id).html("");
                            }
                            $('#' + id).remove();
                            /*notifictaion(data.status,data.message,'success');
                            setTimeout(function() { 
                                window.location.replace(Admin_url + 'setting');
                             }, 1500); */
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

function openMobileConfirm(lead_assign_id,id) {
    swal({
            title: "Are you sure you want to open?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: Admin_url + "teleUserSales/viewProfile",
                    data: {
                        id: id,
                        lead_assign_id: lead_assign_id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.status == 'success') {
                           /*  swal("Open!", data.message, {
                                icon: "success",
                            }); */
                            notifictaion("success","Successfully Open", 'success');
                            $('#' + lead_assign_id).remove();
                            //notifictaion(data.status,data.message,'success');
                            setTimeout(function() { 
                                window.location.replace(Admin_url + 'teleUserSales/leadOpenViewPage/'+id+'/'+lead_assign_id);
                                /* window.open(Admin_url + 'teleUserSales/leadOpenViewPage/'+id+'/'+lead_assign_id); */
                             }, 1000);
                        } else {
                            swal("Open Aborted", data.message, {
                                icon: "error",
                            });
                        }
                    }
                });
            } else {
                /* swal("Relax Open Aborted", {
                    icon: "error",
                }); */
            }
        });
}


function createFolder(id, path) {
    swal({
            title: "Are you sure Want to Create?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: Admin_url + path,
                    data: {
                        id: id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.status == 'success') {
                            swal("Created!", data.message, {
                                icon: "success",
                            });
                            /*notifictaion(data.status,data.message,'success');
                            setTimeout(function() { 
                                window.location.replace(Admin_url + 'setting');
                             }, 1500); */
                        } else {
                            swal("Not Create", data.message, {
                                icon: "error",
                            });
                        }
                    }
                });
            } else {
                swal("Not Create", {
                    icon: "error",
                });
            }
        });
}

$('#log').change(function() {

    var data = $('option:selected', this).val();

    $.ajax({

        type: 'post',

        url: Admin_url + 'auth/sessionupdate',

        data: {
            id: data
        },

        success: function(result) {

            var data = JSON.parse(result);

            if (data.status == 'success') {

                notifictaion(data.status, data.message, 'success');

                setTimeout(function() {

                    window.location.replace(Admin_url + 'auth/login');

                }, 1500);

                /* window.location.replace( Admin_url + 'auth/login');*/

            }

        }

    });

});

$('.onlynumber').on('keydown keypress keyup paste input', function() {

    while (($(this).val().split(".").length - 1) > 1) {

        $(this).val($(this).val().slice(0, -1));

        if (($(this).val().split(".").length - 1) > 1) {

            continue;

        } else {

            return false;

        }

    }

    $(this).val($(this).val().replace(/[^0-9.]/g, ''));

    var int_num_allow = 10;

    var float_num_allow = 2;

    var iof = $(this).val().indexOf(".");

    if (iof != -1) {

        if ($(this).val().substring(0, iof).length > int_num_allow) {

            $(this).val('');

            $(this).attr('placeholder', 'invalid number');

        }

        $(this).val($(this).val().substring(0, iof + float_num_allow + 1));

    } else {

        $(this).val($(this).val().substring(0, int_num_allow));

    }

    return true;

});

function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            $('#blah').attr('src', e.target.result);

        }

        console.log(reader);

        reader.readAsDataURL(input.files[0]);

    }

}

$("#imgInp").change(function() {

    readURL(this);

    $('#editprofile').submit();

});

$('#editprofile').validate({

    rules: {},

    highlight: function(element) {

        $(element).addClass("field-error");

    },

    unhighlight: function(element) {

        $(element).removeClass("field-error");

    },

    errorPlacement: function(error, element) {

        return false;

    },

    submitHandler: function(form) {

        var data = new FormData();

        var form_data = $('#editprofile').serializeArray();

        $.each(form_data, function(key, input) {

            data.append(input.name, input.value);

        });

        var file_data = $('input[name="image"]')[0].files;

        for (var i = 0; i < file_data.length; i++) {

            data.append("image", file_data[i]);
        }

        $.ajax({

            type: 'post',

            url: Admin_url + 'user/profileupload',

            data: data,

            contentType: false,

            cache: false,

            processData: false,

            success: function(response) {

                var data = jQuery.parseJSON(response);

                if (data.status == 'success') {

                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");

                    notifictaion(data.status, data.message, 'success');

                    setTimeout(function() {

                        window.location.replace(Admin_url + 'user/profile');

                    }, 1500);

                } else {

                    notifictaion(data.status, data.message, 'error');

                    /*One.helpers('notify', {type: 'danger', icon: 'fa fa-check mr-1', message:'Not Updated'});*/

                    /*  setTimeout(function() { 

                          window.location.replace(Admin_url + 'user/profile');

                       }, 1500);  */

                }

            }

        });

    }

})

$('#profileedit').validate({

    rules: {

        name: {

            required: true

        },

        mobile: {

            required: true,

            minlength: 10,

            maxlength: 10,

        },

    },

    highlight: function(element) {

        $(element).addClass("field-error");

    },

    unhighlight: function(element) {

        $(element).removeClass("field-error");

    },

    errorPlacement: function(error, element) {

        return false;

    },

    submitHandler: function(form) {

        var data = new FormData();

        //Form data

        var form_data = $('#profileedit').serializeArray();

        $.each(form_data, function(key, input) {

            data.append(input.name, input.value);

        });

        /* var file_data = $('input[name="image"]')[0].files;

         for (var i = 0; i < file_data.length; i++) {

             data.append("image", file_data[i]);

         }*/

        $.ajax({

            type: 'post',

            url: Admin_url + 'user/adminprofile',

            data: data,

            contentType: false,

            cache: false,

            processData: false,

            success: function(response) {

                var data = jQuery.parseJSON(response);

                if (data.status == 'success') {

                    notifictaion(data.status, data.message, 'success');

                    setTimeout(function() {

                        window.location.replace(Admin_url + 'user/profile');

                    }, 1500);

                } else {

                    notifictaion(data.status, data.message, 'error');
                }

            }

        });

    }

});

$('#role').validate({

    rules: {

        role: {

            required: true,

        },

        permission: {

            required: true,

        }

    },

    highlight: function(element) {

        $(element).addClass("field-error");

    },

    unhighlight: function(element) {

        $(element).removeClass("field-error");

    },

    errorPlacement: function(error, element) {

        return false;

    },

    submitHandler: function(form) {

        $('#role').find(':submit').html('<i class="fa fa-refresh fa-spin"></i>');

        $('#role').find(':submit').attr("disabled", true);

        var data = new FormData();

        var form_data = $('#role').serializeArray();

        $.each(form_data, function(key, input) {

            data.append(input.name, input.value);

        });

        $.ajax({

            type: 'post',

            url: Admin_url + 'setting/role',

            data: data,

            contentType: false,

            cache: false,

            processData: false,

            success: function(response) {

                var data = jQuery.parseJSON(response);

                if (data.status == 'success') {

                    $('#role').find(':submit').html('Save');

                    $('#role').find(':submit').removeAttr("disabled");

                    $("input[type=text], textarea,input[type=email],input[type=password],input[type=number],input[type=date]").val("");

                    notifictaion(data.status, data.message, 'success');

                    setTimeout(function() {

                        window.location.replace(Admin_url + 'setting/role');

                    }, 1500);

                } else {

                    $('#role').find(':submit').html('Save');

                    $('#role').find(':submit').removeAttr("disabled");

                    notifictaion(data.status, data.message, 'error');

                }

            }

        });

    }

});

function deleterole(id) {

    swal({

        title: "Are you sure?",

        text: "Once deleted, you will not be able to recover this imaginary file!",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

        if (willDelete) {

            $.ajax({

                type: 'post',

                url: Admin_url + 'setting/deleterole',

                data: {
                    id: id
                },

                success: function(result) {

                    var data = JSON.parse(result);

                    if (data.status == 'success') {

                        swal("Deleted!", data.message, {

                            icon: "success",

                        });

                        setTimeout(function() {

                            window.location.replace(Admin_url + 'setting/role');

                        }, 1500);

                        $('#' + id).remove();

                    } else {

                        swal("Delete Aborted", data.message, {

                            icon: "error",

                        });

                    }

                }

            });

        } else {

            swal("Relax Delete Aborted");

        }

    });

}

$('.confirmation-callback').confirmation({

    onConfirm: function() {

        var dat = $(this)[0].id.split("/");

        var urlss = window.location.href;

        $.ajax({

            type: 'post',

            url: Admin_url + dat[1] + '/' + dat[2],

            data: {
                id: dat[0]
            },

            success: function(result) {

                var data = JSON.parse(result);

                if (data.status == 'success') {

                    swal("Deleted!", data.message, {

                        icon: "success",

                    });

                    setTimeout(function() {

                        window.location.replace(urlss);

                    }, 1500);

                    $('#' + id).remove();

                } else {

                    swal("Delete Aborted", data.message, {

                        icon: "error",

                    });

                }

            }

        });

    },

    onCancel: function() {

        swal("Delete Aborted", "Relax Is Not Delete", {

            icon: "error",

        });

    }

});

$('input[type=radio][name=resource]').change(function() {

    if (this.value == 'image') {

        $('.image').removeClass('radiohide');

        $('.video').addClass('radiohide');

    } else if (this.value == 'video') {

        $('.video').removeClass('radiohide');

        $('.image').addClass('radiohide');

    }

});



function paymentLinkSendByFaildPayment(id, amount) {
    swal({
        title: "Are you sure you Want to Send Payment Link.?",
        text: "",
        icon: "info",
        buttons: true,
        dangerMode: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'post',
                url: Admin_url + "pyments/sendPaymentLinkByUser",
                data: {
                    user_id: id,
                    amount: amount
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 'success') {
                        swal("Send!", data.message, {
                            icon: "success",
                        });
                        
                        /*notifictaion(data.status,data.message,'success');
                        setTimeout(function() { 
                            window.location.replace(Admin_url + 'setting');
                            }, 1500); */
                    } else {
                        swal("Send Aborted", data.message, {
                            icon: "error",
                        });
                    }
                }
            });
        } else {
            swal("Relax! Not send Aborted", {
                icon: "error",
            });
        }
    });
}