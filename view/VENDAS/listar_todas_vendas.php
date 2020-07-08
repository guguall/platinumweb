<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

require_once '../../include/auto_load_path_2.php';

$vendac = new VendaCInstance();
$vendacBean = new VendaCBean();
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


        <link href="../css/estilo_impressao.css" rel="stylesheet">


        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">




    </head>
    <body>


        <div class="row">
            <div class="col-lg-12">

                <h3>Listagem de todas as vendas realizadas</h3>
                <div class="panel panel-default">

                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Data/Hora</th>
                                        <th>Cliente</th>
                                        <th>Vend.</th>
                                        <th>Pag.</th>
                                        <th>Valor</th>
                                        <th>Status</th>                                        
                                        <th>Alterar</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $vendacBean = $vendac->c_buscar_todas_vendas();
                                    $count = count($vendacBean);
                                    foreach ($vendacBean as $venda) {
                                        ?>
                                        <tr class="odd gradeA">
                                            <td><a href="imprime_venda.php?chave=<?php echo $venda->getVendac_chave() ?>&cli_codigo=<?php echo $venda->getVendac_cli_codigo() ?>"> <i class="fa fa-print fa-2x"></i> <?php echo $venda->getVendac_chave() ?></a> </td>
                                            <td class="listagem_vendas"><?php echo Util::format($venda->getVendac_datahoravenda()) ?></td>
                                            <td class="listagem_vendas"><?php echo $venda->getVendac_cli_nome() ?></td>  
                                            <td class="listagem_vendas"><?php echo $venda->getVendac_usu_nome() ?></td>
                                            <td class="listagem_vendas"><?php echo $venda->getVendac_formapgto() ?></td>                              
                                            <td class="listagem_vendas"><?php echo $venda->getVendac_valor() ?></td>
                                            <td class="listagem_vendas"><?php echo $venda->getVendac_status() ?></td>

                                            <td>
                                                <a  href="EdicaoVendas.php?vendac_chave=<?php echo $venda->getVendac_chave() ?>"><i class="fa fa-pencil"></i></a>
                                                <a  href="formulario-carne.php?vendac_chave=<?php echo $venda->getVendac_chave() ?>"><i class="fa fa-certificate"></i></a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
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


        <!-- Custom Theme JavaScript -->
        <script src="../js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>