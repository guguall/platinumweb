<?php

require_once '../../include/auto_load_path_2.php';

$vendac = new VendaCInstance();
$cliente = new ClienteInstance();
$clienteBean = new ClienteBean();
$clienteBean = $cliente->c_burcar_todos_os_clientes();

foreach ($clienteBean as $cli) {
    $vendac->c_ATUALIZA_CLI_CODIGO_OFFLINE_VENDAC($cli->getCli_codigo(), $cli->getCli_chave());
}