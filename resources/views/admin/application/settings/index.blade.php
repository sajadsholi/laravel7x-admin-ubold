@extends('admin.master')
@section('title')
@lang('applicationSettings.singular')
@endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                @foreach ($devices as $item)
                <li class="nav-item">
                    <a href="#tab{{$item->id}}" data-toggle="tab" aria-expanded="false"
                        class="nav-link {{ ($item->id == 1) ? 'active' : '' }}">
                        {{ $item->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach ($devices as $item)
                <div class="tab-pane {{ ($item->id == 1) ? 'active' : '' }}" id="tab{{ $item->id }}">

                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='card'>
                                <div class='card-body'>
                                    <form method='POST' enctype='application/x-www-form-urlencoded'
                                        class='needs-validation' novalidate>
                                        @csrf
                                        <div class='form-row justify-content-start'>
                                            {{-- update message --}}
                                            <div class='col-md-12'>
                                                <div class='form-group mb-3'>
                                                    <label for='update_message_{{ $item->name }}'>
                                                        @lang('applicationSettings.field.update_message')
                                                        <span class='text-danger'>*</span>
                                                    </label>
                                                    <input type='text' class='form-control'
                                                        id='update_message_{{ $item->name }}'
                                                        placeholder='Update Message {{ $item->name }}'
                                                        name='update_message'
                                                        value="{{ (!empty($item->application_setting->update_message)) ? $item->application_setting->translateOrDefault($global->adminDataLocale)->update_message : '' }}"
                                                        title="@lang('common.required')" required>
                                                    <div class='invalid-feedback'>
                                                        @lang('common.invalid-feedback')
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- current version --}}
                                            <div class='col-md-6'>
                                                <div class='form-group mb-3'>
                                                    <label for='current_version_{{ $item->name }}'>
                                                        @lang('applicationSettings.field.current_version')
                                                        <span class='text-danger'>*</span>
                                                    </label>
                                                    <input type='number' class='form-control'
                                                        id='current_version_{{ $item->name }}'
                                                        placeholder='Current Version {{ $item->name }}'
                                                        name='current_version'
                                                        value="{{ $item->application_setting->current_version ?? '' }}"
                                                        title="@lang('common.required') <br/> @lang('common.numeric')"
                                                        min="1"
                                                        step="1"
                                                        required>
                                                    <div class='invalid-feedback'>
                                                        @lang('common.invalid-feedback')
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                            if(!empty($item->application_setting->update_method)){
                                            $update_method = $item->application_setting->update_method;
                                            }else{
                                            $update_method = 0;
                                            }
                                            @endphp

                                            {{-- update method --}}
                                            <div class='col-md-6'>
                                                <div class='form-group mb-3'>
                                                    <label for='update_method_{{ $item->name }}'>
                                                        @lang('applicationSettings.field.update_method')
                                                        <span class='text-danger'>*</span>
                                                    </label>
                                                    <select class='custom-select' id='update_method_{{ $item->name }}'
                                                        name='update_method' title="@lang('common.required')"
                                                        data-toggle="tooltip" data-trigger="force" required>
                                                        <option value='' disabled selected class="d-none">
                                                            @lang('common.select')
                                                        </option>
                                                        <option value='1' {{ ($update_method == 1) ? 'selected' : '' }}>
                                                            @lang('applicationSettings.updateMethod.none')
                                                        </option>
                                                        <option value='2' {{ ($update_method == 2) ? 'selected' : '' }}>
                                                            @lang('applicationSettings.updateMethod.optional')
                                                        </option>
                                                        <option value='3' {{ ($update_method == 3) ? 'selected' : '' }}>
                                                            @lang('applicationSettings.updateMethod.forced')
                                                        </option>
                                                    </select>
                                                    <div class='invalid-feedback'>
                                                        @lang('common.invalid-feedback')
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- link --}}
                                            <div class='col-md-6'>
                                                <div class='form-group mb-3'>
                                                    <label for='link_{{ $item->name }}'>
                                                        @lang('applicationSettings.field.link')
                                                        <span class='text-danger'>*</span>
                                                    </label>
                                                    <input type='url' class='form-control' id='link_{{ $item->name }}'
                                                        placeholder='Link {{ $item->name }}' name='link'
                                                        value="{{ $item->application_setting->link ?? '' }}"
                                                        title="@lang('common.required') <br/> @lang('common.validUrl')"
                                                        required>
                                                    <div class='invalid-feedback'>
                                                        @lang('common.invalid-feedback')
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- direct link --}}
                                            <div class='col-md-6'>
                                                <div class='form-group mb-3'>
                                                    <label for='direct_link_{{ $item->name }}'>
                                                        @lang('applicationSettings.field.direct_link')
                                                    </label>
                                                    <input type='url' class='form-control'
                                                        id='direct_link_{{ $item->name }}'
                                                        placeholder='Direct link {{ $item->name }}' name='direct_link'
                                                        value="{{ $item->application_setting->direct_link ?? '' }}"
                                                        title="@lang('common.validUrl')">
                                                    <div class='invalid-feedback'>
                                                        @lang('common.invalid-feedback')
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- device id --}}
                                            <input name="device_id" type="hidden" value="{{ $item->id }}">
                                        </div>
                                        <button class='btn btn-orange' type='submit'>@lang('common.submit')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>



@endsection