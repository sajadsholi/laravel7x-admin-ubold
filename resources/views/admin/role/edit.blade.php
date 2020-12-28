@extends('admin.master')
@section('title')
@lang('common.createRole')
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title'></h4>
                    </div>

                    <div class='col-md-6 text-right'>
                        <a href="{{ route('admin.role.index') }}" class='btn btn-orange'>@lang('common.archive')</a>
                    </div>

                </div>
                <form action="{{ route('admin.role.update' , $role) }}" method='POST'
                    enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label for='name'>
                                    @lang('common.roleName')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name' , $role->name) }}"
                                    title="@lang('common.required') <br/> @lang('common.unique')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>

                        {{-- permission --}}
                        @foreach ($permissionCategory as $item)

                        @php
                        $rand = Str::random(20)
                        @endphp
                        <div class='col-md-12'>
                            <div class='form-group my-3'>
                                <div class='custom-control custom-checkbox checkbox-primary'>
                                    <input type='checkbox' class='custom-control-input categoryCheckbox'
                                        id="{{ $rand }}" value="{{ $item->id }}">
                                    <label class='custom-control-label' for="{{ $rand }}">{{ $item->name }}</label>
                                </div>
                            </div>
                        </div>

                        @foreach ($item->permissions as $secondItem)

                        @if (empty(old('permission_id')))
                        {{-- check with database --}}
                        @foreach ($permissions as $thirdItem)

                        @php
                        if ($thirdItem->id == $secondItem->id){
                        $checked = 'checked';
                        break;
                        }else{
                        $checked = '';
                        }
                        @endphp

                        @endforeach
                        @else
                        {{-- check with old values --}}
                        @foreach (old('permission_id') as $thirdItem)

                        @php
                        if ($thirdItem == $secondItem->id){
                        $checked = 'checked';
                        break;
                        }else{
                        $checked = '';
                        }
                        @endphp

                        @endforeach

                        @endif

                        @php
                        $rand = Str::random(20)
                        @endphp
                        <div class='col-md-3'>
                            <div class='form-group mb-3'>
                                <div class='custom-control custom-checkbox checkbox-orange'>
                                    <input type='checkbox' class='custom-control-input' id="{{ $rand }}"
                                        data-category="{{ $item->id }}" name="permission_id[]"
                                        value="{{ $secondItem->id }}" {{ $checked }}>
                                    <label class='custom-control-label'
                                        for="{{ $rand }}">{{ $secondItem->name }}</label>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endforeach


                    </div>
                    <button class='btn btn-orange' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection