<?php

class EntradaProdutoBean {

    private $ent_id;
    private $ent_prd_codigo;
    private $ent_numeronota;
    private $ent_dataentrada;
    private $ent_unitario;
    private $ent_quantidade;
    private $ent_margem;
    private $ent_valorvenda;

    function getEnt_id() {
        return $this->ent_id;
    }

    function getEnt_prd_codigo() {
        return $this->ent_prd_codigo;
    }

    function getEnt_numeronota() {
        return $this->ent_numeronota;
    }

    function getEnt_dataentrada() {
        return $this->ent_dataentrada;
    }

    function getEnt_unitario() {
        return $this->ent_unitario;
    }

    function getEnt_quantidade() {
        return $this->ent_quantidade;
    }

    function setEnt_id($ent_id) {
        $this->ent_id = $ent_id;
    }

    function setEnt_prd_codigo($ent_prd_codigo) {
        $this->ent_prd_codigo = $ent_prd_codigo;
    }

    function setEnt_numeronota($ent_numeronota) {
        $this->ent_numeronota = $ent_numeronota;
    }

    function setEnt_dataentrada($ent_dataentrada) {
        $this->ent_dataentrada = $ent_dataentrada;
    }

    function setEnt_unitario($ent_unitario) {
        $this->ent_unitario = $ent_unitario;
    }

    function setEnt_quantidade($ent_quantidade) {
        $this->ent_quantidade = $ent_quantidade;
    }
    
    function getEnt_margem() {
        return $this->ent_margem;
    }

    function getEnt_valorvenda() {
        return $this->ent_valorvenda;
    }

    function setEnt_margem($ent_margem) {
        $this->ent_margem = $ent_margem;
    }

    function setEnt_valorvenda($ent_valorvenda) {
        $this->ent_valorvenda = $ent_valorvenda;
    }



}
