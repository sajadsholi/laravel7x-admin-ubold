{{-- load common js here --}}

{{-- <script src="{{ asset('asset') }}/web/js/jquery.js?ver={{ $ver }}"></script> --}}
{{-- <script src="{{ asset('asset') }}/web/js/app.js?ver={{ $ver }}"></script> --}}


{{-- load common js here --}}

{{-- load specific js here --}}
@isset($script)
@foreach ($script as $item)
<script src="{{ asset('asset') }}/web/js/{{$item}}?ver={{ $ver }}"></script>
@endforeach
@endisset
{{-- load specific js here --}}