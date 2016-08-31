

function initAjaxForm()
{
    $('body').on('submit', '.ajaxForm', function (e) {
        e.preventDefault();
        $.post({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize()
        }).done(function (data) {
            if(!$.isEmptyObject(data.message)){
                $('.error-area').addClass('hide');
                $('.success-area').removeClass('hide');
                $('.success-area').html('Pedido encontrado!');
            }else{
                $('.success-area').addClass('hide');
                $('.error-area').removeClass('hide');
                $('.error-area').html('Nenhum pedido localizado.');
            }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.responseJSON.hasOwnProperty('form')) {
                        $('#form_body').html(jqXHR.responseJSON.form);
                    }
                    $('.form_error').html(jqXHR.responseJSON.message);

                } else {
                    console.log(errorThrown);
                }

            });
    });
}
