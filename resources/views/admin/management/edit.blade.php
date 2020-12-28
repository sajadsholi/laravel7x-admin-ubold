@extends('admin.master')
@section('title')
@lang('common.editAdmin') - {{ $admin->fullname }}
@endsection
@section('content')


<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                @if (auth()->guard('admin')->id() == 1)
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'></h4>
                    </div>
                    <div class='col-md-6 text-right'>
                        <a href='{{ route('admin.management.index') }}'
                            class='btn btn-orange'>@lang('common.archive')</a>
                    </div>
                </div>
                @endif
                <form action='{{ route('admin.management.update' , $admin) }}' method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate
                    oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>

                        {{-- firstname --}}
                        <div class='col-md-6'>
                            <div class='form-group mb-3'>
                                <label for='firstname'>
                                    @lang('common.firstname')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='firstname' placeholder='firstname'
                                    name='firstname' value="{{ old('firstname' , $admin->firstname) }}"
                                    title="@lang('common.required')" required>
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
                                    name='lastname' value="{{ old('lastname' , $admin->lastname) }}"
                                    title="@lang('common.required')" required>
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
                                    value="{{ old('contact_number' , $admin->contact_number) }}"
                                    title="@lang('common.numeric')">
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        @if ($admin->id != 1 && auth()->guard('admin')->id() == 1)
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
                                    <option value='' disabled></option>
                                    @foreach($roles as $item)
                                    <option value="{{ $item->id }}" @if(old('role_id' , $admin->role_id)==$item->id)
                                        selected
                                        @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- username --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='username'>
                                    @lang('common.username')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='username' placeholder='username'
                                    name='username' value="{{ old('username' , $admin->username) }}"
                                    title="@lang('common.required') <br/> @lang('common.unique')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        <span class="p-2">
                            <span class='text-warning'>*</span>
                            @lang('common.passwordNote')
                        </span>

                        {{-- password --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='password'>
                                    @lang('common.password')
                                </label>
                                <div class="input-group">
                                    <input type='password' class='form-control' id='password' placeholder='password'
                                        name='password' value="{{ old('password') }}" minlength="8"
                                        title="@lang('common.min8')">
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
                                </label>
                                <div class="input-group">
                                    <input type='password' class='form-control' id='password_confirmation'
                                        placeholder='password confirmation' name='password_confirmation' minlength="8"
                                        value="{{ old('password_confirmation') }}" title="@lang('common.confirmation')">
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
                        @atriatech_media_file('img', '{"name": "image", "placeholder": "{{ __("common.avatar") }} ({{ __("common.optional") }})","file":"{{ $admin->getMedium()->path ?? '' }}"}')
                        @atriatech_media_end

                    </div>

                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection