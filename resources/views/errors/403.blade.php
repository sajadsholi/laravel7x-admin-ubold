@if (empty($global))

@php
$extend = 'errors.master';
@endphp

@elseif(Request::is('admin*'))

@php
$extend = 'admin.master';
@endphp

@elseif(!Request::is('admin*'))

@php
$extend = 'web.master';
@endphp

@endif

@extends($extend)

@section('title')
403 - Forbidden Error
@endsection


@section('content')
<div class="text-center w-100">

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_oW1W5H.json" background="transparent" speed="1"
        style="width: 600px; height: 300px; margin:10px auto;" loop autoplay>
    </lottie-player>

    <h4>
        @lang('common.403')
    </h4>
    @if (Request::is('admin*'))

    <a class="btn btn-primary btn-block w-25 mt-3 mx-auto" href="{{ route('admin.dashboard.index') }}">
        @lang('common.dashboard')
    </a>

    @else

    <a class="btn btn-primary btn-block w-25 mt-3 mx-auto" href="{{ route('web.home.index') }}">
        @lang('common.home')
    </a>

    @endif
</div>
@endsection