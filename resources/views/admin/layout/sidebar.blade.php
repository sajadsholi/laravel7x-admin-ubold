<div id="sidebar-menu">

    <ul class="metismenu" id="side-menu">
        {{-- dashboard --}}
        <li>
            <a href="{{ route('admin.dashboard.index') }}">
                <i class="mdi mdi-home"></i>
                <span> @lang('common.dashboard') </span>
            </a>
        </li>

        {{-- admin --}}
        @if (Auth::guard('admin')->id() == 1)
        <li class="adminLi">
            <a href="javascript: void(0);">
                <i class="mdi mdi-account"></i>
                <span> @lang('common.admin') </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.management.index') }}">@lang('common.archive')</a>
                </li>
                <li>
                    <a href="{{ route('admin.management.create') }}">@lang('common.createAdmin')</a>
                </li>
                <li>
                    <a href="{{ route('admin.role.index') }}">@lang('common.roles')</a>
                </li>
                <li>
                    <a href="{{ route('admin.logsActivity.index') }}">@lang('common.logsActivity')</a>
                </li>

            </ul>
        </li>
        @endif

        {{-- definition --}}
        @if (Permission::can('addBusinessCategory') || Permission::can('editBusinessCategory') ||
        Permission::can('deleteBusinessCategory') || Permission::can('addLocation') || Permission::can('editLocation')
        || Permission::can('deleteLocation'))
        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-layers-outline"></i>
                <span> @lang('common.definition') </span>
                <span class="menu-arrow"></span>
            </a>
            {{-- business category --}}
            @if (Permission::can('addBusinessCategory') || Permission::can('editBusinessCategory') ||
            Permission::can('deleteBusinessCategory'))
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.businessCategory.index') }}">@lang('businessCategory.singular')</a>
                </li>
            </ul>
            @endif
            {{-- location --}}
            @if (Permission::can('addLocation') || Permission::can('editLocation') || Permission::can('deleteLocation'))
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{ route('admin.country.index') }}">@lang('common.location')</a>
                </li>
            </ul>
            @endif
        </li>

        @endif


        {{-- user --}}
        @if (Permission::can('user'))
        <li>
            <a href="{{ route('admin.user.index') }}">
                <i class="mdi mdi-account-multiple"></i>
                <span> @lang('user.plural') </span>
            </a>
        </li>
        @endif

        {{-- user --}}
        @if (Permission::can('notification'))
        <li>
            <a href="{{ route('admin.notification.index') }}">
                <i class="mdi mdi-bell"></i>
                <span> @lang('notification.singular') </span>
            </a>
        </li>
        @endif

        {{-- support --}}
        @if (Permission::can('support'))
        <li>
            <a href="{{ route('admin.support.index') }}">
                <i class="mdi mdi-email @if(sizeof($global->pendingTicket)) mdi-spin text-warning @endif"></i>
                <span> @lang('support.singular') </span>
                <span
                    class="badge badge-warning badge-pill float-right mr-3">{{ sizeof($global->pendingTicket) }}</span>
            </a>
        </li>
        @endif

        {{-- settings --}}
        @if (Permission::can('generalSettings') || Permission::can('applicationSettings') ||
        Permission::can('contactUs') || Permission::can('aboutUs') ||
        Permission::can('termsOfService') || Permission::can('addFaq') || Permission::can('editFaq') ||
        Permission::can('deleteFaq') || Permission::can('addPage') || Permission::can('editPage') ||
        Permission::can('deletePage'))
        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-settings"></i>
                <span> @lang('common.settings') </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                @if (Permission::can('generalSettings'))
                <li>
                    <a href="{{ route('admin.settings.index') }}">@lang('common.generalSettings')</a>
                </li>
                @endif
                @if (Permission::can('applicationSettings'))
                <li>
                    <a href="{{ route('admin.application.settings.index') }}">@lang('applicationSettings.singular')</a>
                </li>
                @endif
                @if (Permission::can('contactUs'))
                <li>
                    <a href="{{ route('admin.contact.index') }}">@lang('contactUs.singular')</a>
                </li>
                @endif
                @if (Permission::can('aboutUs'))
                <li>
                    <a href="{{ route('admin.about.index') }}">@lang('aboutUs.singular')</a>
                </li>
                @endif
                @if (Permission::can('termsOfService'))
                <li>
                    <a href="{{ route('admin.termsOfService.index') }}">@lang('termsOfService.singular')</a>
                </li>
                @endif
                @if (Permission::can('addFaq') || Permission::can('editFaq') || Permission::can('deleteFaq'))
                <li>
                    <a href="{{ route('admin.faq.index') }}">@lang('faq.singular')</a>
                </li>
                @endif
                @if (Permission::can('addPage') || Permission::can('editPage') || Permission::can('deletePage'))
                <li>
                    <a href="{{ route('admin.page.index') }}">@lang('page.singular')</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>

</div>