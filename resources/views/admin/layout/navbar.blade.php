<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        @if (Permission::can('support') && !empty($global->pendingTicket))
        @include('admin.layout.navbar.support')
        @endif

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ $global->userAvatar->path ?? $global->defaultAvatar }}"
                    alt="{{ Auth::guard('admin')->user()->fullname }}" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ Auth::guard('admin')->user()->username }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <a href="{{ route('admin.management.edit' , ['management' => Auth::guard('admin')->id() ]) }}"
                    class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>@lang('common.myAccount')</span>
                </a>
                <!-- item-->
                <a href="{{ route('admin.lock') }}" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>@lang('common.lockScreen')</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <a href="javascript:void(0);" id="logoutButton" @if(env('APP_ENV')=='local' )
                        onclick="document.getElementById('logoutForm').submit()" @endif
                        class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>@lang('common.logout')</span>
                    </a>
                </form>
            </div>
        </li>

        {{-- right sidebar button --}}
        <li class="dropdown notification-list" data-toggle="tooltip" title="@lang('common.settings')">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light text-orange">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>


    </ul>

    {{-- logo --}}
    <div class="logo-box">
        <a href="/" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ $global->setting->logo->path ?? $global->defaultLogo }}"
                    title="{{ $global->setting->name ?? '' }}" alt="{{ $global->setting->name ?? '' }}" height="40">
                {{-- <span class="logo-lg-text-light">{{ $global->setting->name ?? '' }}</span> --}}
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="{{ $global->setting->logo->path ?? $global->defaultLogo }}"
                    title="{{ $global->setting->name ?? '' }}" alt="{{ $global->setting->name ?? '' }}" height="24"
                    width="24">
            </span>
        </a>
    </div>

    @include('admin.layout.navbar.language')

</div>