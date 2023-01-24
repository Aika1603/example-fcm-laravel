"use strict";

// Class Definition
var KTPasswordResetNewPassword = function() {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {					 
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Kata sandi wajib diisi'
                            },
                            callback: {
                                message: 'Please enter valid password',
                                callback: function(input) {
                                    if (input.value.length > 0) {        
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'password_confirmation': {
                        validators: {
                            notEmpty: {
                                message: 'Konfirmasi kata sandi wajib diisi'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Kata sandi dan konfirmasinya tidak sama'
                            }
                        }
                    }
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }  
                    }),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
				}
			}
		);

        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            validator.revalidateField('password');

            // Validate form
            validator.validate().then(function (status) {
                if ($("#g-recaptcha-response").val() == '') {
                    return Swal.fire({
                        html: "Captcha wajib dicentang",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
                }

                if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    $.ajax({
                        type: 'POST',
                        url: $(form).attr('action'),
                        data: new FormData($(form)[0]),
                        success: function (data) {
                            $('meta[name="csrf-token"]').attr('content', data._token);
                            $('input[name="_token"]').val(data._token);

                            if (data.status === true) {
                                Swal.fire({
                                    title: "Pendaftaran Berhasil",
                                    html: data.message,
                                    icon: "success",
                                    customClass: {
                                        confirmButton: "btn btn-success"
                                    }
                                }).then((result) => {
                                    if (data.return_url != '#') {
                                        document.location.href = data.return_url
                                    }
                                });;
                            } else {
                                Swal.fire({
                                    title: "Pendaftaran Gagal",
                                    html: data.message,
                                    icon: "error",
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                            grecaptcha.reset();
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        error: function (data) {
                            if (data == "" || data == null) {
                            } else {
                                Swal.fire({
                                    title: "Pendaftaran Gagal",
                                    html: data,
                                    icon: "error",
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                            grecaptcha.reset();
                        },
                        statusCode: {
                            //to handle ci
                            403: function () {
                                Swal.fire({
                                    title: "Info",
                                    html: "Page expired. Mohon refresh page terlebih dahulu",
                                    icon: "info",
                                    customClass: {
                                        confirmButton: "btn btn-info"
                                    }
                                });
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                grecaptcha.reset();
                            },
                            //to handle laravel
                            419: function () {
                                Swal.fire({
                                    title: "Info",
                                    html: "Page expired. Mohon refresh page terlebih dahulu",
                                    icon: "info",
                                    customClass: {
                                        confirmButton: "btn btn-info"
                                    }
                                });
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                grecaptcha.reset();
                            },
                            422: function (response) {
                                let res = '<b>Harap lengkapi semua isian</b>';
                                if (typeof response.responseJSON.errors.token !== 'undefined') {
                                    res += `<br/>` + response.responseJSON.errors.token;
                                }
                                if (typeof response.responseJSON.errors.password !== 'undefined') {
                                    res += `<br/>` + response.responseJSON.errors.password;
                                }
                                if (typeof response.responseJSON.errors.g-recaptcha-response !== 'undefined') {
                                    res += `<br/>Captcha wajib di centang`;
                                }

                                Swal.fire({
                                    title: "Perhatian",
                                    html: res,
                                    icon: "warning",
                                    customClass: {
                                        confirmButton: "btn btn-warning"
                                    }
                                });
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                grecaptcha.reset();
                            }
                        }
                    });

                } else {
                    Swal.fire({
                        html: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
                }
            });
        });


        form.querySelector('input[name="password"]').addEventListener('input', function() {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }

    var validatePassword = function() {
        return  (passwordMeter.getScore() === 100);
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            form = document.querySelector('#kt_new_password_form');
            submitButton = document.querySelector('#kt_new_password_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTPasswordResetNewPassword.init();
});
