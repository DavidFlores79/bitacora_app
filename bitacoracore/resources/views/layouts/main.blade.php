<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="@yield('ngApp')">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hope') }} | @yield('page-title')</title>

    <!-- Favicon -->
    <link href="{{ asset('assets') }}/img/brand/favicon.png" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet" type="text/css" > --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap-4.6.1/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('assets') }}/css/bootstrap-select-1.13.14/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/ng-table.min.css" rel="stylesheet">

    <!-- AngularJS -->
    <script src="{{ asset('assets') }}/js/angular-1.8.2/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets') }}/js/sweetalert2.1.2/sweetalert.min.js"></script>

    <!-- Constants JS -->
    <script src="{{ asset('assets') }}/js/constantes.js"></script>

    <!-- Loading  -->
    <link href="{{ asset('assets') }}/css/loading.css" rel="stylesheet">

    <!-- DatePicker -->
    <link href="{{ asset('assets') }}/css/jquery-ui-1.13.1/jquery-ui.css" rel="stylesheet">

    <!-- Animaciones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Other -->
    <link href="{{ asset('assets') }}/css/ng-table.min.css" rel="stylesheet">
    @yield('styles')

    <!-- main CSS -->
    <link type="text/css" href="{{ asset('assets') }}/css/main.css" rel="stylesheet">

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "471d2d5f-4105-476e-a74d-68bf9277053e",
            });
        });

        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
            if (isEnabled) {
                // user has subscribed
                OneSignal.getUserId(function(userId) {
                    console.log('player_id of the subscribed user is : ' + userId);
                    // Make a POST call to your server with the user ID        
                });
            }
        });
    </script>




</head>

<!-- Imagen de fondo para el login -->
<style>
    #fondo {
        background-image: url("{{ asset('assets/img/login.jpg') }}");
    }
</style>

<body ng-controller="@yield('ngController')" class="{{ $class ?? '' }}">


    @auth()
    <!-- Cerrar Sesión de usuario -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <!-- Barra Lateral -->
    @include('layouts.navbars.sidebar')
    @endauth

    <div class="main-content">

        <!-- Navbar -->
        @auth()
        @include('layouts.navbars.navs.auth')
        @endauth

        @guest()
        @include('layouts.navbars.navs.guest')
        @endguest

        <!-- Contenido -->
        @yield('content')

    </div>


    <!-- Footer -->
    @auth()
    @include('layouts.footers.auth')
    @endauth

    @guest()
    @include('layouts.footers.guest')
    @endguest

    <!-- scripts -->
    <script src="{{ asset('assets') }}/js/jquery-3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap-4.6.1/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/dirPagination.js"></script>
    <script src="{{ asset('assets') }}/js/ng-table.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap-select-1.13.14/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>

    {{--
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery-ui-1.13.1/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.serializejson.js') }}"></script>
    <script src="{{ asset('assets/js/fontawesome/all.min.js') }}"></script>
    --}}

    <!-- Angular File -->
    @yield('ngFile')

    <!-- Scripts Personalizados -->
    @stack('js')


</body>

</html>