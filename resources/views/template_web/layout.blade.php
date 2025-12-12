<!doctype html>
<html lang="zxx">
@php
    $profil = \App\Models\Profil::first();
@endphp
<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home - {{ $profil->nama_perusahaan }}</title>

    <link rel="shortcut icon" href="{{ asset('web') }}/assets/img/favicon.png" type="images/x-icon"/>

    <!-- css include -->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/animate.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/metisMenu.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/uikit.min.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/slick.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/main.css">
</head>

<body>

    <div class="body_wrap">

        <!-- preloder start  -->
        <div class="preloder_part">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
        <!-- preloder end  -->

        <!-- back to top start -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
        <!-- back to top end -->

    @include('template_web.header')
    @include('template_web.side')

        <div class="body-overlay"></div>
        <!-- slide-bar end -->

@yield('content')

        <!-- footer start -->
        @include('template_web.footer')
        <!-- footer end -->

        @include('template_web.popup')



    </div>

    <!-- jquery include -->
    <script src="{{ asset('web') }}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/slick.js"></script>
    <script src="{{ asset('web') }}/assets/js/backToTop.js"></script>
    <script src="{{ asset('web') }}/assets/js/uikit.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/resize-sensor.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/theia-sticky-sidebar.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/jqueryui.js"></script>
    <script src="{{ asset('web') }}/assets/js/touchspin.js"></script>
    <script src="{{ asset('web') }}/assets/js/countdown.js"></script>
    <script src="{{ asset('web') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/metisMenu.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/main.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @yield('script')
</body>

</html>
