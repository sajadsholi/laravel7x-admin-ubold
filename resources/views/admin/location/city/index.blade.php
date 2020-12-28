@extends('admin.master')
@section('title')
@lang('common.location') - @lang('city.singular')
@endsection
@section('content')
@if (Permission::can('addLocation'))
<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title text-capitalize'>@lang('common.add') @lang('city.singular')
                            - {{ $region->name }}</h4>
                    </div>

                    <div class='col-md-6 text-right'>
                        <a href="{{ route('admin.region.index' , ['country' => $region->country_id]) }}"
                            class='btn btn-orange'>@lang('common.goBack')</a>
                    </div>

                </div>
                <form action="{{ route('admin.city.store' , $region) }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label class='text-capitalize' for='name'>
                                    @lang('city.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name') }}" title="@lang('common.required')" required>
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

@if (Permission::can('addLocation') || Permission::can('editLocation') || Permission::can('deleteLocation'))
<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <div class='row'>
                <div class='col-md-6'>
                    <h4 class='header-title mb-3'>
                        @lang('common.archive') - @lang('city.plural') @lang('common.of') {{ $region->name }}
                    </h4>
                </div>
                <div class='col-md-6 text-right'>
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    <div class='col-md-4'>
                        <input placeholder="@lang('city.field.name')" class='form-control' type='search' name='name'
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
                            <th>@lang('city.field.name')</th>
                            <th>@lang('city.field.priority')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.tools')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($city as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->name }}
                            </td>
                            {{-- priority --}}
                            <td>
                                @if(Permission::can('editLocation'))
                                <a href='#' data-url="{{ route('admin.common.changePriority') }}"
                                    class='changePriority text-orange' data-type='text' data-pk="{{ $item->id }}"
                                    data-name='priority' data-value="{{ $item->priority }}" data-model='City'
                                    data-can='editLocation'
                                    data-title="@lang('common.change') @lang('common.priority')"></a>
                                @else
                                {{ $item->priority }}
                                @endif
                            </td>
                            {{-- isActive --}}
                            <td>
                                @if(Permission::can('editLocation'))
                                <a href='#' data-url="{{ route('admin.common.changeIsActive') }}" class="changeIsActive"
                                    data-type="select" data-pk="{{ $item->id }}" data-name="isActive" data-model="City"
                                    data-can="editLocation" data-value="{{ $item->isActive }}"
                                    data-title="@lang('common.change') @lang('common.status')">
                                </a>
                                @else
                                <x-isActive :status="$item->isActive" />
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--edit--}}
                                    @if (Permission::can('editLocation'))
                                    <a href='{{ route('admin.city.update' , ['region' => $region , 'city' => $item]) }}'
                                        class='btn btn-sm btn-success' data-toggle='tooltip'
                                        title="@lang('common.edit')">
                                        <span class='mdi mdi-pencil'></span>
                                    </a>
                                    @endif
                                    {{--delete--}}
                                    @if (Permission::can('deleteLocation'))
                                    <button type='button' class='btn btn-sm btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url='{{ route('admin.city.destroy' , ['region' => $region , 'city' => $item]) }}'
                                        data-name='{{ $item->name }}' data-type="@lang('city.singular')" data-warning='0'
                                        data-soft='0'><span class='mdi mdi-delete'></span></button>
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
                {{ $city->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>
@endif
@endsection