@extends('admin.master')
@section('title')
@lang('aboutUs.singular')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <form method='POST' enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- content --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for='content'>
                                            @lang('aboutUs.singular')
                                            <span class='text-danger'>*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @if (!empty($about))
                                        <x-selectLanguage :translation="$about->translations"
                                            redirect="{{ route('admin.about.index') }}" />
                                        @endif
                                    </div>
                                </div>
                                <textarea class='form-control ck-editor' id='content' placeholder='content'
                                    name='content' rows="5" cols="5" data-toggle="tooltip"
                                    title="@lang('common.required')"
                                    required>@if (!empty($about)){!! $about->translateOrDefault($global->adminDataLocale)->content !!}@else{!! old('content') !!}@endif</textarea>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class='btn btn-orange' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection