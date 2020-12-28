@extends('admin.master')
@section('title')
@lang('contactUs.singular')
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" method="post" novalidate>
                    @csrf
                    <div class="form-row justify-content-start mt-2">
                        @if (empty($contact))
                        {{-- contact title --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="contactTitle0">
                                    @lang('common.title')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Contact Title" class="form-control" name="contactTitle[]"
                                    type="text" id="contactTitle0" title="@lang('common.required')" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- contact number --}}
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="contactNumber0">
                                    @lang('contactUs.field.contact_number')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Contact Number" pattern="[0-9-]+" class="form-control"
                                    name="contactNumber[]" type="text" id="contactNumber0"
                                    title="@lang('common.required') <br/> @lang('common.numeric')" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        @else
                        @for ($i = 0; $i < sizeof($contact->contact_number); $i++)
                            @php
                            $randTitle = Str::random(20);
                            $randNumber = Str::random(20);
                            @endphp
                            {{-- contact title --}}
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="{{ $randTitle }}">
                                        @lang('common.title')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input placeholder="Contact Title" class="form-control" name="contactTitle[]"
                                        value="{{ $contact->contact_number[$i]->title }}" type="text"
                                        id="{{ $randTitle }}" title="@lang('common.required')" required />
                                    <div class="invalid-feedback">
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                            {{-- contact number --}}
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="{{ $randNumber }}">
                                        @lang('contactUs.field.contact_number')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <div class="@if($i != 0) input-group @endif">
                                        <input placeholder="Contact Number" pattern="[0-9-]+" class="form-control"
                                            name="contactNumber[]" value="{{ $contact->contact_number[$i]->value }}"
                                            type="text" id="{{ $randNumber }}"
                                            title="@lang('common.required') <br/> @lang('common.numeric')" required />
                                        @if ($i != 0)
                                        <div class="input-group-append deleteContactInfo" data-toggle="tooltip"
                                            title="@lang('common.delete')">
                                            <button type="button" class="btn btn-danger"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </div>
                                        @endif
                                        <div class="invalid-feedback">
                                            @lang('common.invalid-feedback')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @endif
                    </div>
                    <button type="button" id="addMobile" data-step="@if(!empty($contact)) {{ $i }} @else 1 @endif"
                        class="btn btn-orange waves-effect waves-light mb-4 ml-1">
                        <span class="btn-label"><i class="mdi mdi-plus"></i></span>@lang('common.add')
                        @lang('contactUs.field.contact_number')
                    </button>

                    {{-- address --}}
                    <div class="form-row justify-content-start mt-2">
                        @if (empty($contact))
                        {{-- title --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="titleAddress0">
                                    @lang('common.title')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Address Title" class="form-control" name="titleAddress[]"
                                    type="text" id="titleAddress0" title="@lang('common.required')" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        {{-- address --}}
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="address0">
                                    @lang('contactUs.field.address')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Address" title="@lang('common.required')" class="form-control"
                                    name="address[]" type="text" id="address0" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        @else
                        @for ($i = 0; $i < sizeof($contact->address); $i++)
                            @php
                            $randTitle = Str::random(20);
                            $randAddress = Str::random(20);
                            @endphp
                            {{-- title --}}
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="{{ $randTitle }}">
                                        @lang('common.title')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input placeholder="Address Title" class="form-control" name="titleAddress[]"
                                        type="text" title="@lang('common.required')"
                                        value="{{ $contact->address[$i]->title }}" id="{{ $randTitle }}" required />
                                    <div class="invalid-feedback">
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                            {{-- address --}}
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="{{ $randAddress }}">
                                        @lang('contactUs.field.address')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <div class="@if($i != 0) input-group @endif">
                                        <input placeholder="Address" class="form-control" name="address[]" type="text"
                                            id="{{ $randAddress }}" title="@lang('common.required')"
                                            value="{{ $contact->address[$i]->value }}" required />
                                        @if ($i != 0)
                                        <div class="input-group-append deleteContactInfo" data-toggle="tooltip"
                                            title="@lang('common.delete')">
                                            <button type="button" class="btn btn-danger"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </div>
                                        @endif
                                        <div class="invalid-feedback">
                                            @lang('common.invalid-feedback')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            @endif

                    </div>
                    <button type="button" data-step="@if(!empty($contact)) {{ $i }} @else 1 @endif" id="addAddress"
                        class="btn btn-orange waves-effect waves-light mb-4 ml-1">
                        <span class="btn-label"><i class="mdi mdi-plus"></i></span>@lang('common.add')
                        @lang('contactUs.field.address')
                    </button>
                    {{-- address --}}

                    {{-- email --}}
                    <div class="form-row justify-content-start mt-2">
                        @if (empty($contact))
                        {{-- title --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="titleEmail0">
                                    @lang('common.title')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Email Title" title="@lang('common.required')" class="form-control"
                                    name="titleEmail[]" type="text" id="titleEmail0" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="email0">
                                    @lang('contactUs.field.email')
                                    <span class='text-danger'>*</span>
                                </label>
                                <input placeholder="Email" class="form-control" name="email[]" type="email" id="email0"
                                    title="@lang('common.required') <br/> @lang('common.validEmail')" required />
                                <div class="invalid-feedback">
                                    @lang('common.invalid-feedback')
                                </div>
                            </div>
                        </div>
                        @else
                        @for ($i = 0; $i < sizeof($contact->email); $i++)
                            @php
                            $randTitle = Str::random(20);
                            $randEmail = Str::random(20);
                            @endphp
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="{{ $randTitle }}">
                                        @lang('common.title')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <input placeholder="Email Title" class="form-control" name="titleEmail[]"
                                        type="text" value="{{ $contact->email[$i]->title }}" id="{{ $randTitle }}"
                                        title="@lang('common.required')" required />
                                    <div class="invalid-feedback">
                                        @lang('common.invalid-feedback')
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="{{ $randEmail }}">
                                        @lang('contactUs.field.email')
                                        <span class='text-danger'>*</span>
                                    </label>
                                    <div class="@if($i != 0) input-group @endif">
                                        <input placeholder="Email" class="form-control" name="email[]" type="email"
                                            id="{{ $randEmail }}" value="{{ $contact->email[$i]->value }}"
                                            title="@lang('common.required') <br/> @lang('common.validEmail')"
                                            required />
                                        @if ($i != 0)
                                        <div class="input-group-append deleteContactInfo" data-toggle="tooltip"
                                            title="@lang('common.delete')">
                                            <button type="button" class="btn waves-effect waves-light btn-danger"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </div>
                                        @endif
                                        <div class="invalid-feedback">
                                            @lang('common.invalid-feedback')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            @endif
                    </div>
                    <button type="button" data-step="@if(!empty($contact)) {{ $i }} @else 1 @endif" id="addEmail"
                        class="btn btn-orange waves-effect waves-light mb-5 ml-1">
                        <span class="btn-label"><i class="mdi mdi-plus"></i></span>@lang('common.add')
                        @lang('contactUs.field.email')
                    </button>

                    {{-- email --}}

                    {{-- social --}}
                    <div class="form-row justify-content-start">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="facebook">
                                    @lang('contactUs.field.facebook')
                                </label>
                                <input placeholder="https://facebook.com/" class="form-control" name="facebook"
                                    type="url" value="{{ $contact->facebook ?? '' }}" id="facebook" title="@lang('common.validUrl')" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="twitter">
                                    @lang('contactUs.field.twitter')
                                </label>
                                <input placeholder="https://twitter.com/" class="form-control" name="twitter"
                                    type="url" value="{{ $contact->twitter ?? '' }}" id="twitter" title="@lang('common.validUrl')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="instagram">
                                    @lang('contactUs.field.instagram')
                                </label>
                                <input placeholder="https://instagram.com/" class="form-control" name="instagram"
                                    type="url" value="{{ $contact->instagram ?? '' }}" id="instagram" title="@lang('common.validUrl')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="youtube">
                                    @lang('contactUs.field.youtube')
                                </label>
                                <input placeholder="https://youtube.com/" class="form-control" name="youtube"
                                    type="url" value="{{ $contact->youtube ?? '' }}" id="youtube" title="@lang('common.validUrl')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="telegram">
                                    @lang('contactUs.field.telegram')
                                </label>
                                <input placeholder="https://telegram.me" class="form-control" name="telegram"
                                    type="url" value="{{ $contact->telegram ?? '' }}" id="telegram" title="@lang('common.validUrl')" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="whatsapp">
                                    @lang('contactUs.field.whatsapp')
                                </label>
                                <input placeholder="https://whatsapp.com" class="form-control" name="whatsapp"
                                    type="url" value="{{ $contact->whatsapp ?? '' }}" id="whatsapp" title="@lang('common.validUrl')" />
                            </div>
                        </div>
                    </div>
                    {{-- social --}}
                    {{-- lat lng --}}
                    <input type="hidden" name="lat" value="{{ $contact->lat ?? '29.621855327737098' }}">
                    <input type="hidden" name="lng" value="{{ $contact->lng ?? '52.52505540847779' }}">
                    <div class="col-md-12">
                        <div class="map-marker">
                            <img src="{{ URL::asset('asset/admin/image/map-marker.png') }}" alt="">
                        </div>
                        <div id="map" style="height: 400px;" data-lat="{{ $contact->lat ?? '29.621855327737098' }}"
                            data-lng="{{ $contact->lng ?? '52.52505540847779' }}" data-zoom="15"></div>
                    </div>
                    {{-- lat lng --}}

                    <button class="btn btn-primary mt-3" type="submit">@lang('common.submit')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection