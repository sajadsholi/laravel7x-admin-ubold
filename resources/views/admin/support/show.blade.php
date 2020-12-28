@extends('admin.master')
@section('title')
@lang('common.detail') - #{{ $support->id }}
@endsection
@section('content')

<div class="col-xl-12">
    <div class="card-box">
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="m-1">@lang('user.field.name') : {{ $support->user->fullname ?? '-' }}</p>
                <p class="m-1">@lang('user.field.mobile') : {{  $support->user->mobile ?? '-' }}</p>
                <p class="m-1">@lang('user.field.email') : {{ $support->user->email ?? '-' }}</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.support.close' , $support) }}" id="closeTicket"
                    class="btn btn-pink @if ($support->status_id == 1 || $support->status_id == 4) d-none @endif">
                    @lang('support.closeTheTicket')
                </a>
                <a href="{{ route('admin.support.index') }}" class="btn btn-orange mx-2">
                    @lang('common.archive')
                </a>
            </div>
        </div>

        <div class="chat-conversation">
            <ul class="conversation-list slimscroll">
                @foreach ($support->support_details as $item)

                @if (empty($item->admin_id))

                <li class="clearfix">
                    <div class="chat-avatar">
                        <img src="{{ $support->user->getMedium()->path ?? $global->defaultAvatar }}" alt="user">
                    </div>
                    <div class="conversation-text">
                        <div class="ctext-wrap">
                            <i>{{ $support->user->fullname }}</i>
                            <p>
                                {{ $item->message }}
                            </p>
                            <div class="text-muted mt-2">{{ $item->created_at }}</div>
                        </div>
                    </div>
                </li>

                @else

                <li class="clearfix odd">
                    <div class="chat-avatar">
                        <img src="{{ $item->admin->getMedium()->path ?? $global->defaultAvatar }}" alt="admin">
                    </div>
                    <div class="conversation-text">
                        <div class="ctext-wrap">
                            <i>{{ $item->admin->fullname }}</i>
                            <p>
                                {{ $item->message }}
                            </p>
                            <div class="text-muted mt-2">{{ $item->created_at }}</div>
                        </div>
                    </div>
                </li>

                @endif

                @endforeach
            </ul>
            <form action="{{ route('admin.support.response' , $support) }}">
                <div class="row">
                    <div class="col">
                        <textarea class="form-control chat-input" id="responseMessage" placeholder="Enter your response"
                            cols="4" rows="4"></textarea>
                    </div>
                    <div class="col-auto">
                        <button type="button" id="responseButton"
                            class="btn btn-orange chat-send btn-block waves-effect waves-light">@lang('common.submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection