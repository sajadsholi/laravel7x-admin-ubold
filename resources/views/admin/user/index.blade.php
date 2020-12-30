@extends('admin.master')
@section('title')
@lang('user.plural')
@endsection
@section('content')
<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <form class='mb-3' method='get'>
                <div class='row'>
                    {{-- fullname --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="{{ Request::query('fullname') }}" placeholder="@lang('user.field.fullname')">
                    </div>
                    {{-- mobile --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <input type="text" class="form-control" id="mobile" name="mobile"
                            value="{{ Request::query('mobile') }}" placeholder="@lang('user.field.mobile')">
                    </div>
                    {{-- is_active --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <select class="select2" name="is_active">
                            <option value=" " @if (empty(Request::query('is_active'))) selected @endif>
                                @lang('common.all')
                                @lang('common.status')
                            </option>
                            <option value="1" @if (Request::query('is_active')==1) selected @endif>
                                @lang('common.active')
                            </option>
                            <option value="0" @if (Request::query('is_active')=='0' ) selected @endif>
                                @lang('common.inactive')
                            </option>
                        </select>
                    </div>
                    {{-- from date --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <input type="text" class="form-control dateAndTimePicker" name="from_date"
                            value="{{ Request::query('from_date') }}"
                            placeholder="@lang('common.from') @lang('common.date')" readonly>
                    </div>
                    {{-- to date --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <input type="text" class="form-control dateAndTimePicker" name="to_date"
                            value="{{ Request::query('to_date') }}"
                            placeholder="@lang('common.to') @lang('common.date')" readonly>
                    </div>
                    <div class='col-md-1 col-sm-6 mt-2'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>
                    <div class="col-md-3 col-sm-6 mt-2 text-right">
                        @if ($users->count() && Permission::can('user'))
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
                            <th>@lang('user.field.fullname')</th>
                            <th>@lang('user.field.mobile')</th>
                            <th>@lang('common.createdAt')</th>
                            <th>@lang('common.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->fullname }}
                            </td>
                            <td>
                                {{ $item->mobile }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <a href="#" data-url="{{ route('admin.common.changeIsActive') }}" class="changeIsActive"
                                    data-type="select" data-pk="{{ $item->id }}" data-name="is_active" data-model="User"
                                    data-can="user" data-value="{{ $item->is_active }}"
                                    data-title="@lang('common.change') @lang('common.status')"></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class='alert-danger text-center noResult'>@lang('common.noResult')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection