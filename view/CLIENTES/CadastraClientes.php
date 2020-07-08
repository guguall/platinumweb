<?php
require_once '../../util/Util.php';
require_once '../config.php';
if (!Util::session_existe()) {
    header("Location:" . FACA_LOGIN);
    exit();
}

error_reporting(E_ALL ^ E_NOTICE);

require_once '../../include/auto_load_path_2.php';

$cliente = new ClienteInstance();
$clienteBean = new ClienteBean();

$usuario = new UsuarioInstance();
$usuarioBean = new UsuarioBean();


$permissoes = PermissoesDao::getPermission_in_table($_SESSION['usu_codigo'], 'clientes');


$acao = (isset($_POST["acao"])) ? $_POST["acao"] : ((isset($_GET["acao"])) ? $_GET["acao"] : 0 );
$codigo = (isset($_POST["cli_codigo"])) ? $_POST["cli_codigo"] : ((isset($_GET["cli_codigo"])) ? $_GET["cli_codigo"] : 0 );

if ($codigo > 0) {
    $clienteBean = $cliente->c_buscar_cliente_por_codigo($codigo);
}




if ($acao != "") {

    if ($acao == "incluir") {
        $cliente->c_gravar_cliente();
        header("Location:Listar_clientes.php");
    }

    if ($acao == "alterar") {
        $cliente->c_alterar_cliente_WEB();
        header("Location:Listar_clientes.php");
    }

    if ($acao == "excluir") {
        $cliente->c_excluir_cliente();
        header("Location:Listar_clientes.php");
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
        <title></title>

        <?php
        include_once '../obter_css.php';
        ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="ajax_buscar_cidades.js"></script>


    </head>
    <body>


        <form action="CadastraClientes.php" method="post" id="form_cadastra_cliente" >

            <input type="hidden" name="acao" value="<?php echo ($codigo > 0) ? "alterar" : "incluir" ?>"  />
            <input hidden="" name="cli_codigo" value="<?php echo $clienteBean->getCli_codigo() ?>"  />
            <input hidden="" name="cli_chave" value="<?php echo $clienteBean->getCli_chave() ?>"  />
            <input hidden="" name="cid_codigo" value="<?php echo $clienteBean->getCid_codigo() ?>"  />


            <?php if ($permissoes['inserir'] == "S"): ?>
                <div class="col-xs-12 col-md-12 col-sm-12">                
                    <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil-alt" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
                </div>
            <?php endif; ?>
<!--
            <?php if ($permissoes['atualizar'] == "S"): ?>
                <div class="col-xs-12 col-md-12 col-sm-12">                
                    <button type="submit" class="<?php echo ($codigo > 0) ? "btn btn-warning" : "btn btn-success" ?>"><i class="<?php echo ($codigo > 0) ? "fa fa-pencil-alt" : "fa fa-floppy-o" ?>"></i> <?php echo ($codigo > 0) ? "Alterar" : "Salvar" ?></button>               
                </div>
            <?php endif; ?>
-->
            <br/>
            <br/>
            <br/>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" >Código do Usuário</label>
                <input disabled type="text" name="cli_codigo" value="<?php echo $clienteBean->getCli_codigo() ?>"  class="form-control" >
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" >Identificador</label>
                <input disabled type="text" name="cli_chave" value="<?php echo $clienteBean->getCli_chave() ?>"  class="form-control" >
            </div>  

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputSuccess1">Estado</label>
                <select  data-toggle="tooltip" data-placement="bottom" title="selecione um estado para a cidade" class="form-control input-sm"   id="cid_uf"   name="cid_uf" >                       
                    <option  value="TT">[ --Selecione o estado-- ]</option>
                    <option  value="SP">Sao Paulo</option>
                    <option  value="RJ">Rio de Janeiro</option>
                    <option  value="AC">Acre</option>
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
                <label class="control-label" for="inputError1">Cidade  <?php echo $clienteBean->getCid_nome() ?>  </label>
                <select class="form-control" name="cid_codigo" id="cid_codigo" >

                    <option value="<?php echo $clienteBean->getCid_codigo() ?>" > <?php echo $clienteBean->getCid_nome() ?>  </option>

                </select>
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputWarning1">Nome do Cliente</label>
                <input required type="text" name="cli_nome" class="form-control" value="<?php echo $clienteBean->getCli_nome() ?>" id="inputWarning1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Nome Fantasia</label>
                <input required type="text" name="cli_fantasia" class="form-control" value="<?php echo $clienteBean->getCli_fantasia() ?>" id="inputError1">
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Endereço</label>
                <input required type="text" name="cli_endereco" class="form-control" value="<?php echo $clienteBean->getCli_endereco() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Contato</label>
                <input required type="text" name="cli_contato" class="form-control" value="<?php echo $clienteBean->getCli_contato() ?>" id="inputError1">
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Data Nasc.</label>
                <input required type="date" name="cli_nascimento" class="form-control" value="<?php echo $clienteBean->getCli_nascimento() ?>" id="inputError1">
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">CPF / CNPJ</label>
                <input required type="text" name="cli_cpfcnpj" class="form-control" value="<?php echo $clienteBean->getCli_cpfcnpj() ?>" id="inputError1">
            </div>



            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Rg/Insc.Est</label>
                <input required type="text" name="cli_rginscricaoest" class="form-control" value="<?php echo $clienteBean->getCli_rginscricaoest() ?>" id="inputError1">
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">E-mail</label>
                <input required type="email" title="Email inválido!" name="cli_email" class="form-control" value="<?php echo $clienteBean->getCli_email() ?>" id="inputError1">
            </div>


            <div class="col-xs-12 col-md-6 col-sm-12">
                <label class="control-label" for="inputError1">Bairro</label>
                <input required type="text" name="cli_bairro" class="form-control" value="<?php echo $clienteBean->getCli_bairro() ?>" id="inputError1">
            </div>



            <div class="col-xs-12 col-md-6 col-sm-6">
                <label class="control-label" for="inputError1">Cep</label>
                <input required type="text" name="cli_cep" class="form-control" value="<?php echo $clienteBean->getCli_cep() ?>" id="inputError1">
            </div>

            <div class="col-xs-12 col-md-12 col-sm-12">
                <label class="control-label" for="inputError1">Vendedor</label>
                <select class="form-control" name="usu_codigo" >                 

                    <?php
                    $usuarioBean = $usuario->c_buscar_todos_os_usuarios();
                    foreach ($usuarioBean as $user) {
                        ?>
                        <option    <?php echo ($clienteBean->getUsu_codigo() == $user->getUsu_codigo()) ? "selected" : "" ?>    value="<?php echo $user->getUsu_codigo() ?>" >  <?php echo $user->getUsu_nome() ?>  </option>
                        <?php
                    }
                    ?>
                </select>
            </div>


        </form>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>