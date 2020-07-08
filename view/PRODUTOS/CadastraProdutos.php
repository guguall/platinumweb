<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$produto = new ProdutoInstance();
$produtoBean = new ProdutoBean();

$categoria = new CategoriasInstance();
$categoriaBean = new CategoriasBean();


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : 0 );
$codigo = (isset($_POST["prd_codigo"])) ? $_POST["prd_codigo"] : ((isset($_GET["prd_codigo"])) ? $_GET["prd_codigo"] : 0 );

if ($codigo > 0) {
    $produtoBean = $produto->c_buscaProdutoPorCodigo();
}




if ($acao != "") {

    if ($acao == "incluir") {
        $produto->c_gravarProduto();
        
        
        header('Location:ListaProdutos.php');
    }

    if ($acao == "alterar") {
        $produto->c_alterar_produtos();
        header('Location:ListaProdutos.php');
    }

    if ($acao == "excluir") {
        $produto->c_excluirProduto();
        header('Location:ListaProdutos.php');
    }
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>


        <title>Cadastro de Produtos</title>

        <?php
        include_once '../obter_css.php';
        ?>


    </head>
    <body>



        <form name="frm_produtos" id="frm_fornecedor" method="post" action="CadastraProdutos.php">
            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
            <input type="hidden" name="prd_codigo" value="<?php echo $produtoBean->getPrd_codigo() ?>" /> 

            
            <input type="hidden" name="prd_custo" value="<?php echo ($codigo > 0) ? $produtoBean->getPrd_custo() : 0 ?>" />            
            <input type="hidden" name="prd_preco" value="<?php echo ($codigo > 0) ? $produtoBean->getPrd_preco() : 0 ?>" />            
            <input type="hidden" name="prd_quantidade" value="<?php echo ($codigo > 0) ? $produtoBean->getPrd_quantidade() : 0 ?>" />


            <div class="col-xs-12 col-md-6 col-sm-12">                
                <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fas fa-pencil-alt" : "fas fa-floppy-alt" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
            </div>

            <br/>
            <br/>
            <br/>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Código</label>                          
                <input  class="form-control input-sm"  disabled type="text" name="prd_codigo" value="<?php echo $produtoBean->getPrd_codigo() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> EAN-13:</label>
                <input  class="form-control input-sm"  type="text" required maxlength="13"  placeholder="código de barras ean-13" name="prd_EAN13"  value="<?php echo $produtoBean->getPrd_EAN13() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Descrição do produto:</label>
                <input  class="form-control input-sm"   type="text"  required   placeholder="descrição" name="prd_descricao"  value="<?php echo $produtoBean->getPrd_descricao() ?>" />
            </div>




            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> unidade medida:</label>
                <select   class="form-control input-sm"     name="prd_unmedida"  >
                    <option <?php echo ($produtoBean->getPrd_unmedida() == "UN" ) ? "selected" : "" ?> value="UN">Unidade</option>
                    <option <?php echo ($produtoBean->getPrd_unmedida() == "CX" ) ? "selected" : "" ?> value="CX">Caixa</option>
                    <option  <?php echo ($produtoBean->getPrd_unmedida() == "LT" ) ? "selected" : "" ?> value="LT">Litro</option>
                    <option <?php echo ($produtoBean->getPrd_unmedida() == "KG" ) ? "selected" : "" ?>  value="KG">Kilo</option>
                    <option <?php echo ($produtoBean->getPrd_unmedida() == "G" ) ? "selected" : "" ?> value="G">Grama</option>

                </select>
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Custo:</label>
                <input disabled class="form-control input-sm"  type="text" required   placeholder="custo" name="prd_custo" id="prd_custo"  value="<?php echo $produtoBean->getPrd_custo() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Venda:</label>
                <input disabled  class="form-control input-sm"  type="text" required   placeholder="venda" name="prd_preco" id="prd_preco"  value="<?php echo $produtoBean->getPrd_preco() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Quantidade:</label>
                <input disabled class="form-control input-sm"     type="text" required   placeholder="estoque" name="prd_quantidade"  value="<?php echo $produtoBean->getPrd_quantidade() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Ativo:</label>
                <select   class="form-control input-sm"    name="prd_ativo"  >                           
                    <option    <?php echo ($produtoBean->getPrd_ativo() == "S" ) ? "selected" : "" ?>      value="S">SIM</option>
                    <option    <?php echo ($produtoBean->getPrd_ativo() == "N" ) ? "selected" : "" ?>       value="N">NÃO</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Fornecedor</label>
                <select   class="form-control input-sm"     name="for_codigo"  >                   
                    
                    <!--  fica de exercício para os alunos implementarem a listagem dos fornecedores aqui -->
                    
                    <option value="1" >fonecedor padrao</option>
                </select>
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Categoria</label>
                <select   class="form-control input-sm"     name="cat_codigo"  >

                    <?php
                    $categoriaBean = $categoria->c_buscaTodasCategorias();

                    foreach ($categoriaBean as $cat) {
                        ?>
                        <option <?php echo ($produtoBean->getCat_codigo() == $cat->getCat_codigo()) ? "selected" : "" ?>   value="<?php echo $cat->getCat_codigo() ?>" >   <?php echo $cat->getCat_descricao() ?>    </option>

                        <?php
                    }
                    ?>

                </select>
            </div>





        </form>


        </div>

    </body>           

</html>
