<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @include('auth.layout.includes.head')
</head>
<body>
<div class="auth-page-wrapper pt-5">

    <header>
        @include('auth.layout.includes.header')
    </header>
    <div>
        @yield('content')
    </div>
    <footer>
        @include('auth.layout.includes.footer')
    </footer>
</div>
@include('auth.layout.includes.foot')
</body>
</html>
