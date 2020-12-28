@extends('admin.master')
@section('title')
@lang('common.roles')
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
                    <a href='{{ route('admin.role.create') }}' class='btn btn-orange'>
                        @lang('common.createRole')
                    </a>
                </div>
            </div>
            <form class='mb-3' method='get'>
                <div class='row'>
                    <div class='col-md-4 mt-3 mt-md-1'>
                        <input placeholder="@lang('common.name')" class='form-control' type='search' name='name'
                            value='{{ Request::query('name') }}' />
                    </div>
                    <div class='col-md-1 mt-3 mt-md-1'>
                        <button class='btn btn-primary' type='submit'> @lang('common.search') </button>
                    </div>
                </div>
            </form>
            <div class='table-responsive'>
                <table class='table mb-0 table-responsive-xs table-striped'>
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('common.name') </th>
                            <th> @lang('common.tools') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($role as $item)
                        <tr>
                            <th>
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                <div class='btn-group'>
                                    {{-- admin --}}
                                    <a href='{{ route('admin.management.index' , ['role_id' => $item->id]) }}'
                                        class='btn btn-orange' data-toggle='tooltip' title="@lang('common.admin')">
                                        <span class='mdi mdi-account'></span>
                                    </a>
                                    {{--edit--}}
                                    <a href='{{ route('admin.role.edit' , $item) }}' class='btn btn-success'
                                        data-toggle='tooltip' title="@lang('common.edit')">
                                        <span class='mdi mdi-pencil'></span>
                                    </a>
                                    {{--delete--}}
                                    <button type='button' class='btn btn-danger deleteItem' data-toggle='tooltip'
                                        title="@lang('common.delete')"
                                        data-url="{{ route('admin.role.destroy' , $item) }}"
                                        data-name='{{ $item->name }}' data-type="@lang('common.roles')" data-warning='0'
                                        data-soft='0'><span class='mdi mdi-delete'></span></button>
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
                {{ $role->onEachSide(7)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection