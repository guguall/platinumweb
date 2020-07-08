$(document).ready(function () {

    $("#alerta").hide();



    $("#calcular").click(function () {


        valor = $("#valor").val().replace(',', '.');
        porcentagem = $("#porcentagem").val().replace(',', '.');


        if (!valor == '' && !porcentagem == '') {
            $("#alerta").hide();


            valor = parseFloat(valor);
            porcentagem = parseFloat(porcentagem);

            resultado = valor * porcentagem / 100;
            acrescimo = valor + resultado;
            
            
           // alert(acrescimo);

            $("#acrescimo").val(acrescimo);
    

        } else {
            $("#alerta").show();
        }

    })



})

