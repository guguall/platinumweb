<?php

class EntradaProdutoInstance {

    public function c_gravarentradaproduto() {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_prd_codigo($_POST["ent_prd_codigo"]);
        $entrada->setEnt_numeronota($_POST["ent_numeronota"]);
        $entrada->setEnt_dataentrada(date("Y-m-d"));
        $entrada->setEnt_unitario($_POST["ent_unitario"]);
        $entrada->setEnt_quantidade($_POST["ent_quantidade"]);        
        $entrada->setEnt_margem($_POST["ent_margem"]);
        $entrada->setEnt_valorvenda($_POST["ent_valorvenda"]);
        
        return EntradaProdutoDao::getInstance()->m_gravarentradaproduto($entrada);
    }

    public function c_alterarentradaproduto() {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_id($_POST["ent_id"]);
        $entrada->setEnt_prd_codigo($_POST["ent_prd_codigo"]);
        $entrada->setEnt_numeronota($_POST["ent_numeronota"]);
        $entrada->setEnt_dataentrada(date("Y-m-d"));
        $entrada->setEnt_unitario($_POST["ent_unitario"]);
        $entrada->setEnt_quantidade($_POST["ent_quantidade"]);
        $entrada->setEnt_margem($_POST["ent_margem"]);
        $entrada->setEnt_valorvenda($_POST["ent_valorvenda"]);
        return EntradaProdutoDao::getInstance()->m_alterarentradaproduto($entrada);
    }

    public function c_excluirEntradaProduto() {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_id($_GET["ent_id"]);
        return EntradaProdutoDao::getInstance()->m_excluirEntradaProduto($entrada);
    }

    public function c_buscar_todas_as_entradasprodutos() {
        return EntradaProdutoDao::getInstance()->m_buscar_todas_as_entradasprodutos();
    }

    public function c_buscar_entradaproduto_porcodigo() {
        $entrada = new EntradaProdutoBean();
        $entrada->setEnt_id($_GET["ent_id"]);
        return EntradaProdutoDao::getInstance()->m_buscar_entradaproduto_porcodigo($entrada);
    }
    
    

}
