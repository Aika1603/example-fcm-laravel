@extends('layouts.auth')

@section('content')
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Login ke {{ config('app.name') }} Administrator <br/><small class="text-gray-400 fs-5">Silahkan isi formulir berikut untuk masuk ke sistem</small></h1>
                        {{-- 
                            <div class="text-gray-400 fw-bold fs-4"><br/> <b>Belum punya Akun? </b> 
                                <a href="{{ route('register') }}" class="link-primary fw-bolder">Buat Akun Baru</a>
                            </div>
                         --}}
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                        <input class="form-control form-control-lg " type="text" name="username" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Kata Sandi</label>
                            {{-- <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Lupa Kata Sandi ?</a> --}}
                        </div>
                        <input class="form-control form-control-lg " type="password" name="password" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-10 text-center">
                        <div class="g-recaptcha" style="display:inline-block;min-height:50px;" data-theme="light"  data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Sign In</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
            <div class="d-flex flex-center fw-bold fs-6">
                <a href="" class="text-muted text-hover-primary px-2" >Diskominfo Karawang</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptjs')
    <script>
        "use strict";
        // Class definition
        var KTSigninGeneral = function() {
            // Elements
            var form;
            var submitButton;
            var validator;

            // Handle form
            var handleForm = function(e) {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {					
                            'username': {
                                validators: {
                                    notEmpty: {
                                        message: 'Username wajib diisi'
                                    },
                                    /** Uncomment if using email */
                                    // emailAddress: {
                                    // 	message: 'Masukkan alamat email yang valid'
                                    // }
                                }
                            },
                            'password': {
                                validators: {
                                    notEmpty: {
                                        message: 'Kata sandi wajib diisi'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row'
                            })
                        }
                    }
                );		

                // Handle form submit
                submitButton.addEventListener('click', function (e) {
                    // Prevent button default action
                    e.preventDefault();

                    // Validate form
                    validator.validate().then(function (status) {
                        if($("#g-recaptcha-response").val() == ''){
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
                                            title: "Login Berhasil",
                                            html: "Anda akan dialihkan menuju Dashboard",
                                            icon: "success",
                                            customClass: {
                                                confirmButton: "btn btn-success"
                                            }
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                form.querySelector('[name="username"]').value = "";
                                                form.querySelector('[name="password"]').value = "";
                                            }
                                            if (data.return_url != '#') {
                                                document.location.href = data.return_url
                                            }
                                        });;
                                    } else {
                                        Swal.fire({
                                            title: "Login Gagal",
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
                                            title: "Login Gagal",
                                            html: 'Terjadi kesalahan ketika melakukan koneksi ke sistem',
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
                                        if (typeof response.responseJSON.errors.username !== 'undefined') {
                                            res += `<br/>` + response.responseJSON.errors.username;
                                        }
                                        if (typeof response.responseJSON.errors.email !== 'undefined') {
                                            res += `<br/>` + response.responseJSON.errors.email;
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
            }

            // Public functions
            return {
                // Initialization
                init: function() {
                    form = document.querySelector('#kt_sign_in_form');
                    submitButton = document.querySelector('#kt_sign_in_submit');
                    
                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTSigninGeneral.init();
        });

    </script>
@endsection
