<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../session.php';
inicializa_sessao('600', 2);

require_once '../../include/auto_load_path_2.php';
$cliente = new ClienteInstance();
$clienteBean = new ClienteBean();

$pagina = (isset($_GET['p'])) ? $_GET['p'] : 1;

$clienteBean = $cliente->c_burcar_todos_os_clientes();
$total = count($clienteBean);

$registros_por_pagina = 10;
$numPaginas = ceil($total / $registros_por_pagina);
$inicio = ($registros_por_pagina * $pagina) - $registros_por_pagina;
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


        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">




    </head>
    <body>

        <div class="row">

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Fantasia</th>
                                        <th>Vendedor</th>
                                        <th>Cidade</th>
                                        <th>Bairro</th>
                                        <th>Contato</th>
                                        <th>mail</th>
                                        <th>Alterar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $clienteBean = $cliente->c_paginacao_cliente($inicio, $registros_por_pagina);
                                    $count = count($clienteBean);
                                    foreach ($clienteBean as $cli) {
                                        ?>
                                        <tr class="odd gradeA">
                                            <td><?php echo $cli->getCli_nome() ?></td>
                                            <td><?php echo $cli->getCli_fantasia() ?></td>
                                            <td><?php echo $cli->getUsu_nome() ?></td>  
                                            <td><?php echo $cli->getCid_nome() ?></td>
                                            <td><?php echo $cli->getCli_bairro() ?></td>                              
                                            <td><?php echo $cli->getCli_contato() ?></td>
                                            <td><?php echo $cli->getCli_email() ?></td>
                                            <td><a  href="CadastraClientes.php?cli_codigo=<?php echo $cli->getCli_codigo() ?>"><i class="fa fa-pencil"></i></a></td>
                                            <td><a  href="javascript:if(confirm('deseja mesmo excluir o cliente <?php echo $cli->getCli_codigo() ?>')) {location='CadastraClientes.php?acao=excluir&cli_codigo=<?php echo $cli->getCli_codigo() ?>';}   "><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <div class="well">
                            <h4>DataTables Usage Information</h4>
                            <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                            <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
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