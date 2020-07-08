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
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <title></title>
        <?php
        include_once '../obter_css.php';
        ?>

    </head>

    <body>

        <br/>
        <div class="container">
            <div class="row">

                <div class="form-group has-success  col-xs-6">
                    <p class="lead blog-description">Lista de Categorias</p>
                </div>




                <table id="tabela" class="table table-condensed table-hover">


                    <thead>
                        <tr>
                            <td >código</td>
                            <td >nome categoria</td>
                            <td >Ação</td>
                        </tr>

                    </thead> 




                    <tbody>
                        <?php
                        $categoriaBean = $categoria->c_buscaTodasCategorias();
                        $cont = count($categoriaBean);
                        foreach ($categoriaBean as $data) {
                            ?>
                            <tr>
                                <td class="blog-post-meta"><?php echo $data->getCat_codigo() ?></td>
                                <td class="blog-post-meta"><?php echo $data->getCat_descricao() ?> </td>
                                <td><a  href="CadastraCategorias.php?cat_codigo=<?php echo $data->getCat_codigo() ?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a  href="javascript:if(confirm('deseja mesmo excluir a categoria <?php echo $data->getCat_codigo() ?>')) {location='CadastraCategorias.php?acao=excluir&cat_codigo=<?php echo $data->getCat_codigo() ?>';}   "><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

                <div class="alert alert-success">
                    <strong><?php echo 'foram encontrados '.$cont . ' categoria(s).' ?></strong>
                </div>


            </div>
        </div>

</html>
