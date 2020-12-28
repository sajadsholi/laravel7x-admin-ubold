<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->dir }}" mode="{{ $global->mode }}">
@php
$ver = "0.0.1";
@endphp

<head>
    <meta charset="utf-8" />
    <title>Admin Panel - login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin which can be used to build CRM, CMS, etc." name="description" />
    <meta content="{{ $global->setting->sourceName }}" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $global->assetPath }}/images/favicon.ico">

    <!-- App css -->
    <link href="{{ $global->assetPath }}/css/bootstrap.min.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />
    <link href="{{ $global->assetPath }}/css/icons.min.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />
    <link href="{{ $global->assetPath }}/css/app.min.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('asset') }}/admin/css/common.css?ver={{$ver}}" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-100 m-auto">
                                <a href="index.html">
                                    <span><img src="{{ $global->setting->logo->path ?? $global->defaultLogo }}"
                                            title="{{ $global->setting->name ?? '' }}"
                                            alt="{{ $global->setting->name ?? '' }}" height="80"></span>
                                </a>
                                <p class="text-muted mb-4 mt-3">@lang('common.loginPageTitle')</p>
                            </div>

                            <form method="POST">
                                @csrf
                                {{-- username --}}
                                <div class="form-group mb-3">
                                    <label for="username">@lang('common.username')</label>
                                    <input class="form-control" type="text" name="username" id="username" required
                                        value="{{ old('username') }}" placeholder="Enter username">
                                </div>

                                {{-- password --}}
                                <div class="form-group mb-3">
                                    <label for="password">@lang('common.password')</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" id="password"
                                            required placeholder="Enter your password">
                                        <div class="input-group-append">
                                            <span toggle="#password" class="toggle-password input-group-text pointer">
                                                <i class="fa fa-fw fa-eye field-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- remember me --}}
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember"
                                            name="remember" checked>
                                        <label class="custom-control-label"
                                            for="remember">@lang('common.rememberMe')</label>
                                    </div>
                                </div>

                                {{-- show the errors --}}
                                @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                    <p class="m-0">
                                        {!! $error !!}
                                    </p>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> @lang('common.login')
                                    </button>
                                </div>

                            </form>

                            <div class="text-center">
                                <h5 class="mt-3 text-muted">
                                    <a href="{{ $global->setting->sourceLink }}" target="_blank"
                                        class="text-blue">{{ $global->setting->sourceName }}</a>
                                    &copy; 2013 - {{ date('Y') }}</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor js -->
    <script src="{{ $global->assetPath }}/js/vendor.min.js?ver={{ $ver }}"></script>

    <!-- App js -->
    <script src="{{ $global->assetPath }}/js/app.min.js?ver={{ $ver }}"></script>

    {{-- specific js --}}
    <script src="{{ asset('asset') }}/admin/js/adminLogin.js?ver={{ $ver }}"></script>

</body>

</html>