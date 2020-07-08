<?php

class BoletosBean {

    private $par_id;
    private $par_id_carne;
    private $par_link_carne;
    private $par_barcode_parcela;
    private $par_charge_id;
    private $par_venc_parcela;
    private $par_num_parcela;
    private $par_status_parcela;
    private $par_url_parcela;
    private $par_valor_parcela;
    private $vendac_chave;

    function getPar_id() {
        return $this->par_id;
    }

    function getPar_id_carne() {
        return $this->par_id_carne;
    }

    function getPar_link_carne() {
        return $this->par_link_carne;
    }

    function getPar_barcode_parcela() {
        return $this->par_barcode_parcela;
    }

    function getPar_charge_id() {
        return $this->par_charge_id;
    }

    function getPar_venc_parcela() {
        return $this->par_venc_parcela;
    }

    function getPar_num_parcela() {
        return $this->par_num_parcela;
    }

    function getPar_status_parcela() {
        return $this->par_status_parcela;
    }

    function getPar_url_parcela() {
        return $this->par_url_parcela;
    }

    function getPar_valor_parcela() {
        return $this->par_valor_parcela;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function setPar_id($par_id) {
        $this->par_id = $par_id;
    }

    function setPar_id_carne($par_id_carne) {
        $this->par_id_carne = $par_id_carne;
    }

    function setPar_link_carne($par_link_carne) {
        $this->par_link_carne = $par_link_carne;
    }

    function setPar_barcode_parcela($par_barcode_parcela) {
        $this->par_barcode_parcela = $par_barcode_parcela;
    }

    function setPar_charge_id($par_charge_id) {
        $this->par_charge_id = $par_charge_id;
    }

    function setPar_venc_parcela($par_venc_parcela) {
        $this->par_venc_parcela = $par_venc_parcela;
    }

    function setPar_num_parcela($par_num_parcela) {
        $this->par_num_parcela = $par_num_parcela;
    }

    function setPar_status_parcela($par_status_parcela) {
        $this->par_status_parcela = $par_status_parcela;
    }

    function setPar_url_parcela($par_url_parcela) {
        $this->par_url_parcela = $par_url_parcela;
    }

    function setPar_valor_parcela($par_valor_parcela) {
        $this->par_valor_parcela = $par_valor_parcela;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

}
