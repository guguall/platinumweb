<?php

class VendaCDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new VendaCDao();
        return self::$instance;
    }

    public function m_gravar_vendaC(VendaCBean $venda) {

        try {
            $sql = "INSERT INTO vendac (
                vendac_chave, 
                vendac_datahoravenda, 
                vendac_previsaoentrega, 
                vendac_cli_codigo, 
                vendac_cli_nome, 
                vendac_usu_codigo, 
                vendac_usu_nome, 
                vendac_formapgto, 
                vendac_valor, 
                vendac_desconto, 
                vendac_pesototal, 
                vendac_latitude, 
                vendac_longitude,
                vendac_status) 
                VALUES (
                :vendac_chave, 
                :vendac_datahoravenda, 
                :vendac_previsaoentrega, 
                :vendac_cli_codigo, 
                :vendac_cli_nome, 
                :vendac_usu_codigo, 
                :vendac_usu_nome, 
                :vendac_formapgto, 
                :vendac_valor, 
                :vendac_desconto, 
                :vendac_pesototal, 
                :vendac_latitude, 
                :vendac_longitude,
                :vendac_status)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $venda->getVendac_chave());
            $statement_sql->bindValue(":vendac_datahoravenda", $venda->getVendac_datahoravenda());
            $statement_sql->bindValue(":vendac_previsaoentrega", $venda->getVendac_previsaoentrega());
            $statement_sql->bindValue(":vendac_cli_codigo", $venda->getVendac_cli_codigo());
            $statement_sql->bindValue(":vendac_cli_nome", $venda->getVendac_cli_nome());
            $statement_sql->bindValue(":vendac_usu_codigo", $venda->getVendac_usu_codigo());
            $statement_sql->bindValue(":vendac_usu_nome", $venda->getVendac_usu_nome());
            $statement_sql->bindValue(":vendac_formapgto", $venda->getVendac_formapgto());
            $statement_sql->bindValue(":vendac_valor", $venda->getVendac_valor());
            $statement_sql->bindValue(":vendac_desconto", $venda->getVendac_desconto());
            $statement_sql->bindValue(":vendac_pesototal", $venda->getVendac_pesototal());
            $statement_sql->bindValue(":vendac_latitude", $venda->getVendac_latitude());
            $statement_sql->bindValue(":vendac_longitude", $venda->getVendac_longitude());
            $statement_sql->bindValue(":vendac_status", $venda->getVendac_status());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravar_vendaC :: " . $e->getMessage();
        }
    }

    public function m_buscar_vendas_por_nome_cliente($vendac_cli_nome, $data_inicial, $data_final) {

        try {
            $sql = "select * from vendac where vendac_cli_nome = :vendac_cli_nome and vendac_datahoravenda BETWEEN  '$data_inicial'  and '$data_final' ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_cli_nome", $vendac_cli_nome);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_vendas_por_nome_cliente :: " . $e->getMessage();
        }
    }

    public function m_buscar_vendas_por_nome_vendedor($vendedor, $data_inicial, $data_final) {

        try {
            $sql = "select * from vendac where vendac_usu_nome = :vendac_usu_nome and vendac_datahoravenda BETWEEN  '$data_inicial'  and '$data_final' ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_usu_nome", $vendedor);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_vendas_por_nome_vendedor :: " . $e->getMessage();
        }
    }

    public function m_buscar_vendas_por_periodo($data_inicial, $data_final) {

        try {
            $sql = "select * from vendac where vendac_datahoravenda BETWEEN ? and ? ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindParam(1, $data_inicial);
            $statement_sql->bindParam(2, $data_final);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscar_vendas_por_periodo :: " . $e->getMessage();
        }
    }

    public function m_ATUALIZA_CLI_CODIGO_OFFLINE_VENDAC($cli_codigo, $vendac_cli_codigo) {

        try {
            $sql = " update vendac set vendac_cli_codigo = (select cli_codigo from clientes where cli_codigo = :cli_codigo ) where vendac_cli_codigo = :vendac_cli_codigo ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cli_codigo", $cli_codigo);
            $statement_sql->bindValue(":vendac_cli_codigo", $vendac_cli_codigo);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_ATUALIZA_CLI_CODIGO_OFFLINE_VENDAC :: " . $e->getMessage();
        }
    }

    public function m_atualizar_status_da_vendaC(VendaCBean $venda) {

        try {
            $sql = "update vendac set vendac_status = :vendac_status where vendac_chave = :vendac_chave";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_status", $venda->getVendac_status());
            $statement_sql->bindValue(":vendac_chave", $venda->getVendac_chave());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualizar_status_da_vendaC :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_vendas() {
        try {
            $sql = "select * from vendac";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_buscar_todas_vendas " . $e->getMessage();
        }
    }

    // retorno em objeto VendaCBean
    public function m_busca_venda_por_chave($chave) {
        try {
            $sql = "select * from vendac where vendac_chave = :vendac_chave";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $chave);
            $statement_sql->execute();
            return $this->m_popula_objeto_vendac($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_busca_venda_por_chave " . $e->getMessage();
        }
    }



    private function fecht_array($statement_sql) {
        $resultado = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $vendacBean = new VendaCBean();
                $vendacBean->setId($linha->id);
                $vendacBean->setVendac_chave($linha->vendac_chave);
                $vendacBean->setVendac_datahoravenda($linha->vendac_datahoravenda);
                $vendacBean->setVendac_previsaoentrega($linha->vendac_previsaoentrega);
                $vendacBean->setVendac_cli_codigo($linha->vendac_cli_codigo);
                $vendacBean->setVendac_cli_nome($linha->vendac_cli_nome);
                $vendacBean->setVendac_usu_codigo($linha->vendac_usu_codigo);
                $vendacBean->setVendac_usu_nome($linha->vendac_usu_nome);
                $vendacBean->setVendac_formapgto($linha->vendac_formapgto);
                $vendacBean->setVendac_valor($linha->vendac_valor);
                $vendacBean->setVendac_desconto($linha->vendac_desconto);
                $vendacBean->setVendac_pesototal($linha->vendac_pesototal);
                $vendacBean->setVendac_latitude($linha->vendac_latitude);
                $vendacBean->setVendac_longitude($linha->vendac_longitude);
                $vendacBean->setVendac_status($linha->vendac_status);
                $resultado[] = $vendacBean;
            }
        }
        return $resultado;
    }

    private function m_popula_objeto_vendac($linha) {
        $vendac = new VendaCBean();
        $vendac->setVendac_chave($linha["vendac_chave"]);
        $vendac->setVendac_cli_codigo($linha["vendac_cli_codigo"]);
        $vendac->setVendac_cli_nome($linha["vendac_cli_nome"]);
        $vendac->setVendac_datahoravenda($linha["vendac_datahoravenda"]);
        $vendac->setVendac_desconto($linha["vendac_desconto"]);
        $vendac->setVendac_formapgto($linha["vendac_formapgto"]);
        $vendac->setVendac_latitude($linha["vendac_latitude"]);
        $vendac->setVendac_longitude($linha["vendac_longitude"]);
        $vendac->setVendac_pesototal($linha["vendac_pesototal"]);
        $vendac->setVendac_previsaoentrega($linha["vendac_previsaoentrega"]);
        $vendac->setVendac_status($linha["vendac_status"]);
        $vendac->setVendac_usu_codigo($linha["vendac_usu_codigo"]);
        $vendac->setVendac_usu_nome($linha["vendac_usu_nome"]);
        $vendac->setVendac_valor($linha["vendac_valor"]);
        return $vendac;
    }

}

?>