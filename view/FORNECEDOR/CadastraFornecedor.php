<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$fornecedor = new FornecedoresInstance();
$fornBean = new FornecedoresBean();



$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : "");
$codigo = (isset($_POST["for_codigo"])) ? $_POST["for_codigo"] : ((isset($_GET["for_codigo"])) ? $_GET["for_codigo"] : 0);

$retorno = (isset($_POST["retorno"])) ? $_POST["retorno"] : ((isset($_GET["retorno"])) ? $_GET["retorno"] : "");

if ($codigo > 0) {
    $fornBean = $fornecedor->c_BuscarFornecedorPorCodigo();
}

if ($acao != "") {

    if ($acao == "incluir") {
        $fornecedor->c_gravarFornecedores();
        header("Location:ListaFornecedor.php");
    }

    if ($acao == "alterar") {
        $fornecedor->c_editarFornecedores();
        header("Location:ListaFornecedor.php");
    }

    if ($acao == "excluir") {
        $fornecedor->c_excluirFornecedor();
        header("Location:ListaFornecedor.php");
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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="ajax_buscar_cidades.js"></script>
    </head>
    <body>


        <form class="form-group" name="frm_fornecedor" id="frm_fornecedor" method="post" action="CadastraFornecedor.php">

            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>" />
            <input type="hidden" name="for_codigo" value="<?php echo $fornBean->getFor_codigo() ?>" />
            <input hidden="" name="cid_codigo" value="<?php echo $fornBean->getCid_codigo() ?>"  />

            <div class="col-xs-12 col-md-12 col-sm-12">               
                <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fas fa-pencil-alt" : "fas fa-floppy-alt" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
            </div>

            <br/>
            <br/>
            <br/>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputSuccess1">Estado</label>
                <select  data-toggle="tooltip"  class="form-control input-sm"   id="cid_uf"   name="cid_uf" >                       
                    <option  value="TT">[ --Selecione o estado-- ]</option>
                    <option  value="SP">Sao Paulo</option>
                    <option  value="RJ">Rio de Janeiro</option>
                    <option  value="AC" >Acre</option>
                    <option  value="AL">Alagoas</option>                        
                    <option  value="AP">Amapa</option>
                    <option  value="AM">Amazonas</option>
                    <option  value="BA">Bahia</option>
                    <option  value="CE">Ceara</option>
                    <option  value="DF">Distrito Federal</option>
                    <option  value="GO">Goias</option>
                    <option  value="ES">Espirito Santo</option>
                    <option  value="MA">Maranhao</option>
                    <option  value="MT">Mato Grosso</option>
                    <option  value="MS">Mato Grosso do Sul</option>
                    <option  value="MG">Minas Gerais</option>
                    <option  value="PA">Para</option>
                    <option  value="PB">Paraiba</option>
                    <option  value="PR">Paraná</option>
                    <option  value="PE">Pernambuco</option>
                    <option  value="PI">Piaui­</option>                        
                    <option  value="RN">Rio Grande do Norte</option>
                    <option  value="RS">Rio Grande do Sul</option>
                    <option  value="RO">Rondonia</option>
                    <option  value="RR">Roraima</option>                        
                    <option  value="SC">Santa Catarina</option>
                    <option  value="SE">Sergipe</option>
                    <option  value="TO">Tocantins</option>
                </select>
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputSuccess1">Cidade</label>  

                <select   class="form-control input-sm" required  id="cid_codigo"    name="cid_codigo"  >
                    <option value="<?php echo $fornBean->getCid_codigo() ?>" > <?php echo $fornBean->getCid_nome() ?>  </option>
                </select>


            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Razão social:</label>
                <input class="form-control input-sm"  type="text"   required   placeholder="razão social" name="for_razaosocial"  value="<?php echo $fornBean->getFor_razaosocial() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Nome Fantasia:</label>
                <input class="form-control input-sm"  type="text"      required   placeholder="fantasia" name="for_fantasia"  value="<?php echo $fornBean->getFor_fantasia() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >CPF/CNPJ:</label>
                <input class="form-control input-sm"  type="text"     required   placeholder="CNPJ" name="for_cnpjcpf"  value="<?php echo $fornBean->getFor_cnpjcpf() ?>" />
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputSuccess1">E-mail</label>  
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input class="form-control input-sm"  type="text"     placeholder="Email" name="for_email"  value="<?php echo $fornBean->getFor_email() ?>" />
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Endereço:</label>
                <input class="form-control input-sm"  type="text"    required   placeholder="endereço" name="for_endereco"  value="<?php echo $fornBean->getFor_endereco() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Bairro:</label>
                <input class="form-control input-sm"  type="text"    required   placeholder="bairro" name="for_bairro"  value="<?php echo $fornBean->getFor_bairro() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Cep:</label>
                <input class="form-control input-sm"  type="text"    required   placeholder="CEP" name="for_cep"  value="<?php echo $fornBean->getFor_cep() ?>" />
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label   class="control-label" for="inputSuccess1" >Contato 1 (telefone fixo):</label>
                <input class="form-control input-sm"  type="text"    required  placeholder="telefone fixo Ex:(16)3816-1955" id="for_contato1" name="for_contato1" value="<?php echo $fornBean->getFor_contato1() ?>" />
            </div>



        </form>                


        </div>
        <script src="../js/google.apis.js"></script>
        <script src="../js/bootstrap.min.js"></script>







    </body>           

</html>
