<?php

// CORS PHP
header('Access-Control-Allow-Origin: *'); // permissão a qualquer chamada externa
header('Content-type: application/json'); // esperando um json

require_once '../../include/auto_load_path_2.php';


$conf = new ConfPagamentoInstance();
$conf->c_salvar_confpagamento();

$vendac_chave = $_POST["vendac_chave"];

echo '{"vendac_chave":' . $vendac_chave . '}';
