<?php

require_once '../../include/auto_load_path_2.php';
$cid_uf = isset($_GET["cid_uf"]) ? $_GET["cid_uf"] : 0;
$cidade = new CidadesInstance();
$cid = $cidade->c_buscar_cidades_do_estado($cid_uf);
echo $cid;


