<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0 text-white">@lang('common.settings')</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{ $global->userAvatar->path ?? $global->defaultAvatar }}"
                    alt="{{ Auth::guard('admin')->user()->fullname }}"
                    title="{{ Auth::guard('admin')->user()->fullname }}" class="rounded-circle img-fluid">
            </div>

            <h5><a href="javascript: void(0);" class="user_name">{{ Auth::guard('admin')->user()->fullname }}</a> </h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h5 class="pl-3">@lang('common.generalSettings')</h5>
        <hr class="mb-0" />

        <div class="p-3">
            <form method="POST" action="{{ route('admin.config.index') }}">
                @csrf
                {{-- dark mode --}}
                <div class='col-md-12 p-0'>
                    <div class='form-group mb-3'>
                        <div class='custom-control custom-checkbox checkbox-orange'>
                            <input type='checkbox' class='custom-control-input' name="mode" id="checkboxMode" value="1"
                                @if($global->adminMode== 'dark')
                            checked
                            @endif>
                            <label class='custom-control-label' for="checkboxMode">dark mode</label>
                        </div>
                    </div>
                </div>
                {{-- number of pagination --}}
                <div class="col-md-12 p-0">
                    <div class="form-group mb-3">
                        <label for="selectPagination">@lang('common.selectPagination')</label>
                        <select class="form-control" id="selectPagination" name="pagin">
                            {{-- 15 rows --}}
                            <option value="15" @if ($global->adminPagin == 15 )
                                selected
                                @endif>
                                15 @lang('common.rows')
                                (@lang('common.recommended'))
                            </option>
                            {{-- 50 row --}}
                            <option value="50" @if ($global->adminPagin == 50 )
                                selected
                                @endif>
                                50 @lang('common.rows')
                            </option>
                            {{-- 100 rows --}}
                            <option value="100" @if ($global->adminPagin == 100 )
                                selected
                                @endif>
                                100 @lang('common.rows')
                            </option>
                            {{-- 500 rows --}}
                            <option value="500" @if ($global->adminPagin == 500 )
                                selected
                                @endif>
                                500 @lang('common.rows')
                                (@lang('common.notRecommended'))
                            </option>
                        </select>
                    </div>
                </div>
                {{-- screen lock --}}
                <div class="col-md-12 p-0">
                    <div class="form-group mb-3">
                        <label for="selectLockoutTime">@lang('common.selectLockoutTime')</label>
                        <select class="form-control" id="selectLockoutTime" name="lockout_time">
                            {{-- 20 minute --}}
                            <option value="20" @if (Auth::guard('admin')->user()->lockout_time == 20 )
                                selected
                                @endif>
                                20 @lang('common.minute')
                                (@lang('common.recommended'))
                            </option>
                            {{-- 30 minute --}}
                            <option value="30" @if (Auth::guard('admin')->user()->lockout_time == 30 )
                                selected
                                @endif>
                                30 @lang('common.minute')
                            </option>
                            {{-- 60 minute --}}
                            <option value="60" @if (Auth::guard('admin')->user()->lockout_time == 60 )
                                selected
                                @endif>
                                60 @lang('common.minute')
                            </option>
                            {{-- 120 minute --}}
                            <option value="120" @if (Auth::guard('admin')->user()->lockout_time == 120 )
                                selected
                                @endif>
                                120 @lang('common.minute')
                            </option>
                            {{-- 0 minute --}}
                            <option value="0" @if (Auth::guard('admin')->user()->lockout_time == 0 )
                                selected
                                @endif>
                                @lang('common.never')
                                (@lang('common.notRecommended'))
                            </option>
                        </select>
                    </div>
                </div>
                {{-- admin lang--}}
                <div class="col-md-12 p-0">
                    <div class="form-group mb-3">
                        <label for="language">@lang('common.language')</label>
                        <select class="form-control" id="language" name="language">
                            @foreach ($global->language as $item)
                            <option value="{{ $item->language }}" @if ($global->adminResourceLocale == $item->language )
                                selected
                                @endif>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-orange">
                    @lang('common.save')
                </button>
            </form>
        </div>
        <hr class="mt-0" />
    </div>
</div>