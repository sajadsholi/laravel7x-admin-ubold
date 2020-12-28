@extends('admin.master')
@section('title')
@lang('faq.singular')
@endsection
@section('content')

@if (Permission::can('addFaq'))

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'>
                            @lang('common.add') @lang('faq.singular')
                        </h4>
                    </div>
                </div>
                <form action="{{ route('admin.faq.store') }}" method='POST' enctype='application/x-www-form-urlencoded'
                    class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- question --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='question'>
                                    @lang('faq.field.question')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='question' placeholder='question'
                                    name='question' value="{{ old('question') }}" title="@lang('common.required')"
                                    required>
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
                                    rows="5" required>{{ old('answer') }}</textarea>
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

@endif

@if (Permission::can('editFaq') || Permission::can('deleteFaq'))

<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <div class='row'>
                <div class='col-md-6'>
                    <h4 class='header-title mb-3'>
                        @lang('common.archive')
                    </h4>
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    <div class='col-md-4'>
                        <input placeholder="@lang('faq.field.question')" class='form-control' type='search'
                            name='question' value='{{ Request::query('question') }}' />
                    </div>
                    <div class='col-md-8 mt-3 mt-md-0'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>
                </div>
            </form>
            <div class='table-responsive'>
                <table class='table mb-0 table-responsive-xs table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th width="60%">@lang('faq.field.question')</th>
                            <th>@lang('faq.field.priority')</th>
                            <th>@lang('common.tools')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->translateOrDefault($global->lang)->question }}
                            </td>
                            <td>
                                @if (Permission::can('editFaq'))
                                <a href="#" data-url="{{ route('admin.common.changePriority') }}"
                                    class="changePriority text-orange" data-type="text" data-pk="{{ $item->id }}"
                                    data-name="priority" data-value="{{ $item->priority }}" data-model="Faq"
                                    data-can="editFaq"
                                    data-title="@lang('common.change') @lang('faq.field.priority')"></a>
                                @else
                                {{ $item->priority }}
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--edit--}}
                                    @if (Permission::can('editFaq'))
                                    <x-selectLanguage :translation="$item->translations"
                                        redirect="{{ route('admin.faq.show' , $item) }}" />
                                    @endif
                                    {{--delete--}}
                                    @if (Permission::can('deleteFaq'))
                                    <button type='button' class='btn btn-sm btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url='{{ route('admin.faq.destroy' , $item) }}'
                                        data-name='{{ $item->question }}' data-type="@lang('faq.singular')"
                                        data-warning='0' data-soft='1'><span class='mdi mdi-delete'></span></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class='alert-danger text-center noResult'>@lang('common.noResult')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $faqs->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endif

@endsection