@extends('admin.master')
@section('title')
@lang('common.archive') - @lang('common.admin')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <div class='row'>
                <div class='col-md-6'>
                    <h4 class='header-title mb-3'>
                    </h4>
                </div>
                <div class='col-md-6 text-right'>
                    <a href='{{ route('admin.management.create') }}' class='btn btn-orange'>
                        @lang('common.createAdmin')
                    </a>
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    {{-- fullname --}}
                    <div class='col-md-3 mt-3 mt-md-1'>
                        <input placeholder="@lang('common.name')" class='form-control' type='search' name='fullname'
                            value='{{ Request::query('name') }}' />
                    </div>
                    {{-- role id --}}
                    <div class='col-md-3 mt-3 mt-md-1'>
                        <select class='form-control select2' id='role_id' name='role_id'
                            data-placeholder="@lang('common.select') @lang('common.role')">
                            <option value=' ' @if(empty(Request::query('role_id'))) selected @endif>@lang('common.all')
                                @lang('common.role')</option>
                            @foreach($roles as $item)
                            <option value="{{ $item->id }}" @if(Request::query('role_id')==$item->id) selected
                                @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- isActive --}}
                    <div class='col-md-3 mt-3 mt-md-1'>
                        <select class='custom-select select2' id='isActive' name='isActive'
                            data-placeholder="@lang('common.select') @lang('common.role')">
                            <option value=' ' @if((string)Request::query('isActive')=='' ) selected @endif>
                                @lang('common.all') @lang('common.status')
                            </option>
                            <option value='1' @if((string)Request::query('isActive')=='1' ) selected @endif>
                                @lang('common.active')
                            </option>
                            <option value='0' @if((string)Request::query('isActive')=='0' ) selected @endif>
                                @lang('common.inactive')
                            </option>
                        </select>
                    </div>
                    <div class='col-md-1 col-sm-6 mt-3 mt-md-1'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>

                    <div class="col-md-2 col-sm-6 mt-3 mt-md-1 text-right">
                        @if ($admin->count() && Auth::guard('admin')->id())
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> Export <i
                                    class="mdi mdi-chevron-down"></i></button>
                            <div class="dropdown-menu" x-placement="top-start">
                                {{-- xlsx --}}
                                <a class="dropdown-item" href="{{ Request::fullUrlWithQuery(['download' => 'xlsx']) }}">
                                    download .xlsx
                                </a>
                                {{-- csv --}}
                                <a class="dropdown-item" href="{{ Request::fullUrlWithQuery(['download' => 'csv']) }}">
                                    download .csv
                                </a>
                                {{-- pdf --}}
                                <a class="dropdown-item printButton" href="javascript:void();"
                                    data-url="{{ Request::fullUrlWithQuery(['download' => 'pdf']) }}">
                                    download .pdf
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
            <div class='table-responsive'>
                <table class='table mb-0 table-responsive-xs table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('common.name') </th>
                            <th> @lang('common.role') </th>
                            <th> @lang('common.createdAt') </th>
                            <th> @lang('common.status') </th>
                            <th> @lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admin as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->fullname }}
                            </td>
                            <td>
                                {{ $item->role->name ?? '-' }}
                            </td>
                            <td>
                                {{ $item->created_at ?? '-' }}
                            </td>
                            <td>
                                @if ($item->id != 1)
                                <a href="#" data-url="{{ route('admin.management.changeIsActive' , $item) }}"
                                    class="changeIsActive" data-type="select" data-pk="{{ $item->id }}"
                                    data-name="isActive" data-value="{{ $item->isActive }}"
                                    data-title="@lang('common.change') @lang('common.status')"></a>
                                @else
                                <span class="text-success">@lang('common.active')</span>
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--edit--}}
                                    <a href='{{ route('admin.management.edit' , $item) }}' class='btn btn-success'
                                        data-toggle='tooltip' title="@lang('common.edit')">
                                        <span class='mdi mdi-pencil'></span>
                                    </a>
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
                {{ $admin->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>



@endsection