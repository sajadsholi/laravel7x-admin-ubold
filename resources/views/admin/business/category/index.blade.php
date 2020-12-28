@extends('admin.master')
@section('title')
@lang('businessCategory.singular')
@endsection
@section('content')
<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <div class='row'>
                <div class='col-md-6'>
                    <h4 class='header-title mb-3'>
                        @lang('common.archive')
                    </h4>
                </div>
                <div class='col-md-6 text-right'>
                    @if (Permission::can('addBusinessCategory'))
                    <a href='{{ route('admin.businessCategory.create') }}' class='btn btn-orange'>
                        @lang('common.add') @lang('businessCategory.singular')
                    </a>
                    @endif
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    <div class='col-md-4 mt-3'>
                        <input placeholder="@lang('businessCategory.field.name')" class='form-control' type='search'
                            name='name' value='{{ Request::query('name') }}' />
                    </div>
                    <div class='col-md-2 mt-3'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>
                </div>
            </form>
            <div class='table-responsive'>
                <table class='table mb-0 table-responsive-xs table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>@lang('businessCategory.field.name')</th>
                            <th>@lang('businessCategory.field.priority')</th>
                            <th>@lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($businessCategories as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->translateOrDefault($global->lang)->name }}
                            </td>
                            {{-- priority --}}
                            <td>
                                @if(Permission::can('editBusinessCategory'))
                                <a href='#' data-url="{{ route('admin.common.changePriority') }}"
                                    class='changePriority text-orange' data-type='text' data-pk="{{ $item->id }}"
                                    data-name='priority' data-value="{{ $item->priority }}"
                                    data-model='BusinessCategory' data-can='editBusinessCategory'
                                    data-title="@lang('common.change') @lang('common.priority')"></a>
                                @else
                                {{ $item->priority }}
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--sub category--}}
                                    <a href='{{ route('admin.businessCategory.show' , $item) }}'
                                        class='btn btn-sm btn-primary' data-toggle='tooltip'
                                        title="@lang('businessCategory.other.businessSubCategory')">
                                        <span class='mdi mdi-layers-outline'></span>
                                    </a>
                                    {{--edit--}}
                                    @if (Permission::can('editBusinessCategory'))
                                    <x-selectLanguage :translation="$item->translations"
                                        redirect="{{ route('admin.businessCategory.edit' , $item) }}" />
                                    @endif
                                    {{--delete--}}
                                    @if (Permission::can('deleteBusinessCategory'))
                                    <button type='button' class='btn btn-sm btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')" data-type="@lang('businessCategory.singular')"
                                        data-name='{{ $item->name }}'
                                        data-url='{{ route('admin.businessCategory.destroy' , $item) }}'
                                        data-warning='1' data-soft='1'><span class='mdi mdi-delete'></span></button>
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
                {{ $businessCategories->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection