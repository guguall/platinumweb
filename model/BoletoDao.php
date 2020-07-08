<?php

class BoletoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new BoletoDao ();
        return self::$instance;
    }

    //Ocorreu um erro - Mensagem: Erro em m_salvar_boleto :: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'par_id_carne' in 'field list
    public function m_salvar_boleto(BoletosBean $boleto) {
        try {
            $sql = "insert into boletos (par_id_carne, par_link_carne, par_barcode_parcela, par_charge_id, par_venc_parcela, par_num_parcela, par_status_parcela, par_url_parcela, par_valor_parcela, vendac_chave) values (?,?,?,?,?,?,?,?,?,?)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $boleto->getPar_id_carne());
            $statement_sql->bindValue(2, $boleto->getPar_link_carne());
            $statement_sql->bindValue(3, $boleto->getPar_barcode_parcela());
            $statement_sql->bindValue(4, $boleto->getPar_charge_id());
            $statement_sql->bindValue(5, $boleto->getPar_venc_parcela());
            $statement_sql->bindValue(6, $boleto->getPar_num_parcela());
            $statement_sql->bindValue(7, $boleto->getPar_status_parcela());
            $statement_sql->bindValue(8, $boleto->getPar_url_parcela());
            $statement_sql->bindValue(9, $boleto->getPar_valor_parcela());
            $statement_sql->bindValue(10, $boleto->getVendac_chave());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_salvar_boleto :: " . $e->getMessage();
        }
    }

    public function m_alterar_status_boleto(BoletosBean $boleto) {
        try {
            $sql = "update boletos set par_status_parcela = ?  where par_charge_id = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $boleto->getPar_status_parcela());
            $statement_sql->bindValue(2, $boleto->getPar_charge_id());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_alterar_status_boleto :: " . $e->getMessage();
        }
    }

    public function m_alterar_vencimento_parcela(BoletosBean $boleto) {
        try {
            $sql = "update boletos set par_venc_parcela = ?  where par_id_carne = ? and par_num_parcela = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $boleto->getPar_venc_parcela());
            $statement_sql->bindValue(2, $boleto->getPar_id_carne());
            $statement_sql->bindValue(3, $boleto->getPar_num_parcela());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_alterar_vencimento_parcela :: " . $e->getMessage();
        }
    }

    public function m_busca_boletos($status) {
        try {
            $sql = "select * from boletos where par_status_parcela = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $status);
            $statement_sql->execute();
            return $this->fetch_array_boletos($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_busca_boletos :: " . $e->getMessage();
        }
    }

    private function fetch_array_boletos($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $boleto = new BoletosBean();
                $boleto->setPar_id($linha->par_id);
                $boleto->setPar_id_carne($linha->par_id_carne);
                $boleto->setPar_link_carne($linha->par_link_carne);
                $boleto->setPar_barcode_parcela($linha->par_barcode_parcela);
                $boleto->setPar_charge_id($linha->par_charge_id);
                $boleto->setPar_venc_parcela($linha->par_venc_parcela);
                $boleto->setPar_num_parcela($linha->par_num_parcela);
                $boleto->setPar_status_parcela($linha->par_status_parcela);
                $boleto->setPar_url_parcela($linha->par_url_parcela);
                $boleto->setPar_valor_parcela($linha->par_valor_parcela);
                $boleto->setVendac_chave($linha->vendac_chave);
                $results [] = $boleto;
            }
        }
        return $results;
    }

}
