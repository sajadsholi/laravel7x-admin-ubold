<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->adminDirection }}">
@php
$ver = '1.0.0';
@endphp

<head>
    <meta charset="utf-8" />
    <title>Admin Panel - Locked</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ $global->setting->sourceName }}" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $global->assetPath }}/images/favicon.ico">

    <!-- App css -->
    <link href="{{ $global->assetPath }}/css/bootstrap.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
    <link href="{{ $global->assetPath }}/css/icons.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
    <link href="{{ $global->assetPath }}/css/app.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('asset') }}/admin/css/common.css?ver={{$ver}}" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <a href="index.html">
                                    <span><img src="{{ $global->setting->logo->path ?? $global->defaultLogo }}"
                                            title="{{ $global->setting->name ?? '' }}"
                                            alt="{{ $global->setting->name ?? '' }}" height="80"></span>
                                </a>
                            </div>

                            <div class="text-center w-75 m-auto">
                                <img src="{{ $global->userAvatar->path ?? $global->defaultAvatar }}" height="88"
                                    alt="user-image" class="rounded-circle shadow">
                                <h4 class="text-dark-50 text-center mt-3">{{ Auth::guard('admin')->user()->fullname }}
                                </h4>
                                <p class="text-muted mb-4">@lang('common.unlockTitle')</p>
                            </div>


                            <form action="{{ route('admin.unlock') }}" method="POST">
                                @csrf
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
                                    <button class="btn btn-primary btn-block"
                                        type="submit">@lang('common.unlock')</button>
                                </div>

                            </form>

                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    {{ $global->setting->sourceStartYear ?? '' }} - {{ date('Y') }} &copy;<a
                                        class="text-blue"
                                        href="{{ $global->setting->sourceLink ?? 'javascript:void(0);' }}"
                                        target="_blanck">{{ $global->setting->sourceName ?? '' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ $global->assetPath }}/js/vendor.min.js?ver={{$ver}}"></script>
    <script src="{{ $global->assetPath }}/js/app.min.js?ver={{$ver}}"></script>

    <script src="{{ asset('asset') }}/admin/js/adminLogin.js?ver={{ $ver }}"></script>

</body>

</html>