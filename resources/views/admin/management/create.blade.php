@extends('admin.master')
@section('title')
@lang('common.createAdmin')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'></h4>
                    </div>
                    <div class='col-md-6 text-right'>
                        <a href='{{ route('admin.management.index') }}'
                            class='btn btn-orange'>@lang('common.archive')</a>
                    </div>
                </div>
                <form action='{{ route('admin.management.store') }}' method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate
                    oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>

                        {{-- firstname --}}
                        <div class='col-md-6'>
                            <div class='form-group mb-3'>
                                <label for='firstname'>
                                    @lang('common.firstname')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='firstname' placeholder='firstname'
                                    name='firstname' value="{{ old('firstname') }}" title="@lang('common.required')"
                                    required autofocus>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- lastname --}}
                        <div class='col-md-6'>
                            <div class='form-group mb-3'>
                                <label for='lastname'>
                                    @lang('common.lastname')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='lastname' placeholder='lastname'
                                    name='lastname' value="{{ old('lastname') }}" title="@lang('common.required')"
                                    required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- contact_number --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='contact_number'>
                                    @lang('common.contact_number')
                                </label>
                                <input type='number' class='form-control' id='contact_number'
                                    placeholder='contact number' name='contact_number'
                                    value="{{ old('contact_number') }}" title="@lang('common.numeric')" min="0"
                                    step="1">
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- role id --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='role_id'>
                                    @lang('common.role')
                                    <span class='text-danger'>*</span>
                                </label>
                                <select class='custom-select select2' id='role_id' name='role_id'
                                    title="@lang('common.required')"
                                    data-placeholder="@lang('common.select') @lang('common.role')" required>
                                    <option value='' disabled selected></option>
                                    @foreach($roles as $item)
                                    <option value="{{ $item->id }}" @if(old('role_id')==$item->id) selected
                                        @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- username --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='username'>
                                    @lang('common.username')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='username' placeholder='username'
                                    name='username' value="{{ old('username') }}"
                                    title="@lang('common.required') <br/> @lang('common.unique')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- password --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='password'>
                                    @lang('common.password')
                                    <span class='text-danger'>*</span>
                                </label>
                                <div class="input-group">
                                    <input type='password' class='form-control' id='password' placeholder='password'
                                        name='password' value="{{ old('password') }}" minlength="8"
                                        title="@lang('common.required') <br/> @lang('common.min8')" required>
                                    <div class="input-group-append">
                                        <span toggle="#password" class="toggle-password input-group-text pointer">
                                            <i class="fa fa-fw fa-eye field-icon"></i>
                                        </span>
                                    </div>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- password_confirmation --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='password_confirmation'>
                                    @lang('common.password_confirmation')
                                    <span class='text-danger'>*</span>
                                </label>
                                <div class="input-group">
                                    <input type='password' class='form-control' id='password_confirmation'
                                        placeholder='password confirmation' name='password_confirmation' minlength="8"
                                        value="{{ old('password_confirmation') }}"
                                        title="@lang('common.required') <br/> @lang('common.confirmation')" required>
                                    <div class="input-group-append">
                                        <span toggle="#password_confirmation"
                                            class="toggle-password input-group-text pointer">
                                            <i class="fa fa-fw fa-eye field-icon"></i>
                                        </span>
                                    </div>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- avatar --}}
                        @atriatech_media_start
                        @atriatech_media_file('img', '{"name": "image", "placeholder": "{{ __("common.avatar") }} ({{ __("common.optional") }})","file":""}')
                        @atriatech_media_end


                    </div>

                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection