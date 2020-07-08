<?php

require_once '../../include/auto_load_path_2.php';
$usu_nome = (isset($_POST["usu_nome"])) ? $_POST["usu_nome"] : ((isset($_GET["usu_nome"])) ? $_GET["usu_nome"] : 0 );
$data = busca_vendedor($usu_nome);
echo json_encode($data);
function busca_vendedor($usu_nome) {
    $sql = "select usu_nome from usuarios where usu_nome like ? order by usu_nome limit 20";
    
    $stmt = ConexaoPDO::getInstance()->prepare($sql);
    $usuario = '%' . $usu_nome . '%';   
    $stmt->bindParam(1,$usuario,  PDO::PARAM_STR,100);    
    $Sql_Ok = $stmt->execute();    
    $results = array();
    if($Sql_Ok){        
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }else{
        echo 'erro ao executar a query';
    }    
    return $results;  
}

