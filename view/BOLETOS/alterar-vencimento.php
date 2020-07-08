<?php

require_once '../../vendor/autoload.php';
require_once '../../include/auto_load_path_2.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents('../../vendor/gerencianet/config.json');
$options = json_decode($file, true);

$id_carne = $_POST['carnet_id'];
$num_parcela = $_POST['parcel'];
$vencimento = $_POST['data_vencimento'];


// $carnet_id refere-se ao ID do carnê desejado e parcel indica o número da parcela desejada
$params = ['id' => $id_carne, 'parcel' => $num_parcela];

$body = [
    'expire_at' => $vencimento
];

try {
    $api = new Gerencianet($options);
    $carnet = $api->updateParcel($params, $body);

    if ($carnet['code'] == 200) {
        $boleto = new BoletoInstance();
        $boleto->c_alterar_vencimento_parcela($vencimento, $id_carne, $num_parcela);
        print_r('alterado com sucesso');
    }
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}