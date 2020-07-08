<?php

require_once '../../vendor/autoload.php';

// https://dev.gerencianet.com.br/docs/playground-carnes

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents('../../vendor/gerencianet/config.json');
$options = json_decode($file, true);


$instructions = [$_POST["instrucao1"], $_POST["instrucao2"], $_POST["instrucao3"], $_POST["instrucao4"]];

$item_1 = [
    'name' => $_POST["descricao"],
    'amount' => (int) $_POST["quantidade"],
    'value' => (int) $_POST["valor"]
];

$items = [
    $item_1
];

$customer = [
    'name' => $_POST["nome_cliente"],
    'cpf' => $_POST["cpf"],
    'phone_number' => $_POST["telefone"],
    'email' => $_POST["email"],
];

$metadata = array(
    'notification_url' => 'http://cursoappvendas.tempsite.ws/notificacao.php',
    'custom_id' => $_POST["vendac_chave"]
);


$body = [
    'items' => $items,
    'repeats' => (int) $_POST["repeticoes"],
    'split_items' => false,
    'expire_at' => $_POST["vencimento"],
    'customer' => $customer,
    'instructions' => $instructions,
    'metadata' => $metadata
];

try {
    $api = new Gerencianet($options);
    $charge = $api->createCarnet([], $body);
    
    // aqui voce tambepm pode salvar o boleto    
    echo json_encode($charge);
    
    
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
