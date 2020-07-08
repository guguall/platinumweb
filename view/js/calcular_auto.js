$(document).ready(function () {

    $("#alerta").hide();

    $("#porcentagem").keyup(function () {

        $("#acrescimo").val(0);
        valor = $("#valor").val().replace(',', '.');
        porcentagem = $("#porcentagem").val().replace(',', '.');


        if (valor != '') {

            valor = parseFloat(valor);
            porcentagem = parseFloat(porcentagem);

            resultado = valor * porcentagem / 100;
            acrescimo = valor + resultado;

            var val = isNaN(acrescimo);

            if (val) {
                $("#acrescimo").val(0.00);
            } else {
                $("#acrescimo").val(acrescimo.toFixed(2));
            }
        }


    })


/*
    $("#acrescimo").keyup(function () {

        $("#porcentagem").val(0);

        valor_unitario = $("#valor").val().replace(',', '.');
        valor_acrescimo = $("#acrescimo").val().replace(',', '.');

        if (valor_unitario != '') {

            valor_un = parseFloat(valor_unitario);
            valor_ac = parseFloat(valor_acrescimo);

            margem = (((valor_ac - valor_un) / valor_ac) * 100);

            var val = isNaN(margem);

            if (val) {
                $("#porcentagem").val(0);
            } else {
                $("#porcentagem").val(margem.toFixed(2));
            }


        }
    })
    
    */

})

