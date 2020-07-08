<?php

class CategoriasInstance {

    function __construct() {
        
    }

    public function c_gravarCategorias() {
        $categoria = new CategoriasBean();
        $categoria->setCat_descricao($_POST["cat_descricao"]);      
        return CategoriasDao::getInstance()->m_gravarCategorias($categoria);
    }

    public function c_alterarCategorias() {
        $categoria = new CategoriasBean();
        $categoria->setCat_codigo($_POST["cat_codigo"]);
        $categoria->setCat_descricao($_POST["cat_descricao"]);        
        return CategoriasDao::getInstance()->m_alterarCategorias($categoria);
    }

    public function c_excluirCategorias() {
        $categoria = new CategoriasBean();       
        $categoria->setCat_codigo($_GET["cat_codigo"]);
        return CategoriasDao::getInstance()->m_excluirCategorias($categoria);
    }

    public function c_buscaTodasCategorias() {         
        return CategoriasDao::getInstance()->m_buscaTodasCategorias();
    }

    public function c_buscaCategoriasPorCodigo() {
        $categoria = new CategoriasBean();       
        $categoria->setCat_codigo($_GET["cat_codigo"]);
        return CategoriasDao::getInstance()->m_buscaCategoriasPorCodigo($categoria);
    }

  

}
?>

