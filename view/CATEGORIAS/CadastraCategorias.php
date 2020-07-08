<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$categoria = new CategoriasInstance();
$categoriaBean = new CategoriasBean();


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["cat_codigo"])) ? $_POST["cat_codigo"] : ((isset($_GET["cat_codigo"])) ? $_GET["cat_codigo"] : 0);


//$nivel = "USER";


if ($codigo > 0) {
    $categoriaBean = $categoria->C_buscaCategoriasPorCodigo();
}

if ($acao != "") {

    if ($acao == "incluir") {
        $categoria->c_gravarCategorias();
        header("Location:ListaCategorias.php");
    }

    if ($acao == "alterar") {
        $categoria->c_alterarCategorias();
        header("Location:ListaCategorias.php");
    }

    if ($acao == "excluir") {
        $categoria->c_excluirCategorias();
        header("Location:ListaCategorias.php");
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <title></title>

        <?php
        include_once '../obter_css.php';
        ?>

    </head>
    <body>



        <?php //if ($nivel == "ADMIN"): ?>


            <form  name="form" id="form_categoria" method="post">

                <input type="hidden" required name="acao" id="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
                <input type="hidden"  name="cat_codigo" id="cat_codigo" value="<?php echo $categoriaBean->getCat_codigo() ?>" />



                <div class="col-xs-12 col-md-12 col-sm-12">                
                    <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
                </div>


                <br/>
                <br/>
                <br/>

                <div class="col-xs-12 col-sm-06 col-md-12">
                    <label class="control-label" for="inputSuccess1">Código</label>                          
                    <input class="form-control input-sm" type="text" disabled name="CO" id="CO" value="<?php echo $categoriaBean->getCat_codigo() ?>" />
                </div>
                <br/>
                <br/>
                <br/>


                <div class="col-xs-12 col-sm-06 col-md-12">
                    <label class="control-label"  for="inputWarning1">Nome categoria</label>
                    <input class="form-control input-sm" type="text" data-toggle="tooltip" data-placement="right" title="nome da categoria" placeholder="Descrição" required name="cat_descricao" id="cat_descricao" value="<?php echo $categoriaBean->getCat_descricao() ?>" />
                </div>

            </form>
        <?php //endif; ?>

    </body>           

</html>
