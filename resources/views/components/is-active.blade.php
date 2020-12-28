@if ($status == 1)
<span class="text-success">
    @lang('common.active')
</span>
@else
<span class="text-danger">
    @lang('common.inactive')
</span>
@endif