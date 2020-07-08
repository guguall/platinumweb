<?php

class ProdutoBean {

    private $prd_codigo;
    private $prd_EAN13;
    private $prd_descricao;
    private $prd_unmedida;
    private $prd_custo;
    private $prd_quantidade;
    private $prd_preco;
    private $prd_ativo;    
    private $cat_codigo;
    private $cat_descricao;
    private $for_codigo;
    private $for_nome;

    function getPrd_codigo() {
        return $this->prd_codigo;
    }

    function getPrd_EAN13() {
        return $this->prd_EAN13;
    }

    function getPrd_descricao() {
        return $this->prd_descricao;
    }

    function getPrd_unmedida() {
        return $this->prd_unmedida;
    }

    function getPrd_custo() {
        return $this->prd_custo;
    }

    function getPrd_quantidade() {
        return $this->prd_quantidade;
    }

    function getPrd_preco() {
        return $this->prd_preco;
    }

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function getCat_descricao() {
        return $this->cat_descricao;
    }

    function getFor_codigo() {
        return $this->for_codigo;
    }

    function getFor_nome() {
        return $this->for_nome;
    }

    function setPrd_codigo($prd_codigo) {
        $this->prd_codigo = $prd_codigo;
    }

    function setPrd_EAN13($prd_EAN13) {
        $this->prd_EAN13 = $prd_EAN13;
    }

    function setPrd_descricao($prd_descricao) {
        $this->prd_descricao = $prd_descricao;
    }

    function setPrd_unmedida($prd_unmedida) {
        $this->prd_unmedida = $prd_unmedida;
    }

    function setPrd_custo($prd_custo) {
        $this->prd_custo = $prd_custo;
    }

    function setPrd_quantidade($prd_quantidade) {
        $this->prd_quantidade = $prd_quantidade;
    }

    function setPrd_preco($prd_preco) {
        $this->prd_preco = $prd_preco;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function setCat_descricao($cat_descricao) {
        $this->cat_descricao = $cat_descricao;
    }

    function setFor_codigo($for_codigo) {
        $this->for_codigo = $for_codigo;
    }

    function setFor_nome($for_nome) {
        $this->for_nome = $for_nome;
    }
    
    
    function getPrd_ativo() {
        return $this->prd_ativo;
    }

    function setPrd_ativo($prd_ativo) {
        $this->prd_ativo = $prd_ativo;
    }



}
