var MIN_LENGTH = 2;

$(document).ready(function () {


    $("#cli_nome").keyup(function () {

        var nome_cliente = $("#cli_nome").val();

        if (nome_cliente.length >= MIN_LENGTH) {
            $.get("busca_cliente_auto_complete.php", {cli_nome: nome_cliente})
                    .done(function (data) {

                        $('#resultado').html('');
                        var results = jQuery.parseJSON(data);

                        $(results).each(function (key, value) {
                            $('#resultado').append('<div class="item">' + value + '</div>');
                        })

                        $('.item').click(function () {
                            var text = $(this).html();
                            $('#cli_nome').val(text);
                        })

                    });
        } else {
            $('#resultado').html('');
        }
    });

    $('#cli_nome').blur(function () {
        $('#resultado').fadeOut(500);
    }).focus(function () {
        $('#resultado').show();
    });
});