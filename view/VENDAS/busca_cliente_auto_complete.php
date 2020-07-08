<?php

require_once '../../include/auto_load_path_2.php';
$cli_nome = (isset($_POST["cli_nome"])) ? $_POST["cli_nome"] : ((isset($_GET["cli_nome"])) ? $_GET["cli_nome"] : 0 );
$data = busca_cliente($cli_nome);
echo json_encode($data);
function busca_cliente($cliente) {
    $sql = "select cli_nome from clientes where cli_nome like ? order by cli_nome limit 20";
    
    $stmt = ConexaoPDO::getInstance()->prepare($sql);
    $cli = '%' . $cliente . '%';   
    $stmt->bindParam(1,$cli,  PDO::PARAM_STR,100);    
    $Sql_Ok = $stmt->execute();    
    $results = array();
    if($Sql_Ok){        
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }else{
        echo 'erro ao executar a query';
    }    
    return $results;  
}
