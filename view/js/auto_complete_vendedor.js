var MIN_LENGTH = 2;

$(document).ready(function () {


    $("#usu_nome").keyup(function () {

        var usuario = $("#usu_nome").val();

        if (usuario.length >= MIN_LENGTH) {
            $.get("busca_vendedor_auto_complete.php", {usu_nome: usuario})
                    .done(function (data) {

                        $('#resultado').html('');
                        var results = jQuery.parseJSON(data);

                        $(results).each(function (key, value) {
                            $('#resultado').append('<div class="item">' + value + '</div>');
                        })

                        $('.item').click(function () {
                            var text = $(this).html();
                            $('#usu_nome').val(text);
                        })

                    });
        } else {
            $('#resultado').html('');
        }
    });

    $('#usu_nome').blur(function () {
        $('#resultado').fadeOut(500);
    }).focus(function () {
        $('#resultado').show();
    });
});




