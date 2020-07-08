<?php

class VendaDDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new VendaDDao();
        return self::$instance;
    }

    public function m_gravarVendaD(VendaDBean $itens) {

        try {
            $sql = "INSERT INTO vendad (vendac_chave, vendad_nro_item, vendad_ean, vendad_prd_codigo, vendad_prd_descricao, vendad_quantidade, vendad_preco_venda, vendad_total) VALUES (:vendac_chave, :vendad_nro_item, :vendad_ean, :vendad_prd_codigo, :vendad_prd_descricao, :vendad_quantidade, :vendad_preco_venda, :vendad_total)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $itens->getVendac_chave());
            $statement_sql->bindValue(":vendad_nro_item", $itens->getVendad_nro_item());
            $statement_sql->bindValue(":vendad_ean", $itens->getVendad_ean());
            $statement_sql->bindValue(":vendad_prd_codigo", $itens->getVendad_prd_codigo());
            $statement_sql->bindValue(":vendad_prd_descricao", $itens->getVendad_prd_descricao());
            $statement_sql->bindValue(":vendad_quantidade", $itens->getVendad_quantidade());
            $statement_sql->bindValue(":vendad_preco_venda", $itens->getVendad_preco_venda());
            $statement_sql->bindValue(":vendad_total", $itens->getVendad_total());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarCategorias :: " . $e->getMessage();
        }
    }

    public function m_busca_itens_da_venda($chave) {
        try {
            $sql = "select * from vendad where vendac_chave = :vendac_chave ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $chave);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_busca_itens_da_venda " . $e->getMessage();
        }
    }

    private function fecht_array($statement_sql) {
        $resultado = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $vendadBean = new VendaDBean();
                $vendadBean->setVendac_chave($linha->vendac_chave);
                $vendadBean->setVendad_ean($linha->vendad_ean);
                $vendadBean->setVendad_nro_item($linha->vendad_nro_item);
                $vendadBean->setVendad_prd_codigo($linha->vendad_prd_codigo);
                $vendadBean->setVendad_prd_descricao($linha->vendad_prd_descricao);
                $vendadBean->setVendad_preco_venda($linha->vendad_preco_venda);
                $vendadBean->setVendad_quantidade($linha->vendad_quantidade);
                $vendadBean->setVendad_total($linha->vendad_total);
                $resultado[] = $vendadBean;
            }
        }
        return $resultado;
    }

}
