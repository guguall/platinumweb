<?php

class CidadeDao {

    private static $instance;

    function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new CidadeDao ();
        return self::$instance;
    }

    
    
    public function m_buscar_cidades_do_estado($cid_uf) {

        try {
            $sql = "select * from cidades where cid_uf = :cid_uf ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":cid_uf", $cid_uf);
            $statement_sql->execute();
            return json_encode($statement_sql->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_buscar_cidades_do_estado " . $e->getMessage();
        }
    }
    
    
    
    
    
    
    

    private function fecht_array($statement_sql) {

        $resultado = array();
        if ($statement_sql) {

            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $cidade = new CidadeBean();
                $cidade->setCid_codigo($linha->cid_codigo);
                $cidade->setCid_nome($linha->cid_nome);
                $cidade->setCid_uf($linha->cid_uf);
                $resultado[] = $cidade;
            }
        }
        return $resultado;
    }

}

?>
