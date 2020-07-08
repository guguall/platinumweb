<?php

class ClienteInstance {

    public function c_gravar_cliente() {

        $cliente = new ClienteBean();
        $cliente->setCli_nome($_POST["cli_nome"]);
        $cliente->setCli_fantasia($_POST["cli_fantasia"]);
        $cliente->setCli_endereco($_POST["cli_endereco"]);
        $cliente->setUsu_codigo($_POST["usu_codigo"]);
        $cliente->setCli_bairro($_POST["cli_bairro"]);
        $cliente->setCli_cep($_POST["cli_cep"]);
        $cliente->setCid_codigo($_POST["cid_codigo"]);
        $cliente->setCli_contato($_POST["cli_contato"]);
        $cliente->setCli_nascimento(Util::format_data_AAAA_MM_DD($_POST["cli_nascimento"]));  // 10/05/2015
        $cliente->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliente->setCli_email($_POST["cli_email"]);
        $cliente->setCli_chave(substr(md5($_POST["cli_nome"]), 20));
 
        return ClienteDao::getInstance()->m_gravar_cliente($cliente);
    }

    public function c_gravar_cliente_do_android() {
        $cliente = new ClienteBean();
        
        $cliente->setCli_nome($_POST["cli_nome"]);
        $cliente->setCli_fantasia($_POST["cli_fantasia"]);
        
        $cliente->setCli_endereco($_POST["cli_endereco"]);
        $cliente->setUsu_codigo($_POST["usu_codigo"]);
        $cliente->setCli_bairro($_POST["cli_bairro"]);
        
        $cliente->setCli_cep($_POST["cli_cep"]);
        $cliente->setCid_codigo($_POST["cid_codigo"]);
        $cliente->setCli_contato($_POST["cli_contato"]);
        
        $cliente->setCli_nascimento($_POST["cli_nascimento"]);
        $cliente->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        
        $cliente->setCli_email($_POST["cli_email"]);
        $cliente->setCli_chave($_POST["cli_chave"]);
        
        return ClienteDao::getInstance()->m_gravar_cliente($cliente);
    }

    public function c_alterar_cliente_WEB() {

        $cliente = new ClienteBean();
        $cliente->setCli_codigo($_POST["cli_codigo"]);
        $cliente->setCli_nome($_POST["cli_nome"]);
        $cliente->setCli_fantasia($_POST["cli_fantasia"]);
        $cliente->setCli_endereco($_POST["cli_endereco"]);
        $cliente->setUsu_codigo($_POST["usu_codigo"]);
        $cliente->setCli_bairro($_POST["cli_bairro"]);
        $cliente->setCli_cep($_POST["cli_cep"]);
        $cliente->setCid_codigo($_POST["cid_codigo"]);
        $cliente->setCli_contato($_POST["cli_contato"]);
        $cliente->setCli_nascimento(Util::format_data_AAAA_MM_DD($_POST["cli_nascimento"]));  // 10/05/2015
        $cliente->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliente->setCli_email($_POST["cli_email"]);
        $cliente->setCli_chave($_POST["cli_chave"]);
        return ClienteDao::getInstance()->m_alterar_cliente_WEB($cliente);
    }

    
    public function c_alterar_cliente_ANDROID() {

        $cliente = new ClienteBean();
        $cliente->setCli_codigo($_POST["cli_codigo"]);
        $cliente->setCli_nome($_POST["cli_nome"]);
        $cliente->setCli_fantasia($_POST["cli_fantasia"]);
        $cliente->setCli_endereco($_POST["cli_endereco"]);
        $cliente->setUsu_codigo($_POST["usu_codigo"]);
        $cliente->setCli_bairro($_POST["cli_bairro"]);
        $cliente->setCli_cep($_POST["cli_cep"]);
        $cliente->setCid_codigo($_POST["cid_codigo"]);
        $cliente->setCli_contato($_POST["cli_contato"]);
        $cliente->setCli_nascimento($_POST["cli_nascimento"]);  // 10/05/2015
        $cliente->setCli_cpfcnpj($_POST["cli_cpfcnpj"]);
        $cliente->setCli_rginscricaoest($_POST["cli_rginscricaoest"]);
        $cliente->setCli_email($_POST["cli_email"]);
        $cliente->setCli_chave($_POST["cli_chave"]);
        return ClienteDao::getInstance()->m_alterar_cliente_WEB($cliente);
    }
    
    
    
    
    public function c_excluir_cliente() {
        return ClienteDao::getInstance()->m_excluir_cliente($_GET["cli_codigo"]);
    }

    // metodos de busca

    public function c_paginacao_cliente($inicio, $registros) {
        return ClienteDao::getInstance()->m_paginacao_cliente($inicio, $registros);
    }

    public function c_burcar_todos_os_clientes() {
        return ClienteDao::getInstance()->m_burcar_todos_os_clientes();
    }

    public function c_burcar_todosexportacao() {
        return ClienteDao::getInstance()->m_burcar_todosexportacao();
    }

    public function c_buscar_clientes_do_vendedor($usu_codigo) {
        return ClienteDao::getInstance()->m_buscar_clientes_do_vendedor($usu_codigo);
    }

    public function c_buscar_cliente_por_codigo($codigo) {
        return ClienteDao::getInstance()->m_buscar_cliente_por_codigo($codigo);
    }
 
    public function c_buscar_cliente_por_chave($cli_chave) {
        return ClienteDao::getInstance()->m_buscar_cliente_por_chave($cli_chave);
    }

    public function c_buscar_cliente_por_nome($cli_nome) {
        
    }

}
