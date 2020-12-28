$(function() {

    $('.categoryCheckbox').on('click', function() {
        var category_id = $(this).val();
        if ($(this).prop('checked')) {
            $(`input[data-category=${category_id}]`).prop('checked', true);
        } else {
            $(`input[data-category=${category_id}]`).prop('checked', false);
        }
    });

    $('input[name*=permission_id]').on('click', function() {
        var category_id = $(this).data('category');
        if ($(this).prop('checked')) {
            var inputs = $('input[name*=permission_id]').filter(`[data-category=${category_id}]`);
            var checks = $('input[name*=permission_id]').filter(`[data-category=${category_id}]:checked`);
            if (inputs.length <= checks.length) {
                $(`.categoryCheckbox[value=${category_id}]`).prop('checked', true);
            }

        } else {
            $(`.categoryCheckbox[value=${category_id}]`).prop('checked', false);
        }
    });

    var category_id = 0;
    $.each($('.categoryCheckbox'), function(indexInArray, valueOfElement) {
        if (category_id == $(this).val()) {
            return;
        } else {
            category_id = $(this).val();
            var inputs = $('input[name*=permission_id]').filter(`[data-category=${category_id}]`);
            var checks = $('input[name*=permission_id]').filter(`[data-category=${category_id}]:checked`);
            if (inputs.length <= checks.length) {
                $(`.categoryCheckbox[value=${category_id}]`).prop('checked', true);
            } else {
                $(`.categoryCheckbox[value=${category_id}]`).prop('checked', false);
            }
        }
    });

});