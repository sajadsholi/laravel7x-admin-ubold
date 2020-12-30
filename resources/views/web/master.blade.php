<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->webDirection }}">
@php
$ver = '1.0.0';
@endphp

<head>
    @include('web.layout.header')
</head>

<body>

    {{-- content --}}
    @yield('content' , '')
    {{-- content --}}

    {{-- footer --}}
    @include('web.layout.footer')
    {{-- footer --}}
</body>

</html>