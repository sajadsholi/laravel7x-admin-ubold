@extends('admin.master')
@section('title')
@lang('support.singular')
@endsection
@section('content')

<div class="row">
    @foreach ($sum as $item)
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-4 p-0 m-0">
                    <div
                        class="avatar-lg rounded-circle bg-{{ substr($item->adminClass,strpos($item->adminClass , 'badge-') + 6) }}">
                        <i class="fe-tag font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-8">
                    <div class="text-right">
                        <h3 class=" mt-1"><span data-plugin="counterup">{{ $item->ticketNumber }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">@lang("support.status.$item->name")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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
                <div class='col-md-6 text-right'>
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    {{-- ticket id --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <input placeholder="@lang('support.field.id')" class='form-control' type='number'
                            title="@lang('common.numeric')" name='ticket_id'
                            value='{{ Request::query('ticket_id') }}' />
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
                    {{-- user id --}}
                    <div class="col-md-4 col-sm-12 mt-2">
                        <select class='custom-select searchUser' data-url="{{ route('admin.search.findUser') }}"
                            name='user_id'>
                        </select>
                    </div>
                    {{-- subject --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <input placeholder="@lang('support.field.subject')" class='form-control' type='text'
                            name='subject' value='{{ Request::query('subject') }}' />
                    </div>

                    {{-- status id--}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='status_id' name='status_id'>
                            <option value=' ' @if (empty(Request::query('status_id'))) selected @endif>
                                @lang('common.all') @lang('common.status')</option>
                            @foreach($status as $item)
                            <option value="{{ $item->id }}" @if(Request::query('status_id')==$item->id) selected
                                @endif>@lang("support.status.$item->name")</option>
                            @endforeach
                        </select>
                    </div>

                    <div class='col-md-6 mt-2'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>

                    <div class="col-md-6 mt-2 text-right">
                        @if ($support->count() && Permission::can('support'))
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
                            <th> @lang('support.field.id') </th>
                            <th> @lang('common.createdAt') </th>
                            <th> @lang('user.singular') </th>
                            <th width="40%"> @lang('support.field.subject') </th>
                            <th> @lang('common.status') </th>
                            <th> @lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($support as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                #{{ $item->id }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{ $item->user->fullname }}
                            </td>
                            <td>
                                {{ $item->subject }}
                            </td>
                            <td>
                                <span class="{{ $item->status->adminClass }}">
                                    @lang("support.status.".$item->status->name)
                                </span>
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{--edit--}}
                                    <a href='{{ route('admin.support.show' , $item) }}' class='btn btn-info'
                                        data-toggle='tooltip' title="@lang('common.detail')">
                                        <span class='mdi mdi-email'></span>
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
                {{ $support->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection