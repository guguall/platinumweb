<?php
require_once '../../util/Util.php';
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

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="container ">          
            <h1>Lista de usuários</h1>
            <table class="table table-hover">

                <thead>
                    <tr>
                        <td>nome</td>
                        <td>email</td>
                        <td>celular</td>
                        <td>Desconto</td>
                        <td>Comissão</td>                            
                        <td>Usuário</td>                          
                        <td>Ação</td>
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

                        <tr>
                            <td><?php echo $user->getUsu_nome() ?></td>
                            <td><?php echo $user->getUsu_email() ?></td>
                            <td><?php echo $user->getUsu_numerocel() ?></td>                               
                            <td><?php echo $user->getUsu_desconto() ?></td>
                            <td><?php echo $user->getUsu_comissao() ?></td>                              
                            <td><?php echo $user->getUsu_usuario() ?></td>
                            <td><a href="CadastroUsuarios.php?usu_codigo=<?php echo $user->getUsu_codigo() ?>"><i class="fas fa-pencil-alt"></i></a></td>
                            <td><a href="javascript:if(confirm('deseja mesmo excluir usuario <?php echo $user->getUsu_codigo() ?>')) {location='CadastroUsuarios.php?acao=excluir&usu_codigo=<?php echo $user->getUsu_codigo() ?>';} "><i class="fas fa-trash-alt"></i></a></td>

                        </tr>


                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="alert alert-success" role="alert"><?php echo 'foram encontrados ' . $count . ' registros' ?></div>

    </body>
</html>