<?php

class EntradaProdutoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new EntradaProdutoDao();
        return self::$instance;
    }

    public function m_gravarentradaproduto(EntradaProdutoBean $produto) {

        try {

            $sql = "INSERT INTO entrada_produtos (ent_prd_codigo, ent_numeronota, ent_dataentrada, ent_unitario, ent_quantidade,ent_margem,ent_valorvenda) VALUES (:ent_prd_codigo, :ent_numeronota, :ent_dataentrada, :ent_unitario, :ent_quantidade,:ent_margem,:ent_valorvenda)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ent_prd_codigo", $produto->getEnt_prd_codigo());
            $statement_sql->bindValue(":ent_numeronota", $produto->getEnt_numeronota());
            $statement_sql->bindValue(":ent_dataentrada", $produto->getEnt_dataentrada());
            $statement_sql->bindValue(":ent_unitario", $produto->getEnt_unitario());
            $statement_sql->bindValue(":ent_quantidade", $produto->getEnt_quantidade());
            $statement_sql->bindValue(":ent_margem", $produto->getEnt_margem());
            $statement_sql->bindValue(":ent_valorvenda", $produto->getEnt_valorvenda());

            return $statement_sql->execute();
        } catch (PDOException $e) {

            print "Erro em m_gravarentradaproduto :: " . $e->getMessage();
        }
    }

    public function m_alterarentradaproduto(EntradaProdutoBean $produto) {

        try {

            $sql = "update entrada_produtos set ent_prd_codigo=:ent_prd_codigo, ent_numeronota=:ent_numeronota, ent_dataentrada=:ent_dataentrada, ent_unitario=:ent_unitario, ent_quantidade=:ent_quantidade,ent_margem= :ent_margem , ent_valorvenda =:ent_valorvenda    where ent_id=:ent_id  ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ent_id", $produto->getEnt_id());
            $statement_sql->bindValue(":ent_prd_codigo", $produto->getEnt_prd_codigo());
            $statement_sql->bindValue(":ent_numeronota", $produto->getEnt_numeronota());
            $statement_sql->bindValue(":ent_dataentrada", $produto->getEnt_dataentrada());
            $statement_sql->bindValue(":ent_unitario", $produto->getEnt_unitario());
            $statement_sql->bindValue(":ent_quantidade", $produto->getEnt_quantidade());
            $statement_sql->bindValue(":ent_margem", $produto->getEnt_margem());
            $statement_sql->bindValue(":ent_valorvenda", $produto->getEnt_valorvenda());

            return $statement_sql->execute();
        } catch (PDOException $e) {

            print "Erro em m_alterarentradaproduto :: " . $e->getMessage();
        }
    }

    public function m_excluirEntradaProduto(EntradaProdutoBean $produto) {
        try {
            $sql = "delete from entrada_produtos where ent_id = :ent_id";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ent_id", $produto->getEnt_id());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluirEntradaProduto :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_as_entradasprodutos() {
        try {
            $sql = "select * from entrada_produtos";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_as_entradasprodutos :: " . $e->getMessage();
        }
    }

    public function m_buscar_entradaproduto_porcodigo(EntradaProdutoBean $produto) {
        try {
            $sql = "select * from entrada_produtos where ent_id =:ent_id";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ent_id", $produto->getEnt_id());
            $statement_sql->execute();
            return $this->popula_objeto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_as_entradasprodutos :: " . $e->getMessage();
        }
    }

    private function fetch_array($statement_sql) {

        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $entrada = new EntradaProdutoBean();
                $entrada->setEnt_id($linha->ent_id);
                $entrada->setEnt_prd_codigo($linha->ent_prd_codigo);
                $entrada->setEnt_dataentrada($linha->ent_dataentrada);
                $entrada->setEnt_numeronota($linha->ent_numeronota);
                $entrada->setEnt_quantidade($linha->ent_quantidade);
                $entrada->setEnt_unitario($linha->ent_unitario);
                $entrada->setEnt_margem($linha->ent_margem);
                $entrada->setEnt_valorvenda($linha->ent_valorvenda);

                $results[] = $entrada;
            }
        }

        return $results;
    }

    private function popula_objeto($prod) {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_id($prod["ent_id"]);
        $entrada->setEnt_prd_codigo($prod["ent_prd_codigo"]);
        $entrada->setEnt_dataentrada($prod["ent_dataentrada"]);
        $entrada->setEnt_numeronota($prod["ent_numeronota"]);
        $entrada->setEnt_quantidade($prod["ent_quantidade"]);
        $entrada->setEnt_unitario($prod["ent_unitario"]);
        $entrada->setEnt_margem($prod["ent_margem"]);
        $entrada->setEnt_valorvenda($prod["ent_valorvenda"]);

        return $entrada;
    }

}
