<?php

class VendaDBean {

    private $vendac_chave;
    private $vendad_nro_item;
    private $vendad_ean;
    private $vendad_prd_codigo;
    private $vendad_prd_descricao;
    private $vendad_quantidade;
    private $vendad_preco_venda;
    private $vendad_total;

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getVendad_nro_item() {
        return $this->vendad_nro_item;
    }

    function getVendad_ean() {
        return $this->vendad_ean;
    }

    function getVendad_prd_codigo() {
        return $this->vendad_prd_codigo;
    }

    function getVendad_prd_descricao() {
        return $this->vendad_prd_descricao;
    }

    function getVendad_quantidade() {
        return $this->vendad_quantidade;
    }

    function getVendad_preco_venda() {
        return $this->vendad_preco_venda;
    }

    function getVendad_total() {
        return $this->vendad_total;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setVendad_nro_item($vendad_nro_item) {
        $this->vendad_nro_item = $vendad_nro_item;
    }

    function setVendad_ean($vendad_ean) {
        $this->vendad_ean = $vendad_ean;
    }

    function setVendad_prd_codigo($vendad_prd_codigo) {
        $this->vendad_prd_codigo = $vendad_prd_codigo;
    }

    function setVendad_prd_descricao($vendad_prd_descricao) {
        $this->vendad_prd_descricao = $vendad_prd_descricao;
    }

    function setVendad_quantidade($vendad_quantidade) {
        $this->vendad_quantidade = $vendad_quantidade;
    }

    function setVendad_preco_venda($vendad_preco_venda) {
        $this->vendad_preco_venda = $vendad_preco_venda;
    }

    function setVendad_total($vendad_total) {
        $this->vendad_total = $vendad_total;
    }

}
