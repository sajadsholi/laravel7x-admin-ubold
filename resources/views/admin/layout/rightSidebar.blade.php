<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right text-orange">
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
                {{-- change mode mode --}}
                <div class='col-md-12 p-0'>
                    <div class='form-group mb-3'>
                        <div class='custom-control custom-checkbox checkbox-orange'>
                            <input type='checkbox' class='custom-control-input' name="adminMode" id="changeAdminMode"
                                value="1" @if($global->adminMode== 'dark')
                            checked
                            @endif>
                            <label class='custom-control-label' for="changeAdminMode">dark mode</label>
                        </div>
                    </div>
                </div>
                {{-- number of pagination --}}
                <div class="col-md-12 p-0">
                    <div class="form-group mb-3">
                        <label for="selectPagination">@lang('common.selectPagination')</label>
                        <select class="form-control" id="selectPagination" name="adminPagin">

                            @foreach ([15 , 50 , 100 , 500] as $item)
                            <option value="{{ $item }}" @if ($global->adminPagin == $item)
                                selected
                                @endif>
                                {{ $item }} @lang('common.rows')

                                @if ($item == 15)
                                (@lang('common.recommended'))
                                @endif

                                @if ($item == 500)
                                (@lang('common.notRecommended'))
                                @endif

                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- screen lock --}}
                <div class="col-md-12 p-0">
                    <div class="form-group mb-3">
                        <label for="selectLockoutTime">@lang('common.selectLockoutTime')</label>
                        <select class="form-control" id="selectLockoutTime" name="lockout_time">
                            @foreach ([20 , 40 , 60 , 120 , 0] as $item)

                            <option value="{{ $item }}" @if (Auth::guard('admin')->user()->lockout_time == $item )
                                selected
                                @endif>
                            
                                @if ($item > 0)
                                {{ $item }} @lang('common.minute')
                                @else
                                @lang('common.never')
                                @endif

                                @if ($item == 20)
                                (@lang('common.recommended'))
                                @endif

                                @if ($item == 0)
                                (@lang('common.notRecommended'))
                                @endif
                            </option>
                            
                            @endforeach
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