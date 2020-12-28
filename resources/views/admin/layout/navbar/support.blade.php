<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-email noti-icon"></i>
        <span class="badge badge-warning rounded-circle noti-icon-badge">{{ sizeof($global->pendingTicket) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="m-0">
                @lang('common.support')
            </h5>
        </div>

        <div class="slimscroll noti-scroll">

            <!-- item-->
            @foreach ($global->pendingTicket as $item)
            <a href="{{ route('admin.support.show' , $item) }}" class="dropdown-item notify-item">
                <div class="notify-icon bg-warning">
                    <i class="mdi mdi-email"></i>
                </div>
                <p class="notify-details">{{ $item->user->fullname }}
                    <small class="text-muted">{{ mb_substr($item->subject , 0 , 50) }}</small>
                    <small class="text-muted">{{ $item->created_at }}</small>
                </p>
            </a>
            @endforeach
        </div>

        <!-- All-->
        <a href="{{ route('admin.support.index' , ['status_id' => 1]) }}"
            class="dropdown-item text-center text-light notify-item notify-all">
            @lang('common.show') @lang('common.all')
            <i class="fi-arrow-right"></i>
        </a>

    </div>
</li>