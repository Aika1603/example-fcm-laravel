<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ $menu ?? '' }}</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <meta property="og:locale" content="en_US" /> -->
    <meta property="og:type" content="" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('src/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="shortcut icon"  href="{{ asset('images/favicon.png') }}" />

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <link href="{{ asset('src/css/flash.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('src/js/pace.min.js') }}"></script>
</head>
<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
    <script src="{{ asset('./src/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('./src/js/scripts.bundle.js') }}"></script>
    <script>
        const numberOnly = (param) => {
            let val = $(param).val().replace(/[^0-9]/g, '');
            $(param).val(val);
        }
    </script>
    @yield('scriptjs')
    </body>
</html>
