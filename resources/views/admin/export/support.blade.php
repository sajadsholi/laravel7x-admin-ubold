<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ $global->dir }}">
<?php $ver = "0.0.1"; ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@lang('common.support')</title>
    <link href="{{ asset('asset') }}/admin/css/print.css?ver={{ $ver }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <table class="table text-center-table">
        <thead>
            <tr>
                <th> @lang('support.field.id') </th>
                <th> @lang('common.createdAt') </th>
                <th> @lang('user.singular') </th>
                <th> @lang('support.field.subject') </th>
                <th> @lang('common.status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    #{{ $item->id }}
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
                <td>
                    {{ $item->user->fullname }}
                </td>
                <td>
                    {{ $item->subject }}
                </td>
                <td>
                    @lang("support.status.".$item->status->name)
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