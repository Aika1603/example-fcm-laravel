
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title content="{{ $title ?? 'Landing' }} - {{ config('app.name', 'Laravel') }}">{{ $title ?? 'Landing' }} - {{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon"  />
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta name="description" content="{{ $title ?? 'Landing' }} - {{ config('app.name', 'Laravel') }}" />
    <meta name="keywords" content="{{ $title ?? 'Landing' }} - {{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="" />
    <meta property="og:title" content="{{ $title ?? 'Landing' }} - {{ config('app.name', 'Laravel') }}" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    @yield('scriptcss')

    <link href="{{ Auth::user()->theme == 'light' ? asset('src/plugins/global/plugins.bundle.css') : asset('src/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Auth::user()->theme == 'light' ? asset('src/css/style.bundle.css') : asset('src/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <style>
        body
        {
            font-family: 'Roboto' !important;
        }

        ::-webkit-scrollbar {
            height: 10px !important;              /* height of horizontal scrollbar  */
            width: 10px !important;               /* width of vertical scrollbar */
            border: 1px solid #d5d5d5 !important;
        }
        ::-webkit-scrollbar-thumb:horizontal{
            background-color: #808080 !important;
            border-radius: 10px !important;
        }
        ::-webkit-scrollbar-thumb:vertical{
            background-color: #808080 !important;
            border-radius: 10px !important;
        }
    </style>

    <link href="{{ asset('src/css/flash.css') }}" rel="stylesheet" type="text/css" />
    <script data-pace-options='{ "ajax": false }' src="{{ asset('src/js/pace.min.js') }}"></script>
</head>
	<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
                @include('layouts.components.sidebar')
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    @include('layouts.components.navbar')

                    @yield('content')

                    @include('layouts.components.footer')

				</div>
			</div>
		</div>
        {{-- global modal fullscreen --}}
        <div class="modal bg-white fade" tabindex="-1" id="global_modal">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content shadow-none">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title_global_modal"></h5>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times fs-2"></i>
                        </div>
                    </div>

                    <div class="modal-body" id="content_global_modal">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
		<script>var hostUrl = "{{ asset('src/') }}";</script>
        <script src="{{ asset('src/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('src/js/scripts.bundle.js') }}"></script>
        <script>
            
            const slideTo = (param = 'kt_datas_table') => {
                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $("#"+param).offset().top
                    }, 600);
                }, 100);
            }
                
            const showGlobalModal = (title = null, content = null) => {
                $('#title_global_modal').html('Menampilkan data '+title);
                $('#content_global_modal').html(content);
                return $('#global_modal').modal('show');
            }

            const capitalizeFirstLetter = (string)  => {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            const handleOpenFilter = (id) => {
                $('#btn-filter-'+id).prop('disabled', true).addClass('active');
                $('#card-filter-'+id).slideDown();
            }

            const handleCloseFilter = (id) => {
                $('#btn-filter-'+id).prop('disabled', false).removeClass('active');
                $('#card-filter-'+id).slideUp();
            }

            const formatCurrency = (bilangan) => {
                var	reverse = bilangan.toString().split('').reverse().join(''),
                ribuan 	= reverse.match(/\d{1,3}/g);
                ribuan	= ribuan.join('.').split('').reverse().join('');
                return 'Rp. '+ribuan;
            }
            
            const numberOnly = (param) => {
                let val = $(param).val().replace(/[^0-9]/g, '');
                $(param).val(val);
            }
            
            const loadIndicator = () => {
                return Swal.fire({
                    title: 'Tunggu sebentar ya!',
                    html: 'Sistem sedang memperoses permintaan Kamu',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });
            }
        
            const db_date_formatted = ($param) => {
                const date = new Date($param);
                const yyyy = date.getFullYear();
                let mm = date.getMonth() + 1; // Months start at 0!
                let dd = date.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return yyyy + '-' + mm + '-' + dd;
            }

            const handleNikUserChange = (param) => {
                let email = $(param).parent().parent().find('.email').val();
                $(param).parent().parent().find('.email').val(email).change();
            }

            const handleValidationEmail = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let nik = $(param).parent().parent().find('.nik-user').val();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('users/check_email') }}/`+name+'?nik='+nik,
                    success: function(data) {
                        if(data == 0) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Sudah Digunakan Pengguna Lain!</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }

            const handleValidationSekolah = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('sekolah/check') }}/`+name,
                    success: function(data) {
                        if(data == 1) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Tidak terdaftar</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }

            const handleValidationKecamatan = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('kecamatan/check') }}/`+name,
                    success: function(data) {
                        if(data == 1) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Tidak terdaftar</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }
            
            const handleValidationPuskesmas = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let kecamatan_name = $(param).parent().parent().find('.kecamatan_name').val();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('puskesmas/check') }}/`+name+'?kecamatan_name='+kecamatan_name,
                    success: function(data) {
                        if(data == 1) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Tidak terdaftar</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }
            
            const handleValidationDesa = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let kecamatan_name = $(param).parent().parent().find('.kecamatan_name').val();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('desa/check') }}/`+name+'?kecamatan_name='+kecamatan_name,
                    success: function(data) {
                        if(data == 1) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Tidak terdaftar</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }
            
            const handleValidationPosyandu = (param) => {
                $(param).parent().find('.no-valid-data').remove();
                let desa_name = $(param).parent().parent().find('.desa_name').val();
                let name = $(param).val();
                if(name == ''){
                    return true;
                }
                $.ajax({
                    type: "GET",
                    url: `{{ url('posyandu/check') }}/`+name+'?desa_name='+desa_name,
                    success: function(data) {
                        if(data == 1) {
                            $(param).parent().find('.no-valid-data').remove();
                        } else  {
                            $(param).parent().append('<small class="text-danger no-valid-data">Tidak terdaftar</small>');
                        }
                    },
                    error: function(data) {
                        return toastr.error("Koneksi gagal dilakukan!");
                    }
                })
            }

            const textOnly = (param) => {
                let val = $(param).val().replace(/[^a-zA-Z ]/g, '');
                $(param).val(val);
            }
            
            
            $( document ).ready(function() {
                 // currency format
                Inputmask("Rp. 99.999", {
                    "numericInput": true
                }).mask(".kt_inputrupiah");
            
                
                $('[data-toggle=confirm-remove]').click(function() {
                    address = $(this).attr('data-address');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if(result.value) {
                            
                            $.ajax({
                            type: "GET",
                            url: address,
                            success: function(data) {
                                    if(data.status == 1) {
                                        Swal.fire({
                                            title: "Proses Berhasil",
                                            html: data.message,
                                            icon: "success",
                                            customClass: {
                                                confirmButton: "btn btn-success"
                                            }
                                        }).then((value) => {
                                            if(data.return_url != '#') {
                                                window.location.replace(data.return_url);
                                            }
                                        });
                                    } else  {
                                        Swal.fire({
                                            title: "Proses Gagal",
                                            html: data.message,
                                            icon: "error",
                                            customClass: {
                                                confirmButton: "btn btn-danger"
                                            }
                                        });
                                    }
                                }
                            })
                        }
                    });
                });

                $('[data-toggle=confirm-action]').click(function() {
                    address = $(this).attr('data-address');
                    Swal.fire({
                        title: "Anda yakin?",
                        text: "Tindakan ini akan mengulang proses yang sudah dilakukan!",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Ya!",
                        cancelButtonText: "Tidak",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            document.location.href = address
                        }
                    });
                });
            });
        </script>
        <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
        <script>
            if (!('serviceWorker' in navigator)) {
                console.warn("Service worker tidak didukung browser ini.");
            } else {
                var firebaseConfig = {
                    apiKey: "AIzaSyALLDfXQHQd3JXVcoxquQnk5syIprxrVCQ",
                    authDomain: "aptika-5ee82.firebaseapp.com",
                    projectId: "aptika-5ee82",
                    storageBucket: "aptika-5ee82.appspot.com",
                    messagingSenderId: "540677008778",
                    appId: "1:540677008778:web:6dad50aaa79d4b366fec73"
                };
                firebase.initializeApp(firebaseConfig);

                const messaging = firebase.messaging();
                messaging
                    .requestPermission()
                    .then(function () {
                        return messaging.getToken();
                    })
                    .then(function (token) {
                        // ajax request to save token
                        $.ajax({
                            url     : "{{ url('/notification/update-fcm') }}",
                            method  : "POST",
                            data    : {
                                fcm     : token,
                                _token  : $('meta[name="csrf-token"]').attr('content')
                            },
                            success : function(response) {
                                console.log(response.message);
                                $('meta[name="csrf-token"]').attr('content', response._token);
                                $('input[name="_token"]').val(response._token);
                            },
                            error   : function(){
                                console.error('push token fail!');
                            }
                        })
                    })
                    .catch(function (err) {
                        console.log('Unable to get permission to notify.', err);
                        Swal.fire("Perhatian", "Izinkan aplikasi untuk mengirimkan Anda notifikasi! ", "warning").then((value) => {
                        });
                    });

                let enableForegroundNotification = false;
                messaging.onMessage(function (payload) {

                    document.getElementById('audio-notif').play();

                    if (enableForegroundNotification) {
                        let notification = payload.notification;
                        navigator.serviceWorker
                            .getRegistrations()
                            .then((registration) => {
                                registration[0].showNotification(notification.title);
                            });
                    }
                });
            }

            // $(document).ready(() => {
            //     document.getElementById('audio-notif').play()
            // })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        @yield('scriptjs')
        @stack('customjs')
	</body>
</html>