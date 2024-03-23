<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlay-scrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  @stack('styles')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('Admin::layouts.navbar')

  @include('Admin::layouts.sidebar')

  @yield('content')

  @include('Admin::layouts.footer')
</div>
<!-- ./wrapper -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/overlay-scrollbars/js/overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<script src="{{ asset('plugins/mousewheel/mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/mapael/mapael.min.js') }}"></script>
<script src="{{ asset('plugins/chartjs/chart.min.js') }}"></script>
@stack('scripts')
</body>
</html>
