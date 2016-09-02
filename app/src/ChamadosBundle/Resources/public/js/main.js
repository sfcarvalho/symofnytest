function initAjaxForm()
{
    $('body').on('submit', '.ajaxForm', function (e) {
        e.preventDefault();
        $.post({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json'
        }).done(function (data) {
            if(!$.isEmptyObject(data.message)){
                $('.error-area').addClass('hide');
                $('.success-area').removeClass('hide');
                $('.success-area').html(data.message);
            }else{
                $('.success-area').addClass('hide');
                $('.error-area').removeClass('hide');
                $('.error-area').html('Pedido não localizado. Favor informar um número de pedido válido.');
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

function initAjaxSearchForm()
{
    $('body').on('submit', '.ajaxForm', function (e) {
        e.preventDefault();
        $.post({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json'
        }).done(function (data) {
            if(!$.isEmptyObject(data.message)){
                $('.error-area').addClass('hide');
                $('.success-area').removeClass('hide');
                $('.success-area').html(data.message);
            }else{
                $('.success-area').addClass('hide');
                $('.error-area').removeClass('hide');
                $('.error-area').html('Nenhum chamado localizado.');
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