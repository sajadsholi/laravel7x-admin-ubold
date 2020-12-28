@extends('admin.master')
@section('title')
@lang('common.location') - @lang('country.singular')
@endsection
@section('content')

@if (Permission::can('addLocation'))
<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title text-capitalize'>@lang('common.add') @lang('country.singular')</h4>
                    </div>

                    <div class='col-md-6 text-right'>
                    </div>

                </div>
                <form action="{{ route('admin.country.store') }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-4'>
                            <div class='form-group mb-3'>
                                <label class="text-capitalize" for='name'>
                                    @lang('country.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name') }}" title="@lang('common.required')" required>
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
                                    name='code' value="{{ old('code') }}">
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
                                    value="{{ old('phone_code') }}" title="@lang('common.numeric')">
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- avatar --}}
                        @atriatech_media_start
                        @atriatech_media_file('flag', '{"name": "image", "placeholder": "{{ __("country.other.flag") }} ({{ __("common.required") }})","file":""}')
                        @atriatech_media_end

                    </div>
                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@if (Permission::can('addLocation') || Permission::can('editLocation') || Permission::can('deleteLocation'))

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
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    <div class='col-md-4'>
                        <input placeholder="@lang('country.field.name')" class='form-control' type='search' name='name'
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
                            <th>@lang('country.other.flag')</th>
                            <th>@lang('country.field.name') </th>
                            <th>@lang('country.field.code')</th>
                            <th>@lang('country.field.phone_code')</th>
                            <th>@lang('country.field.priority')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($country as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                <img data-src="{{ $item->media[0]->path ?? $global->noImage }}" alt="{{ $item->name }}"
                                    height="30px" width="60px">
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->code }}
                            </td>
                            <td>
                                {{ $item->phone_code }}
                            </td>
                            {{-- priority --}}
                            <td>
                                @if(Permission::can('editLocation'))
                                <a href='#' data-url="{{ route('admin.common.changePriority') }}"
                                    class='changePriority text-orange' data-type='text' data-pk="{{ $item->id }}"
                                    data-name='priority' data-value="{{ $item->priority }}" data-model='Country'
                                    data-can='editLocation'
                                    data-title="@lang('common.change') @lang('common.priority')"></a>
                                @else
                                {{ $item->priority }}
                                @endif
                            </td>
                            {{-- isActive --}}
                            <td>
                                @if (Permission::can('editLocation'))
                                <a href="#" data-url="{{ route('admin.common.changeIsActive') }}" class="changeIsActive"
                                    data-type="select" data-pk="{{ $item->id }}" data-name="isActive"
                                    data-model="Country" data-can="editLocation" data-value="{{ $item->isActive }}"
                                    data-title="@lang('common.change') @lang('common.status')"></a>
                                @else
                                <x-isActive :status="$item->isActive" />
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--add region--}}
                                    @if (Permission::can('addLocation'))
                                    <a href='{{ route('admin.region.index' , $item) }}' class='btn btn-sm btn-orange'
                                        data-toggle='tooltip' title="@lang('common.add') @lang('region.singular')">
                                        <span class='mdi mdi-layers-outline'></span>
                                    </a>
                                    @endif
                                    {{--edit--}}
                                    @if (Permission::can('editLocation'))
                                    <a href='{{ route('admin.country.show' , $item) }}' class='btn btn-sm btn-success'
                                        data-toggle='tooltip' title="@lang('common.edit')">
                                        <span class='mdi mdi-pencil'></span>
                                    </a>
                                    @endif
                                    {{--delete--}}
                                    @if (Permission::can('deleteLocation'))
                                    <button type='button' class='btn btn-sm btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url='{{ route('admin.country.destroy' , $item) }}'
                                        data-name='{{ $item->name }}' data-type="@lang('country.singular')"
                                        data-warning='0' data-soft='0'><span class='mdi mdi-delete'></span></button>
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
                {{ $country->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endif

@endsection