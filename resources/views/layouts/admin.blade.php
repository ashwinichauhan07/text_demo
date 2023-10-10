<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App Name - @yield('title')</title>

    <link href="{{ url('public/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ url('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>

    <!-- Fonts -->

    <link rel="stylesheet" href="{{ url('public/css/css2.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/select2.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('public/css/app.css') }}">

    <link rel="stylesheet" href="{{ url('public/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ url('public/css/fontawesome-free-6.0.0-web/css/all.min.css') }}">


    <script src="{{ url('public/assets/js/bed09b7a7a.js') }}"></script>

    <script src="{{ url('public/assets/js/select2.min.js') }}"></script>


    <script src="{{ url('public/js/scripts.js') }}"></script>

    <script src="{{ url('public/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('public/js/jquery-3.5.1.slim.min.js') }}"></script>


   <script src="{{ url('public/assets/js/jquery.dataTables.min.js') }}"></script>

   <script src="{{ url('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>

   <script src="{{ url('public/js/bootstrap.bundle.min.js') }}"></script>


    @livewireStyles

    <!-- Scripts -->
    <script src="{{ url('public/js/app.js') }}" defer></script>

</head>
<body class="sb-nav-fixed">


	@section('sidebar')

		@include('includes.topbar')

		@include('includes.topbar_menu')

		@include('includes.sidebar')

        {{--  @include('includes.sidemenu')  --}}


    @show


	<div id="layoutSidenav_content">

        @yield('content')

        @include('includes.footer')

    </div>




    </body>
    @stack('scripts')
    @livewireScripts
</html>
