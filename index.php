<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);


if ($_POST) {
                
    require_once './include/auto_load_path_1.php';

    $usuario = new UsuarioInstance();
    $usuarioBean = new UsuarioBean();
    $usuarioBean = $usuario->c_buscar_registro_por_usuario_senha();
    


    if (!is_null($usuarioBean->getUsu_usuario()) && !is_null($usuarioBean->getUsu_senha())) {

        session_start();
        //150 = 2.3
        //300 =  5 minutos
        //600 = 10 minutos
        //1200 =  20 minutos
        //2400 =  40 minutos        
        // vai armazenar a hora exata do login 15:10:30
        date_default_timezone_set('America/Sao_Paulo');
        $_SESSION['hora_ultimo_acesso'] = date("Y-n-j H:i:s");
        $_SESSION['TEMPO_DA_SESSAO'] = 2400; // equivale a 40 minutos        
        $_SESSION["usu_codigo"] = $usuarioBean->getUsu_codigo();
        $_SESSION["usu_nome"] = $usuarioBean->getUsu_senha();
        $_SESSION["usu_usuario"] = $usuarioBean->getUsu_usuario();
        $_SESSION["usu_email"] = $usuarioBean->getUsu_email();
        $_SESSION['usu_nivel'] = $usuarioBean->getUsu_nivel();
        header("Location:view/administracao.php");
    } else {
        header("Location:index.php?erro=1");
    }
}
?>

<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="view/img/cmdvic.png">

        <title>Curso AppVendas</title>

        <!-- Bootstrap core CSS -->
        <?php
        include_once './view/config.php';
        include_once './view/obter_css.php';
        ?>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/css/signin.css" media="screen">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <form class="form-signin" method="post" action="index.php">
                <h2 class="form-signin-heading">Acesso restrito</h2>
                <label for="inputEmail" class="sr-only">Usuário</label>
                <input type="text" name="usu_usuario"  class="form-control" placeholder="Usuário" required  autofocus>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" name="usu_senha" class="form-control" placeholder="senha" required>

                <button class="btn btn-lg btn-primary btn-block" type="submit"> <i class="fa fa-sign-in"></i> Entrar no sistema</button>
            </form>
            <?php
            switch ($_GET["erro"]) {

                case 1:
                    echo '<a href="#" class="btn btn-default btn-block"  value="">Erro de login e senha </a>';
                    break;

                case 2:
                    echo '<a href="#" class="btn btn-danger btn-block"  value="">Impossível acessar a página sem login </a>';
                    break;
            }
            ?>

        </div> <!-- /container -->


    </body>
</html>
