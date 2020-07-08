
$(document).ready(function () {



    $('#cid_uf').change(function (e) {
        var cid_uf = $('#cid_uf').val();

        $.getJSON('ajax_buscar_cidades.php?cid_uf=' + cid_uf, function (dados) {

            if (dados.length > 0) {
                var option = '<option>[ SELECIONE A CIDADE ]</option>';
                $.each(dados, function (i, obj) {

                    option += ' <option  value="' + obj.cid_codigo + '">   ' + obj.cid_nome + '  </option>';
                })

            } else {
                alert("nenhuma cidade foi encontrada com este estado")
            }
            $('#cid_codigo').html(option).show();
        })
    })

});