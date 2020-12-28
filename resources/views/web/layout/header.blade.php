<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title' , env('APP_NAME'))</title>

{{-- load common css here --}}

{{-- <link  href="{{ asset('asset') }}/web/css/app.css?ver={{ $ver }}" rel="stylesheet" type="text/css"> --}}



{{-- load common css here --}}

{{-- load specific css here --}}
@isset($style)
@foreach ($style as $item)
<link href="{{ asset('asset') }}/web/css/{{$item}}?ver={{ $ver }}" rel="stylesheet" type="text/css" />
@endforeach
@endisset
{{-- load specific css here --}}