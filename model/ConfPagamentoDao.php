<?php

class ConfPagamentoDao {

    private static $instance;

    function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ConfPagamentoDao ();
        return self::$instance;
    }

    public function m_salvar_confpagamento(ConfPagamentoBean $conf) {

        try {
            $sql = "INSERT INTO confpagamento (conf_sementrada_comentrada, conf_tipo_pagamento, conf_recebeucom_din_chq_car, conf_valor_recebido, conf_vencimento_gerencianet, conf_valor_parcela_gerencianet, conf_parcelas, vendac_chave) VALUES (?,?,?,?,?,?,?,?);";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(1, $conf->getConf_sementrada_comentrada());
            $statement_sql->bindvalue(2, $conf->getConf_tipo_pagamento());
            $statement_sql->bindvalue(3, $conf->getConf_recebeucom_din_chq_car());
            $statement_sql->bindvalue(4, $conf->getConf_valor_recebido());
            $statement_sql->bindvalue(5, $conf->getConf_vencimento_gerencianet());
            $statement_sql->bindvalue(6, $conf->getConf_valor_parcela_gerencianet());
            $statement_sql->bindvalue(7, $conf->getConf_parcelas());
            $statement_sql->bindvalue(8, $conf->getVendac_chave());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print " Erro em m_salvar_confpagamento " . $e->getMessage();
        }
    }

    public function m_busca_confpag_por_vendac_chave($vendac_chave) {
        try {
            $sql = "select * from confpagamento where vendac_chave = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $vendac_chave);
            $statement_sql->execute();
            return $this->popula_objeto_confpagamento($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_busca_confpag_por_vendac_chave :: " . $e->getMessage();
        }
    }

    private function popula_objeto_confpagamento($linha) {
        $conf = new ConfPagamentoBean();
        $conf->setConf_codigo($linha["conf_codigo"]);
        $conf->setConf_sementrada_comentrada($linha["conf_sementrada_comentrada"]);
        $conf->setConf_tipo_pagamento($linha["conf_tipo_pagamento"]);
        $conf->setConf_recebeucom_din_chq_car($linha["conf_recebeucom_din_chq_car"]);
        $conf->setConf_valor_recebido($linha["conf_valor_recebido"]);
        $conf->setConf_vencimento_gerencianet($linha["conf_vencimento_gerencianet"]);
        $conf->setConf_valor_parcela_gerencianet($linha["conf_valor_parcela_gerencianet"]);
        $conf->setConf_parcelas($linha["conf_parcelas"]);
        $conf->setVendac_chave($linha["vendac_chave"]);
        return $conf;
    }

}
