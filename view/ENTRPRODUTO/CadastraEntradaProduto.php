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

$entrada = new EntradaProdutoInstance();
$entradaBean = new EntradaProdutoBean();

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : 0 );
$codigo = (isset($_POST["ent_id"])) ? $_POST["ent_id"] : ((isset($_GET["ent_id"])) ? $_GET["ent_id"] : 0 );

if ($codigo > 0) {
    $entradaBean = $entrada->c_buscar_entradaproduto_porcodigo();
}




if ($acao != "") {

    if ($acao == "incluir") {
        $entrada->c_gravarentradaproduto();
        header('Location:ListaEntradaProdutos.php');
    }

    if ($acao == "alterar") {
        $entrada->c_alterarentradaproduto();
        header('Location:ListaEntradaProdutos.php');
    }

    if ($acao == "excluir") {
        $entrada->c_excluirEntradaProduto();
        header('Location:ListaEntradaProdutos.php');
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




        <form name="frm_produtos"  method="post" action="CadastraEntradaProduto.php">


            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
            <input type="hidden" name="ent_id" value="<?php echo $entradaBean->getEnt_id()  ?>" /> 


            <div class="col-xs-12 col-md-6 col-sm-12">                
                <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
            </div>

            <br/>
            <br/>
            <br/>
            <div class="alert alert-danger" id="alerta"   role="alert">O campo margem e valor unitario não podem estar vazios</div>


            <br/>
            <br/>

            <div class="col-xs-12 col-md-12 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Código Entrada</label>                          
                <input  class="form-control input-sm"  disabled type="text" name="ent_id" value="<?php echo $entradaBean->getEnt_id() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Numero da nota:</label>
                <input  class="form-control input-sm"  type="text" required maxlength="13"  placeholder="numero nota" name="ent_numeronota"  value="<?php echo $entradaBean->getEnt_numeronota() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Produto</label>
                <select   class="form-control input-sm" name="ent_prd_codigo"  >

                    <?php
                    $produtoBean = $produto->c_buscar_produtos();
                    foreach ($produtoBean as $prod) {
                        ?>
                        <option    <?php echo ($entradaBean->getEnt_prd_codigo() == $prod->getPrd_codigo()) ? "selected" : "" ?>          value="<?php echo $prod->getPrd_codigo() ?>" >   <?php echo $prod->getPrd_descricao() ?>    </option>

                        <?php
                    }
                    ?>
                </select>
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Valor Unitário:</label>
                <input  class="form-control input-sm"  type="number " required   placeholder="custo" name="ent_unitario" id="valor"  value="<?php echo $entradaBean->getEnt_unitario() ?>" />
            </div>




            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> margem:</label>
                <input  class="form-control input-sm"  type="number" required   size="5"  id="porcentagem"  placeholder="margem" name="ent_margem"  value="<?php echo $entradaBean->getEnt_margem() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Preço Produto :</label>
                <input  class="form-control input-sm"  type="text" required   size="5"  id="acrescimo"  name="ent_valorvenda"  value="<?php echo $entradaBean->getEnt_valorvenda() ?>" />


            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Quantidade:</label>
                <input  class="form-control input-sm"     type="number" required   placeholder="estoque" name="ent_quantidade"  value="<?php echo $entradaBean->getEnt_quantidade() ?>" />
            </div>


            <!--
            <div class="col-xs-12 col-md-6 col-sm-12">             
                <button type="button"  id="calcular"   class="btn btn-primary btn-sm">Calcular</button>            
            </div>
            -->



        </form>


        </div>

        <script src="../js/jquery.min.js"></script>
        <script src="../js/calcular_auto.js"></script>

    </body>           

</html>




