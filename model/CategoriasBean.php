<?php

class CategoriasBean {

    private $cat_codigo;
    private $cat_descricao;

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function getCat_descricao() {
        return $this->cat_descricao;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function setCat_descricao($cat_descricao) {
        $this->cat_descricao = $cat_descricao;
    }

}
?>

