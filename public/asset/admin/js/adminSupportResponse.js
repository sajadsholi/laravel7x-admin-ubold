$(function() {

    $('#responseButton').on('click', function() {
        $.ajax({
            type: "POST",
            url: $('#responseButton').parents('form').attr('action'),
            data: 'response=' + $('#responseMessage').val(),
            success: function(response) {
                toastr['success'](window.i18n.common.successMsg);
                $('#closeTicket').removeClass('d-none');
            },
            error: function(response) {
                toastr['error'](window.i18n.common.errorMsg);
            }
        });
    });

})