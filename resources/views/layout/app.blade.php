<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-layout="vertical"
      data-topbar="dark"
      data-sidebar="dark"
      data-sidebar-size="lg"
      data-sidebar-image="img-2"
      data-preloader="enable">
<head>
    @include('layout.includes.head')
</head>
<body>
<div class="layout-wrapper">

    @include('layout.includes.header')
    @include('layout.includes.sidebar')
    <div class="main-content">
        <div class="page-content">
            @yield('content')
        </div>
        @yield('modals')
        @include('layout.includes.footer')
    </div>
</div>

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@include('layout.includes.foot')
@stack('js')
</body>
</html>
