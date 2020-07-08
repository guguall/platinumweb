<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$produto = new ProdutoInstance();
$produtoBean = new ProdutoBean();
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

        <div class="container-fluid">
            <div class="row">

                <div class="form-group has-success  col-xs-4">
                    <p class="lead blog-description">Lista de Produtos</p>
                </div>    

                <table id="tabela" class="table table-condensed table-hover">

                    <thead>
                        <tr>
                            <td >[ código] - [ ean-13 ]</td>
                            <td >Descricao</td>
                            <td >Categoria</td>
                           
                            <td >Custo</td>                              
                            <td >Preço Venda</td>
                            <td>Quantidade</td>
                            <td >Ação</td>
                        </tr>

                    </thead> 


                    <tbody>
                        <?php
                        $produtoBean = $produto->c_buscar_produtos();
                        $count = count($produtoBean);
                        foreach ($produtoBean as $p) {
                            ?>
                            <tr>
                                <td class="blog-post-meta"><?php echo '[ ' . $p->getPrd_codigo() . ' ] - [ ' . $p->getPrd_EAN13() . ' ]' ?></td>
                                <td class="blog-post-meta"><?php echo $p->getPrd_descricao() ?> </td> 
                                <td class="blog-post-meta"><?php echo $p->getCat_descricao() ?> </td>                             
                                <td class="blog-post-meta"><?php echo 'R$ ' . number_format($p->getPrd_custo(), 2, ',', '.') ?> </td>
                                <td class="blog-post-meta"><?php echo 'R$ ' . number_format($p->getPrd_preco(), 2, ',', '.'); ?> </td>
                                <td class="blog-post-meta"><?php echo $p->getPrd_quantidade() ?> </td>
                                <td><a  href="CadastraProdutos.php?prd_codigo=<?php echo $p->getPrd_codigo() ?>"><i class="fas fa-pencil-alt"></i></a></td>
                                <td><a  href="javascript:if(confirm('deseja mesmo excluir o produto <?php echo $p->getPrd_codigo() ?>')) {location='CadastraProdutos.php?acao=excluir&prd_codigo=<?php echo $p->getPrd_codigo() ?>';}   "><i class="fas fa-trash-alt"></i></a></td>

                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>

                <br/>
                <br/>
                <br/>
                <div class="alert alert-success">
                    <strong><?php echo 'foram encontrados ' . $count . '  produto(s)' ?></strong>
                </div> 


            </div>
        </div>

    </body>


</html>
