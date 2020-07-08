$(document).ready(function () {
    //Aplicando as mascaras nos inputs cpf, valor e vencimento.
    $("#btn_emitir_boleto").click(function () {

        if ($('#form')[0].checkValidity()) {

            $("#myModal").modal('show');
            $("#boleto").addClass("hide");

            var descricao = $("#descricao").val();
            var valor = $("#valor").val();
            var email = $("#email").val();
            var quantidade = $("#quantidade").val();
            var nome_cliente = $("#nome_cliente").val();
            var cpf = $("#cpf").val();
            var telefone = $("#telefone").val();
            var vencimento = $("#vencimento").val();
            var instrucao1 = $("#instrucao1").val();
            var instrucao2 = $("#instrucao2").val();
            var instrucao3 = $("#instrucao3").val();
            var instrucao4 = $("#instrucao4").val();
            var repeticoes = $("#repeticoes").val();
            var vendac_chave = $("#vendac_chave").val();
            var valor_parcela = $("#valor_parcela").val();

            console.log(parseInt(nome_cliente))
            console.log(parseInt(valor))
            if (parseInt(nome_cliente) == "NaN" || parseInt(valor) == "NaN") {
                $("#myModal").modal('hide');
                alert("Dados invalidos.");
                return false;
            }

            $.ajax({
                url: "../VENDAS/emitir_carne.php",
                data: {descricao: descricao, valor: valor, quantidade: quantidade, nome_cliente: nome_cliente, cpf: cpf, telefone: telefone, vencimento: vencimento, repeticoes, instrucao1, instrucao2, instrucao3, instrucao4, email: email, vendac_chave: vendac_chave},
                type: 'post',
                dataType: 'json',
                success: function (resposta) {

                    console.log(resposta)
                    $("#myModal").modal('hide');

                    if (resposta.code == 200) {

                        $("#myModalResult").modal('show');
                        $("#boleto").removeClass("hide");

                        $("#table_id_ass").html(resposta.data.carnet_id);
                        $("#table_status").html(resposta.data.status)
                        $("#table_link").html("<a class='btn btn-default' target='_blank' href=" + resposta.data.link + ">Visualizar</a>");

                        var html = "";

                        for (var i = 0; i < resposta.data.charges.length; i++) {
                            html += "<tr><td>" + resposta.data.charges[i].charge_id + "</td><td>" + resposta.data.charges[i].parcel + "</td><td>" + resposta.data.charges[i].value + "</td><td>" + resposta.data.charges[i].expire_at + "</td><td><a target='_blank'  class='btn btn-danger btn-xs' href='" + resposta.data.charges[i].url + "'>Ver</a></td></tr>"
                            salvar_boleto(resposta.data.carnet_id, resposta.data.link, resposta.data.charges[i].barcode, resposta.data.charges[i].charge_id, resposta.data.charges[i].expire_at, resposta.data.charges[i].parcel, resposta.data.charges[i].status, resposta.data.charges[i].url, valor_parcela, vendac_chave)
                        }

                        $("#charges_tb").html(html);
                        $("#modalStatus").modal('hide');

                    } else {
                        $("#myModal").modal('hide');
                        alert("Code: " + resposta.code)
                    }
                },
                error: function (resposta) {
                    $("#myModal").modal('hide');
                    alert("Ocorreu um erro - Mensagem: " + resposta.responseText)
                }
            });


        } else {
            alert("Voce devera preencher todos dados do formulario.")
        }
    })


    function salvar_boleto(par_id_carne, par_link_carne, par_barcode_parcela, par_charge_id, par_venc_parcela, par_num_parcela, par_status_parcela, par_url_parcela, par_valor_parcela, vendac_chave) {
        $.ajax({
            url: "../BOLETOS/cadastrar-boletos.php",
            data: {par_id_carne: par_id_carne, par_link_carne: par_link_carne, par_barcode_parcela: par_barcode_parcela, par_charge_id: par_charge_id, par_venc_parcela: par_venc_parcela, par_num_parcela: par_num_parcela, par_status_parcela: par_status_parcela, par_url_parcela: par_url_parcela, par_valor_parcela: par_valor_parcela, vendac_chave: vendac_chave},
            type: 'post',
            dataType: 'json',
            success: function (resposta) {
            }
        });
    }


})