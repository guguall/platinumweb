<?php

class ConfPagamentoInstance {

    public function c_salvar_confpagamento() {
        $conf = new ConfPagamentoBean();
        $conf->setConf_sementrada_comentrada($_POST["conf_sementrada_comentrada"]);
        $conf->setConf_tipo_pagamento($_POST["conf_tipo_pagamento"]);
        $conf->setConf_recebeucom_din_chq_car($_POST["conf_recebeucom_din_chq_car"]);
        $conf->setConf_valor_recebido($_POST["conf_valor_recebido"]);
        $conf->setConf_vencimento_gerencianet($_POST["conf_vencimento_gerencianet"]);
        $conf->setConf_valor_parcela_gerencianet($_POST["conf_valor_parcela_gerencianet"]);
        $conf->setConf_parcelas($_POST["conf_parcelas"]);
        $conf->setVendac_chave($_POST["vendac_chave"]);
        return ConfPagamentoDao::getInstance()->m_salvar_confpagamento($conf);
    }

    public function c_busca_confpag_por_vendac_chave($vendac_chave) {
        return ConfPagamentoDao::getInstance()->m_busca_confpag_por_vendac_chave($vendac_chave);
    }

}
