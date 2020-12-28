<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->adminDirection }}">
<?php $ver = "0.0.1"; ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@lang('common.admin')</title>
    <link href="{{ asset('asset') }}/admin/css/print.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <table class="table text-center-table">
        <thead>
            <tr>
                <th> @lang('common.name') </th>
                <th> @lang('common.role') </th>
                <th> @lang('common.createdAt') </th>
                <th> @lang('common.status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    {{ $item->fullname }}
                </td>
                <td>
                    {{ $item->role->name ?? '-' }}
                </td>
                <td>
                    {{ $item->created_at ?? '-' }}
                </td>
                <td>
                    @if ($item->isActive)
                    @lang('common.active')
                    @else
                    @lang('common.inactive')
                    @endif
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