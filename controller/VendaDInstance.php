<?php

class VendaDInstance {

    public function c_gravarVendaD() {
        $vendad = new VendaDBean();
        $vendad->setVendac_chave($_POST["vendac_chave"]);
        $vendad->setVendad_nro_item($_POST["vendad_nro_item"]);
        $vendad->setVendad_ean($_POST["vendad_ean"]);
        $vendad->setVendad_prd_codigo($_POST["vendad_prd_codigo"]);
        $vendad->setVendad_prd_descricao($_POST["vendad_prd_descricao"]);
        $vendad->setVendad_quantidade($_POST["vendad_quantidade"]);
        $vendad->setVendad_preco_venda($_POST["vendad_preco_venda"]);
        $vendad->setVendad_total($_POST["vendad_total"]);
        return VendaDDao::getInstance()->m_gravarVendaD($vendad);
    }

    public function c_busca_itens_da_venda($chave) {
        return VendaDDao::getInstance()->m_busca_itens_da_venda($chave);
    }

}
