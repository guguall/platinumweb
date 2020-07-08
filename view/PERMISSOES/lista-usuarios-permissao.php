<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);
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
                                <th>nome</th>
                                <th>email</th>
                                <th>celular</th>
                                <th>Desconto</th>
                                <th>Comissão</th>                            
                                <th>Usuário</th>                          
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../../include/auto_load_path_2.php';
                            $usuario = new UsuarioInstance();
                            $usuarioBean = new UsuarioBean();
                            $usuarioBean = $usuario->c_buscar_todos_os_usuarios();
                            $count = count($usuarioBean);
                            foreach ($usuarioBean as $user) {
                                ?>
                                <tr class="odd gradeA">                                                        
                                    <td class="listagem_vendas"><?php echo $user->getUsu_nome() ?></td>
                                    <td class="listagem_vendas"><?php echo $user->getUsu_email() ?></td>  
                                    <td class="listagem_vendas"><?php echo $user->getUsu_numerocel() ?></td>
                                    <td class="listagem_vendas"><?php echo $user->getUsu_desconto() ?></td>                              
                                    <td class="listagem_vendas"><?php echo $user->getUsu_comissao() ?></td>
                                    <td class="listagem_vendas"><?php echo $user->getUsu_usuario() ?></td>

                                    <td>
                                        <a  class="btn btn-primary btn-sm" href="../PERMISSOES/permissao.php?usu_codigo=<?php echo  $user->getUsu_codigo() ?>"><i class="fa fa-lock"></i> </a>
                                    </td>

                                </tr>
                            <?php } ?>
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