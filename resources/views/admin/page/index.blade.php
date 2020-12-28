@extends('admin.master')
@section('title')
@lang('page.singular')
@endsection
@section('content')

@if (Permission::can('addPage'))

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'>
                            @lang('common.add') @lang('page.singular')
                        </h4>
                    </div>
                </div>
                <form action="{{ route('admin.page.store') }}" method='POST' enctype='application/x-www-form-urlencoded'
                    class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='name'>
                                    @lang('page.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name') }}" title="@lang('common.required')" required>
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
                                    require>{!! old('content') !!}</textarea>
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

@if (Permission::can('editPage') || Permission::can('deletePage'))

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
                        <input placeholder="@lang('page.field.name')" class='form-control' type='search' name='name'
                            value='{{ Request::query('name') }}' />
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
                            <th> @lang('page.field.name') </th>
                            <th> @lang('page.field.priority') </th>
                            <th> @lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->translateOrDefault($global->adminDataLocale)->name }}
                            </td>
                            <td>
                                @if (Permission::can('editPage'))
                                <a href="#" data-url="{{ route('admin.common.changePriority') }}"
                                    class="changePriority text-orange" data-type="text" data-pk="{{ $item->id }}"
                                    data-name="priority" data-value="{{ $item->priority }}" data-model="Page"
                                    data-can="editPage"
                                    data-title="@lang('common.change') @lang('page.field.priority')"></a>
                                @else
                                {{ $item->priority }}
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--edit--}}
                                    @if (Permission::can('editPage'))
                                    <x-selectLanguage :translation="$item->translations"
                                        redirect="{{ route('admin.page.show' , $item) }}" />
                                    </a>
                                    @endif
                                    {{--delete--}}
                                    @if (Permission::can('deletePage'))
                                    <button type='button' class='btn btn-sm btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url='{{ route('admin.page.destroy' , $item) }}'
                                        data-name='{{ $item->name }}' data-type="@lang('page.singular')"
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
                {{ $pages->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endif

@endsection