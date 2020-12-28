<meta charset="utf-8" />
<title>@yield('title' , 'Admin Panel')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="{{ $global->setting->sourceName }}" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- fav icon -->
<link rel="shortcut icon" href="{{ $global->assetPath }}/images/favicon.ico">
<!-- fav icon -->


{{-- specific --}}

@if (!empty($style))
@foreach ($style as $item)
<link href="{{ asset('asset') }}/admin/{{$item}}?ver={{ $ver }}" rel="stylesheet" type="text/css" />
@endforeach
@endif

{{-- specific --}}




{{-- common css --}}
<link href="{{ asset('asset') }}/admin/libs/flatpickr/dist/flatpickr.min.css?ver={{ $ver }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('asset') }}/admin/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('asset') }}/admin/libs/sweetalert2/sweetalert2.min.css?ver={{ $ver }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('asset') }}/admin/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
<link href="{{ $global->assetPath }}/css/bootstrap.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
<link href="{{ $global->assetPath }}/css/icons.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
<link href="{{ $global->assetPath }}/css/app.min.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('asset') }}/admin/libs/x-editable/css/bootstrap-editable.css?ver={{ $ver }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('asset') }}/admin/libs/toaster/build/toastr.min.css?ver={{ $ver }}" rel="stylesheet" />
{{-- common css --}}

<link href="{{ asset('asset') }}/admin/css/common.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('asset') }}/admin/css/form-wizard.css?ver={{$ver}}" rel="stylesheet" type="text/css" />
@atriatech_media('css')