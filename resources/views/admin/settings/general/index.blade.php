@extends('admin.master')
@section('title')
@lang('common.generalSettings')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <form method='POST' enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='name'>
                                    @lang('common.websiteName')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name' , $global->setting->name) }}" title="@lang('common.required')"
                                    required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- logo --}}
                        @atriatech_media_start
                        @atriatech_media_file('img', '{"name": "image", "placeholder": "{{ __("common.logo") }} ({{ __("common.required") }})","file":"{{ $global->setting->logo->path ?? '' }}"}')
                        @atriatech_media_end

                    </div>
                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection