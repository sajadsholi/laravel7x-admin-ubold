$(function() {


    $('select[name=userRange]').on('change', function() {

        value = $(this).val();
        if (value == 1) {
            $('select[name*=user_id]').parents('.col-md-6').addClass('invisible');
            $('select[name*=user_id]').prop('required', false);
        } else if (value == 2) {
            $('select[name*=user_id]').parents('.col-md-6').removeClass('invisible');
            $('select[name*=user_id]').prop('required', true);
        }

    });

});