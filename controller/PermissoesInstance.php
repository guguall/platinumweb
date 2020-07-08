<?php

class PermissoesInstance {

    public function c_salvar_permissao($usu_codigo, $tabelas = array()) {
       
        foreach ($tabelas as $table) {

            if ($table === "vendac")
                $table = "venda";

            $permissao = new PermissoesBean();
            $permissao->setUsu_codigo($usu_codigo);
            $permissao->setTabela(strtoupper($table));
            $permissao->setInserir("N");
            $permissao->setAtualizar("N");
            $permissao->setVisualizar("N");
            $permissao->setExcluir("N");
            $permissao->setImprimir_relatorios("N");
            $permissao->setNivel("USER");
            PermissoesDao::getInstance()->m_salvar_permissao($permissao);
        }
    }

    public function c_getTabelas() {
        return PermissoesDao::getInstance()->m_getTabelas();
    }

    public function c_update_permissao($campo, $valor_campo, $per_codigo) {
        return PermissoesDao::getInstance()->m_update_permissao($campo, $valor_campo, $per_codigo);
    }

}
