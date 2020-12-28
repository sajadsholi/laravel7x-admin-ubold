<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->adminDirection }}" mode="{{ $global->adminMode }}">
@php
$ver = '1.0.2';
@endphp

<head>
    @include('admin.layout.header')
</head>

<body class="left-side-menu-{{ $global->adminMode }}">

    <p id="baseRoot" class="d-none">{{ URL::to('/') }}</p>

    {{-- Pre loader --}}
    <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
    {{-- Pre loader --}}


    <div id="wrapper">

        {{-- navbar --}}
        @include('admin.layout.navbar')
        {{-- navbar --}}

        <div class="left-side-menu">

            <div class="slimscroll-menu">

                {{-- sidebar --}}
                @include('admin.layout.sidebar')
                {{-- sidebar --}}

                <div class="clearfix"></div>

            </div>

        </div>

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    {{-- breadcrumb --}}
                    @include('admin.layout.breadcrumb')
                    {{-- breadcrumb --}}

                    {{-- content --}}
                    @yield('content' , '')
                    {{-- content --}}
                </div>

            </div>

        </div>

        {{-- source info --}}
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2013 - {{ date('Y') }} &copy;<a href="{{ $global->setting->sourceLink }}" target="_blanck"
                            class="text-blue" id="source_info">{{ $global->setting->sourceName }}</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="{{ $global->setting->sourceAboutLink }}" target="_blanck"
                                class="mx-2">@lang('aboutUs.singular')</a>
                            <a href="{{ $global->setting->sourceContactLink }}" target="_blanck"
                                class="mx-2">@lang('contactUs.singular')</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        {{-- source info --}}

    </div>

    </div>

    {{-- right sidebar --}}
    @include('admin.layout.rightSidebar')
    {{-- right sidebar --}}

    <div class="rightbar-overlay"></div>

    {{-- footer --}}
    @include('admin.layout.footer')
    {{-- footer --}}
</body>

</html>