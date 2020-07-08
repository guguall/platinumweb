<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);


if (isset($_POST["vendac_chave"]) && isset($_POST["vendad_ean"])) {

    require_once '../../include/auto_load_path_2.php';

    $item = new VendaDInstance();
        
    $item->c_gravarVendaD();   

    
    
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}
?>