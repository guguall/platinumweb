<?php

class BoletoInstance {

    public function c_salvar_boleto() {
        $boleto = new BoletosBean();
        $boleto->setPar_id_carne($_POST['par_id_carne']);
        $boleto->setPar_link_carne($_POST['par_link_carne']);
        $boleto->setPar_barcode_parcela($_POST['par_barcode_parcela']);
        $boleto->setPar_charge_id($_POST['par_charge_id']);
        $boleto->setPar_venc_parcela($_POST['par_venc_parcela']);
        $boleto->setPar_num_parcela($_POST['par_num_parcela']);
        $boleto->setPar_status_parcela($_POST['par_status_parcela']);
        $boleto->setPar_url_parcela($_POST['par_url_parcela']);
        $boleto->setPar_valor_parcela($_POST['par_valor_parcela']);
        $boleto->setVendac_chave($_POST['vendac_chave']);
        return BoletoDao::getInstance()->m_salvar_boleto($boleto);
    }

    public function c_busca_boletos($status) {
        return BoletoDao::getInstance()->m_busca_boletos($status);
    }

    public function c_alterar_status_boleto($charge_id, $statusAtual) {
        $boleto = new BoletosBean();
        $boleto->setPar_charge_id($charge_id);
        $boleto->setPar_status_parcela($statusAtual);
        return BoletoDao::getInstance()->m_alterar_status_boleto($boleto);
    }

    public function c_alterar_vencimento_parcela($par_venc_parcela, $par_id_carne, $par_num_parcela) {
        $boleto = new BoletosBean();
        $boleto->setPar_venc_parcela($par_venc_parcela);
        $boleto->setPar_id_carne($par_id_carne);
        $boleto->setPar_num_parcela($par_num_parcela);
        return BoletoDao::getInstance()->m_alterar_vencimento_parcela($boleto);
    }

}
