<ul class="list-unstyled topnav-menu topnav-menu-left m-0" id="languageSelect">
    <li>
        <button class="button-menu-mobile waves-effect waves-light">
            <i class="fe-menu"></i>
        </button>
    </li>

    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ $global->language->where('language' , $global->lang)->first()->getMedium()->path ?? '' }}"
                class="rounded-circle" id="selectedLanguageImage">
            <span class="pro-user-name ml-1" id="selectedLanguageName">
                {{ $global->language->where('language' , $global->lang)->first()->name ?? '' }} <i
                    class="mdi mdi-chevron-down"></i>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-- item-->
            @foreach ($global->language as $item)
            <a href="Javascript:void(0);" data-lang="{{ $item->language }}"
                class="dropdown-item notify-item selectLanguage @if($item->language == $global->lang) active @endif">
                <img data-src="{{ $item->getMedium()->path ?? '' }}" class="rounded-circle mx-2" width="30px"
                    height="30px">
                <span>{{ $item->name }}</span>
            </a>
            @endforeach
        </div>
    </li>
</ul>