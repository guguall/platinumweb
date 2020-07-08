<?php

class ProdutoInstance {

    public function c_gravarProduto() {
        $produto = new ProdutoBean();
        $produto->setPrd_EAN13($_POST["prd_EAN13"]);
        $produto->setPrd_descricao($_POST["prd_descricao"]);
        $produto->setPrd_unmedida($_POST["prd_unmedida"]);
        $produto->setPrd_custo($_POST["prd_custo"]);
        $produto->setPrd_quantidade($_POST["prd_quantidade"]);
        $produto->setPrd_preco($_POST["prd_preco"]);
        $produto->setCat_codigo($_POST["cat_codigo"]);
        $produto->setFor_codigo($_POST["for_codigo"]);
        $produto->setPrd_ativo($_POST["prd_ativo"]);
        ProdutoDao::getInstance()->m_gravarProduto($produto);
    }

    public function c_alterar_produtos() {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($_POST["prd_codigo"]);
        $produto->setPrd_EAN13($_POST["prd_EAN13"]);
        $produto->setPrd_descricao($_POST["prd_descricao"]);
        $produto->setPrd_unmedida($_POST["prd_unmedida"]);
        $produto->setPrd_custo($_POST["prd_custo"]);
        $produto->setPrd_quantidade($_POST["prd_quantidade"]);
        $produto->setPrd_preco($_POST["prd_preco"]);
        $produto->setCat_codigo($_POST["cat_codigo"]);
        $produto->setFor_codigo($_POST["for_codigo"]);
        $produto->setPrd_ativo($_POST["prd_ativo"]);
        return ProdutoDao::getInstance()->m_alterar_produtos($produto);
    }

    public function c_buscar_produtos() {
        return ProdutoDao::getInstance()->m_buscar_produtos();
    }

    public function c_buscaProdutoPorCodigo() {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($_GET["prd_codigo"]);
        return ProdutoDao::getInstance()->m_buscaProdutoPorCodigo($produto);
    }

    public function c_excluirProduto() {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($_GET["prd_codigo"]);
        return ProdutoDao::getInstance()->m_excluirProduto($produto);
    }

}
