<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf_token" value="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->

    {{-- <link href="/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="/assets/css/app-rtl.min.css?v={{ Str::random(10) . rand(1, 1000) }}" rel="stylesheet"type="text/css" /> --}}
    {{-- <link href="/assets/css/style.css?v={{ Str::random(10) . rand(1, 1000) }}" rel="stylesheet" type="text/css" /> --}}


    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->

    @yield('css')

</head>


<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('dashbord.layouts.navbar')

        @include('dashbord.layouts.sidebare')

        <div class="main-content p-2 mb-3">

            @yield('content')

        </div>
        <!-- end main content-->


        <footer class="footer bg-primary bg-soft ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © {{ env('APP_NAME') }}.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">

                        </div>
                    </div>
                </div>
            </div>
        </footer>


    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>
    @yield('js')
    <!-- App js -->
    <script src="/assets/js/app.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>




</body>

</html>
