@extends('admin.master')
@section('title')
@lang('notification.singular')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'>@lang('notification.other.send') @lang('notification.singular')</h4>
                    </div>
                </div>
                <form method='POST' enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    <div class='row justify-content-start mt-2'>
                        {{-- userRange --}}
                        <div class='col-md-6'>
                            <div class='form-group mb-3'>
                                <label for='userRange'>
                                    @lang('notification.other.userRange')
                                    <span class='text-danger'>*</span>
                                </label>
                                <select class='custom-select form-control select2 ' id='userRange' name='userRange'
                                    title="@lang('common.required')" data-placeholder="@lang('common.select')" required>
                                    <option value='' disabled selected></option>
                                    <option value='1' @if(old('userRange')==1) selected @endif>
                                        @lang('notification.other.allUsers')
                                    </option>
                                    <option value='2' @if(old('userRange')==2) selected @endif>
                                        @lang('notification.other.numberOfUsers')</option>
                                </select>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- user_id --}}
                        <div class='col-md-6 invisible'>
                            <div class='form-group mb-3'>
                                <label for='user_id'>
                                    @lang('common.select') @lang('user.plural')
                                    <span class='text-danger'>*</span>
                                </label>
                                <select class='custom-select searchUser' multiple title="@lang('common.required')"
                                    data-url="{{ route('admin.search.findUser') }}" name='user_id[]'>
                                </select>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- title --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='title'>
                                    @lang('notification.field.title')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='title' placeholder='title' name='title'
                                    value="{{ old('title') }}" title="@lang('common.required')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- message --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='message'>
                                    @lang('notification.field.message')
                                    <span class='text-danger'>*</span>
                                </label>
                                <textarea class='form-control' id='message' placeholder='message' name='message'
                                    data-toggle='tooltip' data-trigger='focus' title="@lang('common.required')" rows='5'
                                    cols='5' required>{{ old('message') }}</textarea>
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
                    {{-- receiver --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <input placeholder="@lang('notification.field.receiver')" class='form-control' type='search'
                            name='receiver' value='{{ Request::query('receiver') }}' />
                    </div>
                    {{-- title --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <input placeholder="@lang('notification.field.title')" class='form-control' type='search'
                            name='title' value='{{ Request::query('title') }}' />
                    </div>
                    {{-- message --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <input placeholder="@lang('notification.field.message')" class='form-control' type='search'
                            name='message' value='{{ Request::query('message') }}' />
                    </div>

                    {{-- type --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='type' name='type'
                            data-placeholder="@lang('common.select') @lang('notification.field.type')">
                            {{-- select all --}}
                            <option value=' ' @if (empty(Request::query('type'))) selected @endif>
                                @lang('common.all') @lang('notification.other.types')
                            </option>
                            @foreach($types as $item)
                            <option value="{{ $item->type }}" @if (Request::query('type')==$item->type)
                                selected
                                @endif >@lang("$item->type.singular")
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- device --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='device' name='device_id'
                            data-placeholder="@lang('common.select') @lang('device.singular')">
                            {{-- select all --}}
                            <option value=' ' @if (empty(Request::query('device_id'))) selected @endif>
                                @lang('common.all') @lang('device.plural')
                            </option>
                            @foreach($devices as $item)
                            <option value="{{ $item->id }}" @if (Request::query('device_id')==$item->id)
                                selected
                                @endif >
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class='col-md-1 mt-2'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>
                </div>
            </form>
            <div class='table-responsive'>
                <table class='table mb-0 table-responsive-xs table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('common.createdAt') </th>
                            <th> @lang('notification.field.receiver') </th>
                            <th> @lang('notification.field.title') </th>
                            <th> @lang('notification.field.message') </th>
                            <th> @lang('notification.field.type') </th>
                            <th> @lang('device.singular') </th>
                            <th> @lang('common.status') </th>
                            <th> @lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notification as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{ ($item->isAll) ? __('notification.other.send'). " " .__('common.all') : $item->receiver }}
                            </td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ $item->message }}
                            </td>
                            <td>
                                @lang("$item->type.singular")
                            </td>
                            <td>
                                <span class="{{ $item->device->adminClass }}">
                                    {{ $item->device->name }}
                                </span>
                            </td>
                            <td>
                                @if ($item->isDone)
                                <span class="badge badge-success p-2">
                                    @lang('notification.other.sent')
                                </span>
                                @else
                                <span class="badge badge-blue p-2">
                                    @lang('notification.other.sending')
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--delete--}}
                                    <button type='button' class='btn btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url='{{ route('admin.notification.destroy' , $item) }}'
                                        data-name='{{ $item->title }}' data-type="@lang('notification.singular')"
                                        data-warning='0' data-soft='0'><span class='mdi mdi-delete'></span></button>
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
                {{ $notification->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection