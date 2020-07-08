<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);


require_once '../../include/auto_load_path_2.php';

$usuario = new UsuarioInstance();
$usuarioBean = new UsuarioBean();
$permissoes = new PermissoesInstance();

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : 0 );
$codigo = (isset($_POST["usu_codigo"])) ? $_POST["usu_codigo"] : ((isset($_GET["usu_codigo"])) ? $_GET["usu_codigo"] : 0 );

if ($codigo > 0) {
    $usuarioBean = $usuario->c_buscar_usuario_por_codigo($codigo);
}


if ($acao != "") {

    if ($acao == "incluir") {
        $id_usuario = $usuario->c_gravar_usuario();
        $tabelas = $permissoes->c_getTabelas();
        $permissoes->c_salvar_permissao($id_usuario, $tabelas);
        header("Location:listar_usuarios.php");
    }

    if ($acao == "alterar") {
        $usuario->c_alterar_usuario();
        header("Location:listar_usuarios.php");
    }

    if ($acao == "excluir") {
        $usuario->c_deleta_usuario();
        header("Location:listar_usuarios.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt_Br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

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


        <form action="CadastroUsuarios.php" method="post" >

            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>"  />

            <input hidden="" name="usu_codigo" value="<?php echo $usuarioBean->getUsu_codigo() ?>"  />

            <?php if ($_SESSION['usu_nivel'] == "ADM"): ?>
                <div class="col-xs-12 col-md-12 col-sm-12">                
                    <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
                </div>
            <?php endif; ?>

            <br/>
            <br/>
            <br/>




            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" >Código do Usuário</label>
                <input disabled type="text" name="usu_codigo" value="<?php echo $usuarioBean->getUsu_codigo() ?>"  class="form-control" >
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Key celular</label>
                <input disabled type="text" name="usu_celkey"   class="form-control" value="<?php echo $usuarioBean->getUsu_celkey() ?>"  id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputWarning1">Nome do Usuário</label>
                <input required type="text" name="usu_nome" class="form-control" value="<?php echo $usuarioBean->getUsu_nome() ?>" id="inputWarning1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Email</label>
                <input required type="email" name="usu_email" class="form-control" value="<?php echo $usuarioBean->getUsu_email() ?>" id="inputError1">
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Celular</label>
                <input required type="text" name="usu_numerocel" class="form-control" value="<?php echo $usuarioBean->getUsu_numerocel() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Liberado</label>
                <select class="form-control" name="usu_liberado" >
                    <option value="S" >SIM</option>
                    <option value="N" >NAO</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Desconto</label>
                <input required type="text" name="usu_desconto" class="form-control" value="<?php echo $usuarioBean->getUsu_desconto() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Comissão</label>
                <input required  type="text"  name="usu_comissao" class="form-control" value="<?php echo $usuarioBean->getUsu_comissao() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Usuário</label>
                <input required type="text" name="usu_usuario" class="form-control" value="<?php echo $usuarioBean->getUsu_usuario() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Senha</label>
                <input required="" type="password" name="usu_senha" class="form-control" value="<?php echo $usuarioBean->getUsu_senha() ?>" id="inputError1">
            </div>

        </form>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>