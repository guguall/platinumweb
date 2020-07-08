<?php
require_once '../../Util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);


require_once '../../include/auto_load_path_2.php';


$vendac = new VendaCInstance();
$vendacBean = new VendaCBean();


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : 0 );
$codigo = (isset($_POST["vendac_chave"])) ? $_POST["vendac_chave"] : ((isset($_GET["vendac_chave"])) ? $_GET["vendac_chave"] : 0 );


if ($codigo > 0) {
    $vendacBean = $vendac->c_busca_venda_por_chave($codigo);
}

if ($acao != "") {
    if ($acao == "alterar") {
        $vendac->c_atualizar_status_da_vendaC();
        header("Location:listar_todas_vendas.php");
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



        <form  method="post" action="EdicaoVendas.php">

            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
            <input type="hidden" name="vendac_chave" value="<?php echo $vendacBean->getVendac_chave() ?>" /> 

            <div class="col-xs-12 col-md-6 col-sm-12">                
                <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
            </div>

            <br/>
            <br/>
            <br/>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Número Pedido</label>                          
                <input  class="form-control input-sm"  disabled type="text" name="vendac_chave" value="<?php echo $vendacBean->getVendac_chave() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Valor da venda</label>
                <input disabled class="form-control input-sm"   type="text" name="vendac_valor"  value="<?php echo $vendacBean->getVendac_valor() ?>" />
                <input  class="form-control input-sm"   type="hidden" name="vendac_valor"  value="<?php echo $vendacBean->getVendac_valor() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1"> Data Hora venda</label>
                <input disabled class="form-control input-sm"  type="text"  maxlength="13"  name="vendac_datahoravenda"  value="<?php echo $vendacBean->getVendac_datahoravenda() ?>" />
                <input type="hidden"  name="vendac_datahoravenda"  value="<?php echo $vendacBean->getVendac_datahoravenda() ?>" />            
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Cliente</label>
                <input disabled class="form-control input-sm"   type="text" name="vendac_cli_nome"  value="<?php echo $vendacBean->getVendac_cli_nome() ?>" />
                <input  class="form-control input-sm"   type="hidden" name="vendac_cli_nome"  value="<?php echo $vendacBean->getVendac_cli_nome() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Vendedor</label>
                <input disabled class="form-control input-sm"   type="text" name="vendac_usu_nome"  value="<?php echo $vendacBean->getVendac_usu_nome() ?>" />
                <input  class="form-control input-sm"   type="hidden" name="vendac_usu_nome"  value="<?php echo $vendacBean->getVendac_usu_nome() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Forma de Pagamento</label>
                <input disabled class="form-control input-sm"   type="text" name="vendac_formapgto"  value="<?php echo $vendacBean->getVendac_formapgto() ?>" />
                <input  class="form-control input-sm"   type="hidden" name="vendac_formapgto"  value="<?php echo $vendacBean->getVendac_formapgto() ?>" />
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">  
                <label class="control-label" for="inputSuccess1">Status da venda</label>
                <select   class="form-control input-sm"     name="vendac_status"  >
                    <option  <?php echo ($vendacBean->getVendac_status() == "AGUARDANDO_ENTREGA") ? "selected" : "" ?>   value="AGUARDANDO_ENTREGA">Pedido aguardando entrega</option>
                    <option  <?php echo ($vendacBean->getVendac_status() == "AGUARDANDO_PRODUTOS") ? "selected" : "" ?> value="AGUARDANDO_PRODUTOS">Pedido aguardando produtos</option>
                    <option  <?php echo ($vendacBean->getVendac_status() == "PROCESSANDO_PAGAMENTO") ? "selected" : "" ?>  value="PROCESSANDO_PAGAMENTO">Processando pagamento</option>
                    <option  <?php echo ($vendacBean->getVendac_status() == "PREPARANDO_ENTREGA") ? "selected" : "" ?> value="PREPARANDO_ENTREGA">Preparando entrega</option>
                    <option  <?php echo ($vendacBean->getVendac_status() == "PEDIDO_ENTREGUE") ? "selected" : "" ?>   value="PEDIDO_ENTREGUE">Pedido entregue</option>
                    <option  <?php echo ($vendacBean->getVendac_status() == "EMITIR_BOLETO") ? "selected" : "" ?>   value="EMITIR_BOLETO">Emitir Boleto entregue</option>
                </select>
            </div>

        </form>      
    </body>           

</html>



