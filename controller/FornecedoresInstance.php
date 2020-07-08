<?php

class FornecedoresInstance {

    function __construct() {
        
    }

    public function c_gravarFornecedores() {

        $forBean = new FornecedoresBean();
        $forBean->setFor_razaosocial($_POST["for_razaosocial"]);
        $forBean->setFor_fantasia($_POST["for_fantasia"]);
        $forBean->setFor_endereco($_POST["for_endereco"]);
        $forBean->setFor_cep($_POST["for_cep"]);
        $forBean->setFor_bairro($_POST["for_bairro"]);
        $forBean->setFor_contato1($_POST["for_contato1"]);
        $forBean->setFor_email($_POST["for_email"]);
        $forBean->setFor_cnpjcpf($_POST["for_cnpjcpf"]);
        $forBean->setCid_codigo($_POST["cid_codigo"]);
        return FornecedoresDao::getInstance()->m_gravarFornecedores($forBean);
    }

    public function c_editarFornecedores() {
        $forBean = new FornecedoresBean();
        $forBean->setFor_codigo($_POST["for_codigo"]);
        $forBean->setFor_razaosocial($_POST["for_razaosocial"]);
        $forBean->setFor_fantasia($_POST["for_fantasia"]);
        $forBean->setFor_endereco($_POST["for_endereco"]);
        $forBean->setFor_cep($_POST["for_cep"]);
        $forBean->setFor_bairro($_POST["for_bairro"]);
        $forBean->setFor_contato1($_POST["for_contato1"]);
        $forBean->setFor_email($_POST["for_email"]);
        $forBean->setFor_cnpjcpf($_POST["for_cnpjcpf"]);
        $forBean->setCid_codigo($_POST["cid_codigo"]);
        return FornecedoresDao::getInstance()->m_editarFornecedores($forBean);
    }

    public function c_buscaTodosFornecedores() {

        return FornecedoresDao::getInstance()->m_buscaTodosFornecedores();
    }

    public function c_BuscarFornecedorPorCodigo() {
        $forBean = new FornecedoresBean();
        $forBean->setFor_codigo($_GET["for_codigo"]);
        return FornecedoresDao::getInstance()->m_BuscarFornecedorPorCodigo($forBean);
    }

    public function c_excluirFornecedor() {
        $forBean = new FornecedoresBean();
        $forBean->setFor_codigo($_GET["for_codigo"]);
        return FornecedoresDao::getInstance()->m_excluirFornecedor($forBean);
    }

}

?>