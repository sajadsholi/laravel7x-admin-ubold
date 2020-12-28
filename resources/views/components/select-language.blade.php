@if ($global->language->count() > 1)
<div class="dropdown">

    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false"><i class="mdi mdi-google-translate"></i><i class="mdi mdi-chevron-down"></i></button>
    <div class="dropdown-menu">


        @foreach ($global->language as $item)


        <a class="dropdown-item translate @if($item->language == $global->lang) active @endif" href="javascript:void(0)"
            data-lang="{{ $item->language }}" data-redirect="{{ $redirect }}">


            <img data-src="{{ $item->getMedium()->path ?? '' }}" class="rounded-circle mx-2 border-lg @if (in_array($item->language , $translation))
                border-success
                @else
                border-danger
                @endif" width="30px" height="30px">


            @if (in_array($item->language , $translation))
            @lang('common.edit')
            @else
            @lang('common.translate')
            @endif


        </a>


        @endforeach


    </div>

</div>

@else
<a href='{{ $redirect }}' class='btn btn-success' data-toggle='tooltip' title="@lang('common.edit')">
    <span class='mdi mdi-pencil'></span>
</a>


@endif