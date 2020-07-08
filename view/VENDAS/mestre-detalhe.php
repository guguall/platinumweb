<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../session.php';
inicializa_sessao('600', 2);

require_once '../../include/auto_load_path_2.php';

$vendac = new VendaCInstance();
$vendacBean = new VendaCBean();


$vendad = new VendaDInstance();
$vendadBean = new VendaDBean();
?>


<!DOCTYPE html>
<html lang="pt_Br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">
        <!-- css do datatable -->
        <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../css/dataTables.responsive.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <style>
            .linhaItens{
                display: none;
            }
        </style>
        <link href="../css/estilo_impressao.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>


        <div class="row">
            <div class="col-lg-12">

                <h3>Exemplo com mestre-detalhe</h3>
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table  class="table table-striped table-bordered table-hover"  rules="rows">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Pedido</th>
                                        <th>Data/Hora</th>
                                        <th>Cliente</th>
                                        <th>Pag.</th>
                                        <th>Valor</th>
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $vendacBean = $vendac->c_buscar_todas_vendas();
                                    $count = count($vendacBean);
                                    foreach ($vendacBean as $venda) {
                                        ?>
                                        <tr class="linhaVenda odd gradeA">
                                            <td></td>
                                            <td><?php echo $venda->getVendac_chave() ?></td>
                                            <td><?php echo Util::format($venda->getVendac_datahoravenda()) ?></td>
                                            <td><?php echo $venda->getVendac_cli_nome() ?></td>
                                            <td><?php echo $venda->getVendac_formapgto() ?></td>
                                            <td><?php echo $venda->getVendac_valor() ?></td>
                                            <td><?php echo $venda->getVendac_status() ?></td>
                                        </tr>

                                        <tr class="linhaItens">
                                            <td colspan="5">
                                                Itens
                                                <table class="tbItens table table-striped" rules="rows">
                                                    <thead>
                                                        <tr>
                                                            <td></td>
                                                            <th>Codigo</th>
                                                            <th>Descricao</th>
                                                            <th>Quantidade</th>
                                                            <th>Valor Unitario</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $vendadBean = $vendad->c_busca_itens_da_venda($venda->getVendac_chave());
                                                        foreach ($vendadBean as $item) {
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?php echo $item->getVendad_prd_codigo() ?></td>
                                                                <td><?php echo $item->getVendad_prd_descricao() ?></td>
                                                                <td><?php echo $item->getVendad_quantidade() ?></td>
                                                                <td><?php echo $item->getVendad_preco_venda() ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>
        <!-- DataTable -->
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap.min.js"></script>
        <script src="../js/mestre-detalhe.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../js/sb-admin-2.js"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable();
            });
        </script>
    </body>
</html>