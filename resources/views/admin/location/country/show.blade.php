@extends('admin.master')
@section('title')
@lang('common.edit') @lang('country.singular') - {{ $country->name }}
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title text-capitalize'></h4>
                    </div>
                    <div class='col-md-6 text-right'>
                        <a href="{{ route('admin.country.index') }}" class='btn btn-orange'>@lang('common.archive')</a>
                    </div>
                </div>
                <form action="{{ route('admin.country.update' , $country) }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-4'>
                            <div class='form-group mb-3'>
                                <label class="text-capitalize" for='name'>
                                    @lang('country.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name' , $country->name) }}" title="@lang('common.required')"
                                    required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- code --}}
                        <div class='col-md-4'>
                            <div class='form-group mb-3'>
                                <label class="text-capitalize" for='code'>
                                    @lang('country.field.code')
                                </label>
                                <input type='text' class='form-control' id='code' placeholder='code : IR , OM , ...'
                                    name='code' value="{{ old('code' , $country->code) }}">
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- phone_code --}}
                        <div class='col-md-4'>
                            <div class='form-group mb-3'>
                                <label class="text-capitalize" for='phone_code'>
                                    @lang('country.field.phone_code')
                                </label>
                                <input type='number' class='form-control' id='phone_code'
                                    placeholder='phone code : 98 , 968 , ...' name='phone_code'
                                    value="{{ old('phone_code' , $country->phone_code) }}"
                                    title="@lang('common.numeric')">
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- avatar --}}
                        @atriatech_media_start
                        @atriatech_media_file('flag', '{"name": "image", "placeholder": "{{ __("country.other.flag") }} ({{ __("common.required") }})","file":"{{ $country->getMedium()->path ?? '' }}"}')
                        @atriatech_media_end

                    </div>
                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection