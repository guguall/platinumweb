$(document).ready(function () {


            $(".linhaVenda td:nth-child(1)").html("<img src='../img/item.png' width='16' heigth='16' class='btnDetalhe'/>");

            $(".btnDetalhe").click(function () {
                var indice = $(this).parent().parent().index();
                var detalhe = $(this).parent().parent().next();
                var status = $(detalhe).css("display");
                if (status == "none")
                    $(detalhe).css("display", "table-row");
                else
                    $(detalhe).css("display", "none")
            });




});





