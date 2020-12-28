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
503 - Service Unavailable
@endsection


@section('content')
<div class="text-center w-100">

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_Nlkimv.json" background="transparent" speed="1"
        style="width: 500px; height: 250px; margin:10px auto;" loop autoplay>
    </lottie-player>

    <h4>
        Server is temporarily unable to handle the request
    </h4>
</div>
@endsection