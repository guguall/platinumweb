<?php

require_once './vendor/autoload.php'; // caminho relacionado a SDK

require_once './include/auto_load_path_1.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents('./vendor/gerencianet/config.json');
$options = json_decode($file, true);


/*
 * Este token será recebido em sua variável que representa os parâmetros do POST
 * Ex.: $_POST['notification']
 */
$token = $_POST["notification"];

$params = [
    'token' => $token
];

try {
    $api = new Gerencianet($options);
    $chargeNotification = $api->getNotification($params, []);
    // Para identificar o status atual da sua transação você deverá contar o número
    // de situações contidas no array, pois a última posição guarda sempre o último status.
    //  Veja na um modelo de respostas na seção "Exemplos de respostas" abaixo.
    // Veja abaixo como acessar o ID e a String referente ao último status da transação.
    // Conta o tamanho do array data (que armazena o resultado)
    $i = count($chargeNotification["data"]);
    // Pega o último Object chargeStatus
    $ultimoStatus = $chargeNotification["data"][$i - 1];

    /*
      Os tipos possíveis são:
      charge : A alteração ocorreu em uma transação
      subscription : A alteração ocorreu em uma assinatura
      carnet : A alteração ocorreu em um carnê
      subscription_charge : A alteração ocorreu em uma parcela de assinatura
      carnet_charge : A alteração ocorreu em uma parcela de carnê
     */
    $type = $ultimoStatus["type"];




        // Acessando o array Status
        $status = $ultimoStatus["status"];
        // Obtendo o ID da transação    
        $charge_id = $ultimoStatus["identifiers"]["charge_id"];
        // Obtendo a String do status atual
        $statusAtual = $status["current"];

        // Com estas informações, você poderá consultar sua base de dados e atualizar o status da transação especifica, uma vez que você possui o "charge_id" e a String do STATUS

        $content = "O id da transação é : " . $charge_id . " seu novo status é: " . $statusAtual . '   e o seu tipo é ' . $type;

        $boleto = new BoletoInstance();
        $boleto->c_alterar_status_boleto($charge_id, $statusAtual);       



    //print_r($chargeNotification);
} catch (GerencianetException $e) {
    // print_r($e->code);
    //  print_r($e->error);
    //print_r($e->errorDescription);

    $notificationBean = new NotificacaoBean();
    $notification = new NotificacaoInstance();

    $notificationBean->setToken($e->code);
    $notificationBean->setContent('erro' . $e->error . '  descricao' . $e->errorDescription);

    $notification->c_save_notificacao($notificationBean);
} catch (Exception $e) {
    print_r($e->getMessage());
}

