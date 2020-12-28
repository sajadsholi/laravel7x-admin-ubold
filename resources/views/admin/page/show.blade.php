@extends('admin.master')
@section('title')
@lang('common.edit') @lang('page.singular')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'>
                        </h4>
                    </div>
                    <div class='col-md-6 text-right'>
                        <a href="{{ route('admin.page.index') }}" class='btn btn-orange'>@lang('common.archive')</a>
                    </div>
                </div>
                <form action="{{ route('admin.page.update' , $page) }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='name'>
                                    @lang('page.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name' , $page->translateOrDefault($global->adminDataLocale)->name) }}"
                                    title="@lang('common.required')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- content --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='content'>
                                    @lang('page.field.content')
                                    <span class='text-danger'>*</span>
                                </label>
                                <textarea class='form-control ck-editor' id='content' placeholder='content'
                                    name='content' data-toggle='tooltip' data-trigger='focus'
                                    title="@lang('common.required')" rows='5' cols='5'
                                    require>{!! old('content',$page->translateOrDefault($global->adminDataLocale)->content) !!}</textarea>
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