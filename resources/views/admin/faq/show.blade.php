@extends('admin.master')
@section('title')
@lang('common.edit') @lang('faq.singular')
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
                        <a href="{{ route('admin.faq.index') }}" class='btn btn-orange'>@lang('common.archive')</a>
                    </div>

                </div>
                <form action="{{ route('admin.faq.update' , $faq) }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>
                        {{-- question --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='question'>
                                    @lang('faq.field.question')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='question' placeholder='question'
                                    name='question'
                                    value="{{ old('question' , $faq->translateOrDefault($global->lang)->question) }}"
                                    title="@lang('common.required')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- answer --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='answer'>
                                    @lang('faq.field.answer')
                                    <span class='text-danger'>*</span>
                                </label>
                                <textarea class='form-control' id='answer' placeholder='answer' name='answer'
                                    data-trigger='focus' data-toggle='tooltip' title="@lang('common.required')" cols="5"
                                    rows="5"
                                    required>{{ old('answer' , $faq->translateOrDefault($global->lang)->answer) }}</textarea>
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