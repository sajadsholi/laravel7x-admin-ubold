@extends('admin.master')
@section('title')
@lang('common.add') @lang('businessCategory.singular')
@endsection
@section('content')

<div class="col-sm-12 col-sm-offset-2 form-wizard">
    <div class="wizard-container">
        <div class="card wizard-card" data-color="orange" id="wizard">
            <form action="{{ route('admin.businessCategory.store') }}" method="POST">
                @csrf

                {{-- tabs --}}
                <div class="wizard-navigation mt-3">
                    <ul>
                        <li><a href="#generalInformation" data-toggle="tab">@lang('common.generalInformation')</a></li>
                        <li><a href="#seo" data-toggle="tab">@lang('common.seo')</a></li>
                    </ul>
                </div>
                {{-- content --}}
                <div class="tab-content">
                    <div class="tab-pane" id="generalInformation">
                        <div class="row">
                            {{-- name --}}
                            <div class='col-md-6'>
                                <div class='form-group mb-3'>
                                    <label class='text-capitalize' for='name'>
                                        @lang('businessCategory.field.name')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input type='text' class='form-control baseName' id='name' placeholder='name'
                                        name='name' value="{{ old('name') }}" title="@lang('common.required')" required
                                        autofocus>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>

                            {{-- link --}}
                            <div class='col-md-6'>
                                <div class='form-group mb-3'>
                                    <label class='text-capitalize' for='link'>
                                        @lang('businessCategory.field.link')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input type='text' class='form-control convertNameToLink' id='link'
                                        placeholder='link' name='link' value="{{ old('link') }}"
                                        data-can="addBusinessCategory" data-model="BusinessCategoryTranslation"
                                        data-action="create"
                                        title="@lang('common.required') <br/> @lang('common.unique')" required>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>

                            {{-- image --}}
                            <div class="col-md-4">
                                @atriatech_media_start
                                @atriatech_media_file('img', '{"name": "image", "placeholder": "{{ __("common.image") }} ({{ __("common.required") }})","file":""}')
                                @atriatech_media_end
                            </div>

                        </div>
                    </div>


                    <div class="tab-pane" id="seo">
                        <div class="row">
                            {{-- meta_title --}}
                            <div class='col-md-12'>
                                <div class='form-group mb-3'>
                                    <label class='text-capitalize' for='meta_title'>
                                        @lang('businessCategory.field.meta_title')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input type='text' class='form-control' id='meta_title' placeholder='title'
                                        name='meta_title' value="{{ old('meta_title') }}"
                                        title="@lang('common.required')" required>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                            {{-- meta_keywords --}}
                            <div class='col-md-12'>
                                <div class='form-group mb-3'>
                                    <label for='meta_keywords'>
                                        @lang('businessCategory.field.meta_keywords')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <select class='form-control keywords-select' id='meta_keywords'
                                        name='meta_keywords[]' title="@lang('common.required')"
                                        data-placeholder="@lang('common.select')" multiple='multiple' required>
                                        @if (!empty(old('meta_keywords')))
                                        @foreach (old('meta_keywords') as $keyword)
                                            <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                            {{-- meta_description --}}
                            <div class='col-md-12'>
                                <div class='form-group mb-3'>
                                    <label for='meta_description'>
                                        @lang('businessCategory.field.meta_description')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <textarea class='form-control' id='meta_description' placeholder='description'
                                        name='meta_description' title="@lang('common.required')" rows='5' cols='5'
                                        required>{{ old('meta_description') }}</textarea>
                                    <div class='invalid-feedback'>
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="wizard-btn-fab row">
                    <div class="pull-left col-sm-6">
                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous'
                            value="@lang('common.previous')" />
                    </div>
                    <div class="pull-right col-sm-6 text-right">
                        <input type='button' class='btn btn-next btn-fill btn-orange btn-wd' name='next'
                            value="@lang('common.next')" />
                        <input type='submit' class='btn btn-finish btn-fill btn-orange btn-wd' name='finish'
                            value="@lang('common.submit')" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection