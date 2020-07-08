<?php

class PermissoesBean {

    private $per_codigo;
    private $usu_codigo;
    private $tabela;
    private $inserir;
    private $atualizar;
    private $visualizar;
    private $excluir;
    private $imprimir_relatorios;
    private $nivel;

    function getPer_codigo() {
        return $this->per_codigo;
    }

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getTabela() {
        return $this->tabela;
    }

    function getInserir() {
        return $this->inserir;
    }

    function getAtualizar() {
        return $this->atualizar;
    }

    function getVisualizar() {
        return $this->visualizar;
    }

    function getExcluir() {
        return $this->excluir;
    }

    function getImprimir_relatorios() {
        return $this->imprimir_relatorios;
    }

    function getNivel() {
        return $this->nivel;
    }

    function setPer_codigo($per_codigo) {
        $this->per_codigo = $per_codigo;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setInserir($inserir) {
        $this->inserir = $inserir;
    }

    function setAtualizar($atualizar) {
        $this->atualizar = $atualizar;
    }

    function setVisualizar($visualizar) {
        $this->visualizar = $visualizar;
    }

    function setExcluir($excluir) {
        $this->excluir = $excluir;
    }

    function setImprimir_relatorios($imprimir_relatorios) {
        $this->imprimir_relatorios = $imprimir_relatorios;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

}
