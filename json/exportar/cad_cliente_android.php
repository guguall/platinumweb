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
    
    $resultado = $cliente->c_gravar_cliente_do_android();

    if ($resultado) {

        $cliBean = $cliente->c_buscar_cliente_por_chave($_POST["cli_chave"]);
        $resposta["clientes_array"] = array();

        $cli = array();
        $cli["cli_codigo"] = $cliBean->getCli_codigo();
        $cli["cli_nome"] = $cliBean->getCli_nome();
        $cli["cli_fantasia"] = $cliBean->getCli_fantasia();
        $cli["cli_endereco"] = $cliBean->getCli_endereco();
        $cli["cli_bairro"] = $cliBean->getCli_bairro();
        $cli["cli_cep"] = $cliBean->getCli_cep();
        $cli["cid_nome"] = $cliBean->getCid_nome();
        $cli["cli_contato"] = $cliBean->getCli_contato();
        $cli["cli_nascimento"] = $cliBean->getCli_nascimento();
        $cli["cli_cpfcnpj"] = $cliBean->getCli_cpfcnpj();
        $cli["cli_rginscricaoest"] = $cliBean->getCli_rginscricaoest();
        $cli["cli_email"] = $cliBean->getCli_email();
        $cli["cli_chave"] = $cliBean->getCli_chave();
        array_push($resposta["clientes_array"], $cli);
        
        echo json_encode($resposta);
        
    }
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>


