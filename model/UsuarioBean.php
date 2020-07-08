<?php

class UsuarioBean {

    private $usu_codigo;
    private $usu_nome;
    private $usu_email;
    private $usu_celkey;
    private $usu_numerocel;
    private $usu_liberado;
    private $usu_desconto;
    private $usu_comissao;
    private $usu_usuario;
    private $usu_senha;
    private $usu_nivel;

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getUsu_nome() {
        return $this->usu_nome;
    }

    function getUsu_email() {
        return $this->usu_email;
    }

    function getUsu_celkey() {
        return $this->usu_celkey;
    }

    function getUsu_numerocel() {
        return $this->usu_numerocel;
    }

    function getUsu_liberado() {
        return $this->usu_liberado;
    }

    function getUsu_desconto() {
        return $this->usu_desconto;
    }

    function getUsu_comissao() {
        return $this->usu_comissao;
    }

    function getUsu_usuario() {
        return $this->usu_usuario;
    }

    function getUsu_senha() {
        return $this->usu_senha;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setUsu_nome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    function setUsu_email($usu_email) {
        $this->usu_email = $usu_email;
    }

    function setUsu_celkey($usu_celkey) {
        $this->usu_celkey = $usu_celkey;
    }

    function setUsu_numerocel($usu_numerocel) {
        $this->usu_numerocel = $usu_numerocel;
    }

    function setUsu_liberado($usu_liberado) {
        $this->usu_liberado = $usu_liberado;
    }

    function setUsu_desconto($usu_desconto) {
        $this->usu_desconto = $usu_desconto;
    }

    function setUsu_comissao($usu_comissao) {
        $this->usu_comissao = $usu_comissao;
    }

    function setUsu_usuario($usu_usuario) {
        $this->usu_usuario = $usu_usuario;
    }

    function setUsu_senha($usu_senha) {
        $this->usu_senha = $usu_senha;
    }

    function getUsu_nivel() {
        return $this->usu_nivel;
    }

    function setUsu_nivel($usu_nivel) {
        $this->usu_nivel = $usu_nivel;
    }

}