<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if (!empty($breadcrumb))
                    @foreach ($breadcrumb as $item)
                    @if (!$item['isLatest'])
                    <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['name'] }}</a></li>
                    @else
                    <li class="breadcrumb-item active"><a class="font-weight-bold" href="{{ $item['link'] }}">{{ $item['name'] }}</a></li>
                    @endif
                    @endforeach
                    @endif
                </ol>
            </div>
            <h4 class="page-title">@yield('title' , '')</h4>
        </div>
    </div>
</div>