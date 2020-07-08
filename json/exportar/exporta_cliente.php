<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);


//http://localhost/CursoAppVendasSistemaWEB/json/exportar/exporta_cliente.php
if (isset($_POST["usu_codigo"]) && isset($_POST["exportar_todos"])) {
    
    require_once '../../include/auto_load_path_2.php';
    $cliente = new ClienteInstance();
    $clienteBean = new ClienteBean;
    $usu_codigo = $_POST["usu_codigo"];
    $exportar_todos = $_POST["exportar_todos"];

    if ($exportar_todos == "N") {
        $clienteBean = $cliente->c_buscar_clientes_do_vendedor($usu_codigo);
    }

    if ($exportar_todos == "S") {
        $clienteBean = $cliente->c_burcar_todosexportacao();
    }

    $resposta["clientes_array"] = array();

    
    foreach ($clienteBean as $cliente) {
		
				
        $cli = array();
        $cli["cli_codigo"] = $cliente->getCli_codigo();
        $cli["cli_nome"] = $cliente->getCli_nome();
        $cli["cli_fantasia"] = $cliente->getCli_fantasia();
        $cli["cli_endereco"] = $cliente->getCli_endereco();       
        $cli["cli_bairro"] = $cliente->getCli_bairro();
        $cli["cli_cep"] = $cliente->getCli_cep();
        $cli["cid_nome"] = $cliente->getCid_nome();
        $cli["cli_contato"] = $cliente->getCli_contato();
        $cli["cli_nascimento"] = $cliente->getCli_nascimento();
        $cli["cli_cpfcnpj"] = $cliente->getCli_cpfcnpj();
        $cli["cli_rginscricaoest"] = $cliente->getCli_rginscricaoest();
        $cli["cli_email"] = $cliente->getCli_email();
        $cli["cli_chave"] = $cliente->getCli_chave();
        array_push($resposta["clientes_array"], $cli);
		
    }

    echo json_encode($resposta);
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}