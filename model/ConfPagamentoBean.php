<?php

class ConfPagamentoBean {

    private $conf_codigo;
    private $conf_sementrada_comentrada;
    private $conf_tipo_pagamento;
    private $conf_recebeucom_din_chq_car;
    private $conf_valor_recebido;
    private $conf_vencimento_gerencianet;
    private $conf_valor_parcela_gerencianet;
    private $conf_parcelas;
    private $vendac_chave;

    function getConf_codigo() {
        return $this->conf_codigo;
    }

    function getConf_sementrada_comentrada() {
        return $this->conf_sementrada_comentrada;
    }

    function getConf_tipo_pagamento() {
        return $this->conf_tipo_pagamento;
    }

    function getConf_recebeucom_din_chq_car() {
        return $this->conf_recebeucom_din_chq_car;
    }

    function getConf_valor_recebido() {
        return $this->conf_valor_recebido;
    }

    function getConf_vencimento_gerencianet() {
        return $this->conf_vencimento_gerencianet;
    }

    function getConf_valor_parcela_gerencianet() {
        return $this->conf_valor_parcela_gerencianet;
    }

    function getConf_parcelas() {
        return $this->conf_parcelas;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function setConf_codigo($conf_codigo) {
        $this->conf_codigo = $conf_codigo;
    }

    function setConf_sementrada_comentrada($conf_sementrada_comentrada) {
        $this->conf_sementrada_comentrada = $conf_sementrada_comentrada;
    }

    function setConf_tipo_pagamento($conf_tipo_pagamento) {
        $this->conf_tipo_pagamento = $conf_tipo_pagamento;
    }

    function setConf_recebeucom_din_chq_car($conf_recebeucom_din_chq_car) {
        $this->conf_recebeucom_din_chq_car = $conf_recebeucom_din_chq_car;
    }

    function setConf_valor_recebido($conf_valor_recebido) {
        $this->conf_valor_recebido = $conf_valor_recebido;
    }

    function setConf_vencimento_gerencianet($conf_vencimento_gerencianet) {
        $this->conf_vencimento_gerencianet = $conf_vencimento_gerencianet;
    }

    function setConf_valor_parcela_gerencianet($conf_valor_parcela_gerencianet) {
        $this->conf_valor_parcela_gerencianet = $conf_valor_parcela_gerencianet;
    }

    function setConf_parcelas($conf_parcelas) {
        $this->conf_parcelas = $conf_parcelas;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

}
