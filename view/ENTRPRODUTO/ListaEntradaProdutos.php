<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$entradaBean = new EntradaProdutoBean();
$entrada = new EntradaProdutoInstance();
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


        <link href="../css/estilo_impressao.css" rel="stylesheet">


        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">




    </head>
    <body>


        <div class="row">
            <div class="col-lg-12">

                <h3>Entrada de Produtos</h3>
                <div class="panel panel-default">

                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Produto</th>
                                        <th>Nº Nota</th>
                                        <th>Data Entrada</th>
                                        <th>Val.Unit</th>
                                        <th>Val.Venda</th>
                                        <th>Margem %</th>      
                                        <th>Quant.</th>   
                                        <th>Alterar</th>
                                        <th>Excluir</th>                                   
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $entradaBean = $entrada->c_buscar_todas_as_entradasprodutos();



                                    foreach ($entradaBean as $ent) {
                                        ?>
                                        <tr class="odd gradeA">
                                            <td><?php echo $ent->getEnt_id() ?></td>
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_prd_codigo() ?></td>
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_numeronota() ?></td>  
                                            <td class="listagem_vendas"><?php echo Util::format_data_DD_MM_AAAA($ent->getEnt_dataentrada()) ?></td>
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_unitario() ?></td>                              
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_valorvenda() ?></td>
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_margem() . '%' ?></td>
                                            <td class="listagem_vendas"><?php echo $ent->getEnt_quantidade() ?></td>
                                            <td><a  href="CadastraEntradaProduto.php?ent_id=<?php  echo $ent->getEnt_id() ?>"><i class="fa fa-pencil"></i></a></td>
                                            <td><a  href="javascript:if(confirm('deseja excluir a entrada da nota numero <?php echo $ent->getEnt_numeronota() ?> ')) {location='CadastraEntradaProduto.php?acao=excluir&ent_id=<?php echo $ent->getEnt_id()  ?>';}   "><i class="fa fa-trash-o"></i></a></td>

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
