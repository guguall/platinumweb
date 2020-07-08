<?php

class VendaCBean {

    private $id;
    private $vendac_chave;
    private $vendac_datahoravenda;
    private $vendac_previsaoentrega;
    private $vendac_cli_codigo;
    private $vendac_cli_nome;
    private $vendac_usu_codigo;
    private $vendac_usu_nome;
    private $vendac_formapgto;
    private $vendac_valor;
    private $vendac_desconto;
    private $vendac_pesototal;
    private $vendac_latitude;
    private $vendac_longitude;   
    private $vendac_status;
    
    
    
    
    
    function getId() {
        return $this->id;
    }

    function getVendac_chave() {
        return $this->vendac_chave;
    }

    function getVendac_datahoravenda() {
        return $this->vendac_datahoravenda;
    }

    function getVendac_previsaoentrega() {
        return $this->vendac_previsaoentrega;
    }

    function getVendac_cli_codigo() {
        return $this->vendac_cli_codigo;
    }

    function getVendac_cli_nome() {
        return $this->vendac_cli_nome;
    }

    function getVendac_usu_codigo() {
        return $this->vendac_usu_codigo;
    }

    function getVendac_usu_nome() {
        return $this->vendac_usu_nome;
    }

    function getVendac_formapgto() {
        return $this->vendac_formapgto;
    }

    function getVendac_valor() {
        return $this->vendac_valor;
    }

    function getVendac_desconto() {
        return $this->vendac_desconto;
    }

    function getVendac_pesototal() {
        return $this->vendac_pesototal;
    }

    function getVendac_latitude() {
        return $this->vendac_latitude;
    }

    function getVendac_longitude() {
        return $this->vendac_longitude;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVendac_chave($vendac_chave) {
        $this->vendac_chave = $vendac_chave;
    }

    function setVendac_datahoravenda($vendac_datahoravenda) {
        $this->vendac_datahoravenda = $vendac_datahoravenda;
    }

    function setVendac_previsaoentrega($vendac_previsaoentrega) {
        $this->vendac_previsaoentrega = $vendac_previsaoentrega;
    }

    function setVendac_cli_codigo($vendac_cli_codigo) {
        $this->vendac_cli_codigo = $vendac_cli_codigo;
    }

    function setVendac_cli_nome($vendac_cli_nome) {
        $this->vendac_cli_nome = $vendac_cli_nome;
    }

    function setVendac_usu_codigo($vendac_usu_codigo) {
        $this->vendac_usu_codigo = $vendac_usu_codigo;
    }

    function setVendac_usu_nome($vendac_usu_nome) {
        $this->vendac_usu_nome = $vendac_usu_nome;
    }

    function setVendac_formapgto($vendac_formapgto) {
        $this->vendac_formapgto = $vendac_formapgto;
    }

    function setVendac_valor($vendac_valor) {
        $this->vendac_valor = $vendac_valor;
    }

    function setVendac_desconto($vendac_desconto) {
        $this->vendac_desconto = $vendac_desconto;
    }

    function setVendac_pesototal($vendac_pesototal) {
        $this->vendac_pesototal = $vendac_pesototal;
    }

    function setVendac_latitude($vendac_latitude) {
        $this->vendac_latitude = $vendac_latitude;
    }

    function setVendac_longitude($vendac_longitude) {
        $this->vendac_longitude = $vendac_longitude;
    }
    
    
    function getVendac_status() {
        return $this->vendac_status;
    }

    function setVendac_status($vendac_status) {
        $this->vendac_status = $vendac_status;
    }



}
