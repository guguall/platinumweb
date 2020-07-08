<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);


if (isset($_POST["vendac_chave"]) && isset($_POST["vendac_cli_codigo"])) {

    require_once '../../include/auto_load_path_2.php';

    $vendac = new VendaCInstance();

    if ($vendac->c_gravar_vendaC()) {

        $resposta ["sucesso"] = 1;
        $resposta ["vendac_chave"] = $_POST["vendac_chave"];
        echo json_encode($resposta);
        
    } else {
        
        $resposta ["sucesso"] = 2;
        echo json_encode($resposta);
    }
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>

