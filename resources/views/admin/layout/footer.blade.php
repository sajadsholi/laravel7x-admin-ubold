{{-- show error --}}
@if ($errors->any())
<div id="failed-msg" class="d-none">
    @foreach ($errors->all() as $error)
    <p class="my-2">{{ $error }}</p>
    @endforeach
</div>
@endif

@if (Session::has('success'))
<p id="success-msg" class="d-none">
    @if (is_numeric(Session::get('success')))
    @lang('common.successMsg')
    @else
    {{ Session::get('success') }}
    @endif
</p>
@endif

@if (Session::has('info'))
<p id="info-msg" class="d-none">
    {{ Session::get('info') }}
</p>
@endif
{{-- show error --}}


{{-- send notification to admin --}}
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-functions.js"></script>
{{-- send notification to admin --}}


{{-- common js --}}
<script src="{{ $global->assetPath }}/js/vendor.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/flatpickr/dist/flatpickr.min.js?ver={{ $ver }}"></script>
@if (config('app.locale') == 'fa')
<script src="{{ asset('asset') }}/admin/libs/flatpickr/jdate.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/flatpickr/dist/l10n/fa.js?ver={{ $ver }}"></script>
@endif
<script src="{{ asset('asset') }}/admin/libs/select2/select2.min.js"></script>
<script src="{{ asset('asset') }}/admin/libs/sweetalert2/sweetalert2.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/jquery-toast/jquery.toast.min.js"></script>
<script src="{{ $global->assetPath }}/js/pages/toastr.init.js"></script>
<script src="{{ $global->assetPath }}/js/app.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/x-editable/js/bootstrap-editable.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/toaster/build/toastr.min.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/libs/ckeditor/ckeditor.js?ver={{ $ver }}"></script>

{{-- common js --}}

{{-- specific js --}}
@if(!empty($script))
@foreach ($script as $item)
<script src="{{ asset('asset') }}/admin/{{$item}}?ver={{ $ver }}"></script>
@endforeach
@endif
{{-- specific js --}}


<script src="{{ asset('asset') }}/admin/js/common.js?ver={{ $ver }}"></script>
<script src="{{ asset('asset') }}/admin/js/form-wizard.js?ver={{ $ver }}"></script>

<script src="{{ route('assets.lang') }}?ver={{ $ver }}"></script>
{{-- config notification for admin --}}
@if(env('APP_ENV') == 'production')
<script src="{{ asset('asset') }}/admin/js/adminNotification.js?ver={{ $ver }}"></script>
@endif
{{-- config notification for admin --}}
<script src="{{ asset('asset') }}/admin/libs/lozad/lozad.js?ver={{ $ver }}"></script>
@atriatech_media('js')