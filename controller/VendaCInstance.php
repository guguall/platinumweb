<?php

class VendaCInstance {

    function __construct() {
        
    }

    public function c_gravar_vendaC() {
        $vendac = new VendaCBean();
        $vendac->setVendac_chave($_POST["vendac_chave"]);
        $vendac->setVendac_datahoravenda($_POST["vendac_datahoravenda"]);
        $vendac->setVendac_previsaoentrega($_POST["vendac_previsaoentrega"]);
        $vendac->setVendac_cli_codigo($_POST["vendac_cli_codigo"]);
        $vendac->setVendac_cli_nome($_POST["vendac_cli_nome"]);
        $vendac->setVendac_usu_codigo($_POST["vendac_usu_codigo"]);
        $vendac->setVendac_usu_nome($_POST["vendac_usu_nome"]);
        $vendac->setVendac_formapgto($_POST["vendac_formapgto"]);
        $vendac->setVendac_valor($_POST["vendac_valor"]);
        $vendac->setVendac_desconto($_POST["vendac_desconto"]);
        $vendac->setVendac_pesototal($_POST["vendac_pesototal"]);
        $vendac->setVendac_latitude($_POST["vendac_latitude"]);
        $vendac->setVendac_longitude($_POST["vendac_longitude"]);
        $vendac->setVendac_status("AGUARDANDO_ENTREGA");
        return VendaCDao::getInstance()->m_gravar_vendaC($vendac);
    }

    public function c_ATUALIZA_CLI_CODIGO_OFFLINE_VENDAC($cli_codigo, $vendac_cli_codigo) {
        return VendaCDao::getInstance()->m_ATUALIZA_CLI_CODIGO_OFFLINE_VENDAC($cli_codigo, $vendac_cli_codigo);
    }

    public function c_buscar_todas_vendas() {
        return VendaCDao::getInstance()->m_buscar_todas_vendas();
    }

    public function c_atualizar_status_da_vendaC() {
        $vendac = new VendaCBean();
        $vendac->setVendac_status($_POST["vendac_status"]);
        $vendac->setVendac_chave($_POST["vendac_chave"]);
        return VendaCDao::getInstance()->m_atualizar_status_da_vendaC($vendac);
    }

    public function c_busca_venda_por_chave($chave) {
        return VendaCDao::getInstance()->m_busca_venda_por_chave($chave);
    }

    public function c_buscar_vendas_por_nome_cliente($vendac_cli_nome, $data_inicial, $data_final) {
        return VendaCDao::getInstance()->m_buscar_vendas_por_nome_cliente($vendac_cli_nome, $data_inicial, $data_final);
    }

    public function c_buscar_vendas_por_nome_vendedor($vendedor, $data_inicial, $data_final) {
        return VendaCDao::getInstance()->m_buscar_vendas_por_nome_vendedor($vendedor, $data_inicial, $data_final);
    }

    public function c_buscar_vendas_por_periodo($data_inicial, $data_final) {
        return VendaCDao::getInstance()->m_buscar_vendas_por_periodo($data_inicial, $data_final);
    }

}
