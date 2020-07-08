<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';



if ($_GET["acao"] == "1") {
    $permissao = new PermissoesInstance();
    $permissao->c_update_permissao($_GET['campo'], $_GET['valor'], $_GET['per_codigo']);
}


$usu_codigo = $_GET['usu_codigo'];
$permissoes = PermissoesDao::getPermission($usu_codigo);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lista usuarios</title>

        <!-- Bootstrap -->
        <?php
        include_once '../obter_css.php';
        ?>

        <!-- css do datatable -->
        <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../css/dataTables.responsive.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Permissões de usuários</h4>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Tabela</th>
                                <th>inserir</th>
                                <th>atualizar</th>
                                <th>visualizar</th>
                                <th>excluir</th>                            
                                <th>relatórios</th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($permissoes as $perm) :

                                $per_codigo = $perm['per_codigo'];
                                $inserir = $perm['inserir'];
                                $atualizar = $perm['atualizar'];
                                $visualizar = $perm['visualizar'];
                                $excluir = $perm['excluir'];
                                $imprimir = $perm['imprimir_relatorios'];

                                $link_inserir = ($inserir == "S") ? "permissao.php?valor=N&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=inserir&acao=1" : "permissao.php?valor=S&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=inserir&acao=1";
                                $link_atualizar = ($atualizar == "S") ? "permissao.php?valor=N&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=atualizar&acao=1" : "permissao.php?valor=S&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=atualizar&acao=1";
                                $link_visualizar = ($visualizar == "S") ? "permissao.php?valor=N&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=visualizar&acao=1" : "permissao.php?valor=S&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=visualizar&acao=1";
                                $link_excluir = ($excluir == "S") ? "permissao.php?valor=N&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=excluir&acao=1" : "permissao.php?valor=S&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=excluir&acao=1";
                                $link_imprimir = ($imprimir == "S") ? "permissao.php?valor=N&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=imprimir_relatorios&acao=1" : "permissao.php?valor=S&per_codigo=$per_codigo&usu_codigo=$usu_codigo&campo=imprimir_relatorios&acao=1";

                                $image_inserir = ($inserir == "S") ? '<i class="fas fa-lock-open" style="color: #00CC00"></i>' : '<i class="fas fa-lock" style="color:Tomato"></i>';
                                $image_atualizar = ($atualizar == "S") ? '<i class="fas fa-lock-open" style="color: #00CC00"></i>' : '<i class="fas fa-lock" style="color:Tomato"></i>';
                                $image_visualizar = ($visualizar == "S") ? '<i class="fas fa-lock-open" style="color: #00CC00"></i>' : '<i class="fas fa-lock" style="color:Tomato"></i>';
                                $image_excluir = ($excluir == "S") ? '<i class="fas fa-lock-open" style="color: #00CC00"></i>' : '<i class="fas fa-lock" style="color:Tomato"></i>';
                                $image_imprimir = ($imprimir == "S") ? '<i class="fas fa-lock-open" style="color: #00CC00"></i>' : '<i class="fas fa-lock" style="color:Tomato"></i>';
                                ?>

                                <tr class="odd gradeA">                                                        

                                    <td class="listagem_vendas"><?php echo $perm['tabela'] ?></td>

                                    <td class="listagem_vendas"><a href="<?php echo $link_inserir ?>"> <?php echo $image_inserir ?> </a></td> 

                                    <td class="listagem_vendas"><a href="<?php echo $link_atualizar ?>"><?php echo $image_atualizar ?></a></td>                                    

                                    <td class="listagem_vendas"><a href="<?php echo $link_visualizar ?>"><?php echo $image_visualizar ?></a></td>                              

                                    <td class="listagem_vendas"><a href="<?php echo $link_excluir ?>"><?php echo $image_excluir ?></a></td>

                                    <td class="listagem_vendas"><a href="<?php echo $link_imprimir ?>"><?php echo $image_imprimir ?></a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>

        <script src="../js/jquery.min.js"></script>
        <!-- DataTable -->
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>
