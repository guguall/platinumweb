<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST["key"])) {


    require_once '../../include/auto_load_path_2.php';


    $produto = new ProdutoInstance();
    $produtoBean = new ProdutoBean();

    $produtoBean = $produto->c_buscar_produtos();

    $resposta["produtos_array"] = array();

    foreach ($produtoBean as $prd) {


        // impedindo de enviar pro android produtos sem estoque
        if ($prd->getPrd_quantidade() > 0) {

            $prod = array();
            $prod["prd_codigo"] = $prd->getPrd_codigo();
            $prod["prd_EAN13"] = $prd->getPrd_EAN13();
            $prod["prd_descricao"] = $prd->getPrd_descricao();
            $prod["prd_unmedida"] = $prd->getPrd_unmedida();
            $prod["prd_custo"] = $prd->getPrd_custo();
            $prod["prd_quantidade"] = $prd->getPrd_quantidade();
            $prod["prd_preco"] = $prd->getPrd_preco();
            $prod["prd_categoria"] = $prd->getCat_descricao();
            array_push($resposta["produtos_array"], $prod);
        }
    }

    echo json_encode($resposta);
} else {
    $resposta = "impossivel executar este processo";
    echo json_encode($resposta);
}




