<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

require_once '../../include/auto_load_path_2.php';

$waiting = new BoletosBean();
$paid = new BoletosBean();
$unpaid = new BoletosBean();
$boleto = new BoletoInstance();

$waiting = $boleto->c_busca_boletos('waiting');
$paid = $boleto->c_busca_boletos('paid');
//$unpaid  = $boleto->c_busca_boletos('unpaid');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Boletos</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- css do datatable -->
        <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../css/dataTables.responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container-fluid">            
            <div class="row">
                <h2>BOLETOS</h2>
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#waiting" aria-controls="waiting" role="tab" data-toggle="tab">Aguardando Pagamento</a></li>
                        <li role="presentation"><a href="#paid" aria-controls="paid" role="tab" data-toggle="tab">Pagos</a></li>
                        <li role="presentation"><a href="#unpaid" aria-controls="unpaid" role="tab" data-toggle="tab">Não Pagos</a></li>                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="waiting">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>par_id_carne</th>
                                                    <th>par_charge_id</th>
                                                    <th>par_venc_parcela</th>
                                                    <th>par_num_parcela</th>
                                                    <th>par_status_parcela</th>
                                                    <th>par_valor_parcela</th>
                                                    <th>vendac_chave</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($waiting as $value): ?>

                                                    <tr class="odd gradeA">                                                        
                                                        <td class="listagem_vendas"><?= $value->getPar_id_carne() ?></td>
                                                        <td class="listagem_vendas"><a href="../BOLETOS/alterar-data-vencimento.php?carnet_id=<?= $value->getPar_id_carne() ?>&parcel=<?= $value->getPar_num_parcela() ?>"><?= $value->getPar_charge_id() ?></a></td>
                                                        <td class="listagem_vendas"><?= $value->getPar_venc_parcela() ?></td>
                                                        <td class="listagem_vendas"><?= $value->getPar_num_parcela() ?></td>
                                                        <td class="listagem_vendas"><?= $value->getPar_status_parcela() ?></td>
                                                        <td class="listagem_vendas"><?= $value->getPar_valor_parcela() ?></td>
                                                        <td class="listagem_vendas"><?= $value->getVendac_chave() ?></td>
                                                        <td>
                                                            <a  href="EdicaoVendas.php?vendac_chave=<?php ?>"><i class="fa fa-pencil"></i></a>
                                                            <a  href="formulario-carne.php?vendac_chave=<?php ?>"><i class="fa fa-certificate"></i></a>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- /.panel-body -->
                            </div>


                        </div>


                        <div role="tabpanel" class="tab-pane" id="paid">


                        </div>


                        <div role="tabpanel" class="tab-pane" id="unpaid">


                        </div>

                    </div>

                </div>

            </div>            
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- DataTable -->
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {


                $('#dataTables-example').DataTable({
                    responsive: true
                });



                // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                // var target = $(e.target).attr("href") // activated tab


                //});


            });



        </script>
    </body>
</html>