<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->dir }}">
<?php $ver = "0.0.1"; ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@lang('user.plural')</title>
    <link href="{{ asset('asset') }}/admin/css/print.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <table class="table text-center-table">
        <thead>
            <tr>
                <th>@lang('user.field.fullname') </th>
                <th>@lang('user.field.mobile')</th>
                <th>@lang('common.createdAt')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    {{ $item->fullname }}
                </td>
                <td>
                    {{ $item->mobile }}
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
@if (Request::query('download') == 'pdf')
<script>
    window.onload = function() {
        window.print();
        window.document.close();
    }
</script>
@endif

</html>