<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST["cli_nome"]) &&
        isset($_POST["cli_fantasia"]) &&
        isset($_POST["cli_endereco"]) &&
        isset($_POST["usu_codigo"]) &&
        isset($_POST["cli_cep"]) &&
        isset($_POST["cid_codigo"]) &&
        isset($_POST["cli_contato"])) {


    require_once '../../include/auto_load_path_2.php';
    $cliente = new ClienteInstance();
    $cliBean = new ClienteBean();

    // verificando se este cliente com este codigo ja existe no mysql
    $cliBean = $cliente->c_buscar_cliente_por_codigo($_POST["cli_codigo"]);
    if (is_null($cliBean->getCli_codigo())) {

        $cliente->c_gravar_cliente_do_android();
        $cliBean = $cliente->c_buscar_cliente_por_chave($_POST["cli_chave"]);


        $resposta["sucesso"] = 1;
        $resposta["cli_codigo"] = $cliBean->getCli_codigo();
        $resposta["cli_chave"] = $cliBean->getCli_chave();
        
        echo json_encode($resposta);
    } else {
        
        $cliente->c_alterar_cliente_ANDROID();
        
    }
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>


