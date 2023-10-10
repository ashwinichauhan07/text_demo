<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>App Name - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="public/assets/fonts/line-icons.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/slicknav.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/color-switcher.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/animate.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/owl.carousel.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/main.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/responsive.css">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <link rel="stylesheet" href="{{ url('public/css/font-awesome.min.css') }}">


</head>

<body>
        @section('sidebar')

            @include('includes.main.topbar')

            @include('includes.main.top_nav')



            </header>

        @show


            @yield('content')




            @include('includes.main.footer')




    </body>

    @stack('scripts')

    <script src="assets/js/jquery-min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/contact-form-script.min.js"></script>
    <script src="assets/js/summernote.js"></script>
    <script src="{{ url('public/assets/js/bed09b7a7a.js') }}"></script>


</html>
