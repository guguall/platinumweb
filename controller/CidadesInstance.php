<?php

class CidadesInstance {

    public function c_buscar_cidades_do_estado($cid_uf) {
        return  CidadeDao::getInstance()->m_buscar_cidades_do_estado($cid_uf);        
    }

}
