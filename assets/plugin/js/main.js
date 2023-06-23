function togglePartnerAuthform() {
    $(".validatePartnerLogin, .validatePartnerPreRegister").toggleClass("d-none");
}

$("#showPassword").change(function () {
    $(this).prop("checked") ? $("#pPass").prop("type", "text") : $("#pPass").prop("type", "password");
});

//validate partner login
function validatePartnerLogin() {
    $(".validatePartnerLogin").validate({
        rules: {
            pCred: {
                required: true,
            },
            pPass: {
                required: true,
                minlength: 6,
            },
        },

        submitHandler: function (form) {
            var partnerData = $(form).serialize();
            $.ajax({
                url: "PartnerControl/validatePartnerLogin",
                type: "POST",
                cache: false,
                data: partnerData,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.type == 0) {
                        Swal.fire('Alert!', response.msg, 'error');
                    } else {
                        location.href = response.url;
                    }
                }
            });
        }
    })
}

//validate partner pre registration
function validatePartnerPreRegister() {
    $(".validatePartnerPreRegister").validate({
        rules: {
            pName: {
                required: true,
                letterswithbasicpunc: true,
            },
            pState: {
                required: true,
            },
            pEmail: {
                required: true,
                email: true,
            },
            pMobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
            pOrgType: {
                required: true,
            },
            pPass: {
                required: true,
                minlength: 6,
            },
            readGuide: {
                required: true,
            }
        },

        submitHandler: function (form) {
            var partnerData = $(form).serialize();
            $.ajax({
                url: "PartnerControl/validatePartnerPreRegister",
                type: "POST",
                cache: false,
                data: partnerData,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.type == 0) {
                        Swal.fire('Alert!', response.msg, 'error');
                    } else {
                        togglePartnerAuthform();
                        $('.alert').removeClass('d-none').addClass('alert-success'); $('.resp-msg').html(response.msg);
                        $('#showAuth form').trigger("reset");
                        $('#showAuth input').prop('readonly', false);
                        $('#showAuth em').show();
                    }
                }
            });
        }
    })
}

function showVerifyModal(OTPtype, OTPrcvr, OTPData, url) {
    $('#verifyModal').modal('show');
    $('#verifyModal .modal-title').html(OTPtype + " Verification");
    $('#verifyModal label').html("Enter OTP sent to your " + OTPtype);
    // $('#OTPData').val(OTPData);
    $('#verifyModalBtn').attr('onclick', 'verify_otp("' + OTPtype + '","' + OTPrcvr + '","' + url + '")');
}

function send_otp(OTPtype, OTPrcvr, url) {
    if (OTPtype == "Email") {
        var OTPrcvrVal = $(OTPrcvr).val();
    }
    else if (OTPtype == "Mobile") {
        var OTPrcvrVal = $(OTPrcvr).val();
    }
    $.ajax({
        url: url,
        type: "POST",
        data: {
            OTPtype: OTPtype,
            OTPrcvr: OTPrcvrVal,
        },
        dataType: "JSON",
        success: function (res) {
            if (res.type == 0) {
                Swal.fire('Ohhh Nooo!', res.msg, 'error');
            } else {
                showVerifyModal(OTPtype, OTPrcvr, res.msg, url.replace('send', 'verify'));
            }
        }
    });
}

function verify_otp(OTPtype, OTPrcvr, url) {
    var OTPData = $('#OTPData').val();
    $.ajax({
        url: url,
        type: "POST",
        data: {
            OTPtype: OTPtype,
            OTPData: OTPData,
        },
        dataType: "JSON",
        success: function (res) {
            if (res.type == 0) {
                Swal.fire('Alert!', res.msg, 'error');
            } else {
                if (res.vE || res.vM) {
                    $('#verifyModal').modal('hide');
                    $(OTPrcvr).prop('readonly', true);
                    $(OTPrcvr).siblings('em').hide();
                }
            }
        }
    });
}

$('.contact-form').submit(function (event) {
    event.preventDefault();
    $('.btn-contact-submit').html('Sending. Please wait..');

    var form = $(this);
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
    }).done(function () {
        Swal.fire('Thank You!', 'Your Message has been received. Our representative will get in touch with you within 24 hours!!!', 'success');
        form[0].reset();
        $('.btn-contact-submit').html('Send Message');
    })
});

// ====================================================================================================
// ====================================================================================================
function validatePartnerPostRegister() {
    $(".partnerPostData").validate({
        rules: {
            orgName: { required: true },
            orgRegDate: { required: true },
            orgOprState: { required: true },
            orgOprDist: { required: true },
            orgRegNo: { required: true },
            orgRegDoc: { required: true, extension: "pdf", maxsize: 3145728, },
            orgPresName: { required: true },
            orgSecrName: { required: true },
            orgFcraNo: { required: false },
            orgFcraDoc: { required: '#orgFcraNo:filled', extension: "pdf", maxsize: 3145728, },
            orgGstNo: { required: false },
            orgGstDoc: { required: '#orgGstNo:filled', extension: "pdf", maxsize: 3145728, },
            orgRegType: { required: true },
            orgNgoType: { required: true },
            orgActName: { required: true },
            orgCityReg: { required: true },
            orgPanNo: { required: false },
            orgPanDoc: { required: '#orgPanNo:filled', extension: "pdf", maxsize: 3145728, },
            orgOtherDoc: { required: false, extension: "pdf", maxsize: 3145728, },
            orgNgoUnqId: { required: false },
            orgMobNo: { required: true, number: true, minlength: 10, maxlength: 10, },
            orgEmailId: { required: true, email: true, },
            orgWebsite: { required: false, url: true, },
            orgRegAddr: { required: true },

            orgCntcName: { required: true },
            orgCntcAadhar: { required: true, number: true, minlength: 4, maxlength: 4 },
            orgCntcMob: { required: true, number: true, minlength: 10, maxlength: 10, },
            orgCntcEmail: { required: true, email: true, },
            orgCntcPost: { required: true },
            orgCntcAddr: { required: true },
        },
        messages: {
            orgRegDoc: { extension: "Please upload only PDF files.", maxsize: "Document size must not exceed 3MB", },
            orgFcraDoc: { extension: "Please upload only PDF files.", maxsize: "Document size must not exceed 3MB", },
            orgGstDoc: { extension: "Please upload only PDF files.", maxsize: "Document size must not exceed 3MB", },
            orgPanDoc: { extension: "Please upload only PDF files.", maxsize: "Document size must not exceed 3MB", },
        },

        submitHandler: function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "Once You click on submit, You'll no longer Edit it. Please review your submission thoroughly.",
                icon: 'warning',
                confirmButtonText: 'Confirm & Submit',
                showCancelButton: true,
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    var PartnerData = new FormData($(".partnerPostData")[0]);
                    $.ajax({
                        url: "../PartnerControl/validatePartnerPostRegister",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: PartnerData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType: "JSON",
                        success: function (res) {
                            if (res.type == 0) {
                                Swal.fire('Alert!', res.msg, 'error');
                            } else {
                                Swal.fire({
                                    title: 'success',
                                    text: res.msg,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                });
                                setTimeout(function () {
                                    location.href = "../partner/dashboard";
                                }, 2500);
                            }
                        }
                    });
                }
            })
        }
    })
}

function partnerApply() {
    $("#partnerApply form").validate({
        rules: {
            applyNotif: {
                required: true,
            },
            applyState: {
                required: true,
            },
            applyDist: {
                required: true,
            },
        },
        messages: {
            applyDist: {
                required: "Please select atleast one district",
            },
        },

        submitHandler: function (form) {
            var partnerData = $(form).serialize();
            $.ajax({
                url: "../PartnerControl/partnerApply",
                type: "POST",
                cache: false,
                data: partnerData,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.type == 0) {
                        Swal.fire('Alert!', response.msg, 'error');
                    } else {
                        // $('#partnerApply').modal('hide');
                        // Swal.fire('Great!', response.msg, 'success');
                        location.reload();
                    }
                }
            });
        }
    })
}






// Admin Side











//validate partner login
function validateAdminLogin() {
    $(".validateAdminLogin").validate({
        rules: {
            aEmail: {
                required: true,
            },
            aPass: {
                required: true,
                minlength: 5,
            },
        },

        submitHandler: function (form) {
            var adminData = $(form).serialize();
            $.ajax({
                url: "../AdminControl/validateAdminLogin",
                type: "POST",
                cache: false,
                data: adminData,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.type == 0) {
                        Swal.fire('Alert!', response.msg, 'error');
                    } else {
                        location.href = response.url;
                    }
                }
            });
        }
    })
}

function partnerApplic(ptnrID) {
    $('#applicList').modal('show');
    $.ajax({
        url: "../AdminControl/partnerApplic",
        type: "POST",
        data: {
            ptnrID: ptnrID
        },
        dataType: "JSON",
        success: function (res) {
            let data = '';
            if (res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    var status = '', remarks = '';
                    if (res[i].apStatus == 0) {
                        status = '<span class="text-primary">Waiting for physical verification</span>';
                        remarks = '<span class="badge bg-warning">Pending</span>';
                    } else if (res[i].apStatus == 1) {
                        status = '<span class="text-primary">Waiting for Field verification</span>';
                        remarks = '<span class="badge bg-warning">Pending</span>';
                    } else if (res[i].apStatus == 2) {
                        status = '<span class="text-success">Verification successful</span>';
                        remarks = '<span class="badge bg-success">Success</span>';
                    }

                    data += '<td>' + i + 1 + '</td>';
                    data += '<td>' + 'Notif No. 235-108' + '</td>';
                    data += '<td>' + res[i].apState + '</td>';
                    data += '<td>' + res[i].apDistrict + '</td>';
                    data += '<td>' + status + '</td>';
                    data += '<td>' + remarks + '</td>';
                }
            } else {
                data += '<p class="mt-4 fw-bold text-danger">No data found</p>';
            }
            $('#applicList .data').html(data);
        },
    });
}

function emailPartner(pEmail) {
    $('#emailPartner').modal('show');
    $('#pEmail').val(pEmail);

    $("#emailPartner form").validate({
        rules: {
            pMessage: {
                required: true,
            },
        },

        submitHandler: function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure to send mail?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Please!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../AdminControl/emailPartner",
                        method: 'POST',
                        data: {
                            pEmail: $('#pEmail').val(),
                            pMessage: $('#pMessage').val(),
                        },
                        dataType: "JSON",
                        success: function (data) {
                            $('#emailPartner').modal('hide');
                            Swal.fire('Great!', data.msg, 'success');
                        }
                    });
                }
            })
        }
    })
}

function deletePartner(elem) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this Partner. This procedure is irreversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Please!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "../AdminControl/deletePartner",
                data: {
                    pcId: $(elem).attr("pcId"),
                },
                success: function () {
                    location.reload();
                },
            });
        }
    })
}