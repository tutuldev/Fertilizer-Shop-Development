<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('backend/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        {{--top nav start  --}}
        @include('backend.inc.topnav')
        {{-- top nav end  --}}

        {{-- yiend content start --}}
<div id="layoutSidenav">
    {{-- sidenav start  --}}
    @include('backend.inc.sidenav')
    {{-- sidenav end  --}}
    {{-- content around top & sidenav  start --}}
    <div id="layoutSidenav_content">
        {{-- main contant start --}}
       @yield('content')
        {{--main content end  --}}
        @include('backend.inc.footer')
    </div>

    {{-- content around topnav & sidenav end  --}}
</div>
{{-- yiend content end  --}}

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{asset('backend/assets/demo/chart-bar-demo.js') }}"></script>
        <script src="{{asset('backend/assets/demo/chart-pie-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/js/datatables-simple-demo.js') }}"></script>
    </body>
</html>
