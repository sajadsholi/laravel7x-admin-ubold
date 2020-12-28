@extends('admin.master')
@section('title')
@lang('common.logsActivity')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card-box'>
            <form class='mb-3' method='get'>
                <div class='row'>
                    {{-- admin id filter --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='admin_id' name='admin_id'
                            data-placeholder="@lang('common.select') @lang('common.admin')">
                            {{-- select all --}}
                            <option value=' ' @if (empty(Request::query('admin_id'))) selected @endif>
                                @lang('common.all') @lang('common.admin')
                            </option>
                            @foreach($admins as $item)
                            <option value="{{ $item->id }}" @if (Request::query('admin_id')==$item->id)
                                selected
                                @endif>
                                {{ $item->fullname }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- description filter --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='description' name='description'
                            data-placeholder="@lang('common.select') @lang('common.action')">
                            {{-- select all --}}
                            <option value=' ' @if (empty(Request::query('description'))) selected @endif>
                                @lang('common.all') @lang('common.actions')
                            </option>
                            @foreach($descriptions as $item)
                            <option value="{{ $item->name }}" @if (Request::query('description')==$item->name)
                                selected
                                @endif>@lang("common.$item->name")
                            </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- log name filter --}}
                    <div class='col-md-4 col-sm-12 mt-2'>
                        <select class='custom-select select2' id='log_name' name='log_name'
                            data-placeholder="@lang('common.select') @lang('common.type')">
                            {{-- select all --}}
                            <option value=' ' @if (empty(Request::query('log_name'))) selected @endif>
                                @lang('common.all') @lang('common.types')
                            </option>
                            @foreach($log_names as $item)
                            <option value="{{ $item->name }}" @if (Request::query('log_name')==$item->name)
                                selected
                                @endif >@lang("common.$item->name")
                            </option>
                            @endforeach
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
                            <th> @lang('common.date') </th>
                            <th> @lang('common.by') </th>
                            <th> @lang('common.type')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{ $item->causer->fullname }}
                            </td>
                            <td>
                                @lang("common.$item->description")

                                @if (!empty($item->log_name))
                                @lang("entity.$item->log_name")
                                @endif

                            </td>
                        </tr>
                        @php
                        $prop = json_decode($item->properties);
                        $oldData = (!empty($prop->old)) ? $prop->old : [];
                        $currentData = (!empty($prop->attributes)) ? $prop->attributes : [];
                        @endphp
                        @if (!empty($prop) && !empty($currentData))
                        <tr>
                            @if ($oldData)
                            <td colspan="2">
                                <p class="text-warning mb-2">@lang('common.oldValue')</p>

                                @foreach ($oldData as $key => $old)

                                @if (is_array($old))

                                <p class="mb-2">
                                    <span class="mdi mdi-arrow-down-thick text-blue"></span>
                                    @lang("$item->log_name.field.$key")
                                </p>

                                @for ($i = 0; $i < sizeof($old); $i++)
                                    
                                @foreach ($old[$i] as $oldKey => $oldItem)

                                <p class="mb-2">@lang("$item->log_name.field.$oldKey") : {!! $oldItem !!}</p>

                                @endforeach
                                
                                @endfor

                                @else

                                <p class="mb-2">@lang("$item->log_name.field.$key") : {!! $old !!}</p>

                                @endif

                                @endforeach

                            </td>
                            <td colspan="2">
                                <p class="text-success mb-2">@lang('common.newValue')</p>

                                @foreach ($currentData as $key => $current)

                                @if (is_array($current))


                                <p class="mb-2">
                                    <span class="mdi mdi-arrow-down-thick text-blue"></span>
                                    @lang("$item->log_name.field.$key")
                                </p>

                                @for ($i = 0; $i < sizeof($current); $i++)
                                    
                                @foreach ($current[$i] as $currentKey => $currentItem)

                                <p class="mb-2">@lang("$item->log_name.field.$currentKey") : {!! $currentItem !!}</p>

                                @endforeach

                                @endfor

                                @else

                                <p class="mb-2">@lang("$item->log_name.field.$key") : {!! $current !!}</p>

                                @endif

                                @endforeach


                            </td>
                            @else
                            <td colspan="4">
                                @foreach ($currentData as $key => $current)

                                @if (is_array($current))

                                <p class="mb-2">
                                    <span class="mdi mdi-arrow-down-thick text-blue"></span>
                                    @lang("$item->log_name.field.$key")
                                </p>

                                @for ($i = 0; $i < sizeof($current); $i++)
                                    
                                @foreach ($current[$i] as $currentKey => $currentItem)

                                <p class="mb-2">@lang("$item->log_name.field.$currentKey") : {!! $currentItem !!}</p>

                                @endforeach

                                @endfor

                                @else

                                <p class="mb-2">@lang("$item->log_name.field.$key") : {!! $current !!}</p>

                                @endif

                                @endforeach

                            </td>
                            @endif
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td class='alert-danger text-center noResult'>@lang('common.noResult')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $logs->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection