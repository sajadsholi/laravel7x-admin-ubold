@extends('admin.master')
@section('title')
@lang('common.edit') @lang('region.singular') - {{ $region->name }}
@endsection
@section('content')

<div class='row'>
    <div class='col-lg-12'>
        <div class='card'>
            <div class='card-body'>
                <div class='row'>
                    <div class='col-md-6'>
                        <h4 class='header-title text-capitalize'></h4>
                    </div>

                    <div class='col-md-6 text-right'>
                        <a href="{{ route('admin.region.index', $country) }}"
                            class='btn btn-orange'>@lang('common.goBack')</a>
                    </div>

                </div>
                <form action="{{ route('admin.region.update', ['country' => $country , 'region' => $region]) }}"
                    method='POST' enctype='application/x-www-form-urlencoded' class='needs-validation' novalidate>
                    @csrf
                    @method('PATCH')
                    <div class='form-row justify-content-start mt-2'>
                        {{-- name --}}
                        <div class='col-md-12'>
                            <div class='form-group mb-3'>
                                <label class='text-capitalize' for='name'>
                                    @lang('region.field.name')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input type='text' class='form-control' id='name' placeholder='name' name='name'
                                    value="{{ old('name' , $region->name) }}" title="@lang('common.required')" required>
                                <div class='invalid-feedback'>
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class='btn btn-orange mt-3' type='submit'>@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection