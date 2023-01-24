
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

    <link href="{{ asset('src/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

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

</head>
	<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
		<div class="d-flex flex-column flex-root">
            @yield('content')
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


            const textOnly = (param) => {
                let val = $(param).val().replace(/[^a-zA-Z ]/g, '');
                $(param).val(val);
            }
            
            
            $( document ).ready(function() {
                 // currency format
                Inputmask("Rp. 99.999", {
                    "numericInput": true
                }).mask(".kt_inputrupiah");
            
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        @yield('scriptjs')
        @stack('customjs')
	</body>
</html>