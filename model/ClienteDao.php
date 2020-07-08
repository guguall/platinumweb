<?php

class ClienteDao {

    private static $instance;

    function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ClienteDao ();
        return self::$instance;
    }

    public function m_gravar_cliente(ClienteBean $cliente) {

        try {
            $sql = "INSERT INTO clientes (cli_nome, cli_fantasia, cli_endereco, usu_codigo, cli_bairro, cli_cep, cid_codigo, cli_contato, cli_nascimento, cli_cpfcnpj, cli_rginscricaoest, cli_email, cli_chave) VALUES (:cli_nome, :cli_fantasia, :cli_endereco, :usu_codigo, :cli_bairro, :cli_cep, :cid_codigo, :cli_contato, :cli_nascimento, :cli_cpfcnpj, :cli_rginscricaoest, :cli_email, :cli_chave);";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":cli_nome", $cliente->getCli_nome());
            $statement_sql->bindvalue(":cli_fantasia", $cliente->getCli_fantasia());
            $statement_sql->bindvalue(":cli_endereco", $cliente->getCli_endereco());
            $statement_sql->bindvalue(":usu_codigo", $cliente->getUsu_codigo());
            $statement_sql->bindvalue(":cli_bairro", $cliente->getCli_bairro());
            $statement_sql->bindvalue(":cli_cep", $cliente->getCli_cep());
            $statement_sql->bindvalue(":cid_codigo", $cliente->getCid_codigo());
            $statement_sql->bindvalue(":cli_contato", $cliente->getCli_contato());
            $statement_sql->bindvalue(":cli_nascimento", $cliente->getCli_nascimento());
            $statement_sql->bindvalue(":cli_cpfcnpj", $cliente->getCli_cpfcnpj());
            $statement_sql->bindvalue(":cli_rginscricaoest", $cliente->getCli_rginscricaoest());
            $statement_sql->bindvalue(":cli_email", $cliente->getCli_email());
            $statement_sql->bindvalue(":cli_chave", $cliente->getCli_chave());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print " Erro em m_gravar_cliente " . $e->getMessage();
        }
    }

    public function m_alterar_cliente_WEB(ClienteBean $cliente) {

        try {
            $sql = "update clientes set cli_nome=:cli_nome, cli_fantasia=:cli_fantasia, cli_endereco=:cli_endereco, usu_codigo=:usu_codigo, cli_bairro=:cli_bairro, cli_cep=:cli_cep, cid_codigo=:cid_codigo, cli_contato=:cli_contato, cli_nascimento=:cli_nascimento, cli_cpfcnpj=:cli_cpfcnpj, cli_rginscricaoest=:cli_rginscricaoest, cli_email=:cli_email, cli_chave=:cli_chave where cli_codigo = :cli_codigo   ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);

            $statement_sql->bindvalue(":cli_codigo", $cliente->getCli_codigo());
            $statement_sql->bindvalue(":cli_nome", $cliente->getCli_nome());
            $statement_sql->bindvalue(":cli_fantasia", $cliente->getCli_fantasia());
            $statement_sql->bindvalue(":cli_endereco", $cliente->getCli_endereco());
            $statement_sql->bindvalue(":usu_codigo", $cliente->getUsu_codigo());
            $statement_sql->bindvalue(":cli_bairro", $cliente->getCli_bairro());
            $statement_sql->bindvalue(":cli_cep", $cliente->getCli_cep());
            $statement_sql->bindvalue(":cid_codigo", $cliente->getCid_codigo());
            $statement_sql->bindvalue(":cli_contato", $cliente->getCli_contato());
            $statement_sql->bindvalue(":cli_nascimento", $cliente->getCli_nascimento());
            $statement_sql->bindvalue(":cli_cpfcnpj", $cliente->getCli_cpfcnpj());
            $statement_sql->bindvalue(":cli_rginscricaoest", $cliente->getCli_rginscricaoest());
            $statement_sql->bindvalue(":cli_email", $cliente->getCli_email());
            $statement_sql->bindvalue(":cli_chave", $cliente->getCli_chave());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print " Erro em m_alterar_cliente " . $e->getMessage();
        }
    }

    public function m_excluir_cliente($codigo) {

        try {
            $sql = "delete from clientes where cli_codigo = :cli_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":cli_codigo", $codigo);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print " Erro em m_excluir_cliente" . $e->getMessage();
        }
    }

   public function m_burcar_todosexportacao() {

        try {

            $sql = "select "
                    . "cli.cli_codigo, "
                    . "cli.cli_nome, "
                    . "cli.cli_endereco, "
                    . "cli.cli_cep, "
                    . "cli.cli_nascimento, "
                    . "cli.cli_cpfcnpj, "
                    . "cli.cli_rginscricaoest, "
                    . "cli.cli_chave, "
                    . "cli.cli_fantasia, "
                    . "cli.cli_bairro, "
                    . "cid.cid_nome, "
                    . "cli.cli_contato, "
                    . "cli.cli_email "
                    . "from clientes cli left outer join cidades cid on cid.cid_codigo = cli.cid_codigo ";


            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_burcar_todos_os_clientes " . $e->getMessage();
        }
    }

    public function m_paginacao_cliente($inicio, $registros) {

        try {

            $sql = "select 
            cli.cli_codigo,cli.cli_nome, cli.cli_fantasia, cli.cli_endereco, 
            cli.cli_chave, ifnull(usu.usu_codigo,0) as usu_codigo, 
            ifnull(usu.usu_nome,'sem valor') as usu_nome , 
            cli.cli_bairro, cli.cli_cep,  cli.cid_codigo,cid.cid_nome, 
            cli.cli_contato,cli.cli_nascimento,cli.cli_cpfcnpj, 
            cli.cli_rginscricaoest,cli.cli_email 
            from clientes cli left outer join usuarios usu 
            on usu.usu_codigo = cli.usu_codigo  left outer join cidades cid on cid.cid_codigo = cli.cid_codigo LIMIT $inicio, $registros";

            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_paginacao_cliente " . $e->getMessage();
        }
    }

    public function m_burcar_todos_os_clientes() {

        try {

            $sql = "select "
                    . "cli.cli_codigo, "
                    . "cli.cli_nome, "
                    . "cli.cli_fantasia, "
                    . "cli.cli_endereco, "
                    . "cli.cli_chave, "
                    . "ifnull(usu.usu_codigo,0) as usu_codigo, "
                    . "ifnull(usu.usu_nome,'sem valor') as usu_nome , "
                    . "cli.cli_bairro, cli.cli_cep, "
                    . "cli.cid_codigo, "
                    . "cid.cid_nome, "
                    . "cli.cli_contato, "
                    . "cli.cli_nascimento, "
                    . "cli.cli_cpfcnpj, "
                    . "cli.cli_rginscricaoest, "
                    . "cli.cli_email "
                    . "from clientes cli left outer join usuarios usu "
                    . "on usu.usu_codigo = cli.usu_codigo  left outer join cidades cid on cid.cid_codigo = cli.cid_codigo   ";


            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_burcar_todos_os_clientes " . $e->getMessage();
        }
    }

    public function m_buscar_cliente_por_codigo($codigo) {

        try {

            $sql = "select "
                    . "cli.cli_codigo, "
                    . "cli.cli_nome, "
                    . "cli.cli_fantasia, "
                    . "cli.cli_endereco, "
                    . "ifnull(usu.usu_codigo,0) as usu_codigo, "
                    . "ifnull(usu.usu_nome,'sem valor') as usu_nome , "
                    . "cli.cli_bairro, cli.cli_cep, "
                    . "cli.cid_codigo, "
                    . "cid.cid_nome, "
                    . "cli.cli_contato, "
                    . "cli.cli_nascimento, "
                    . "cli.cli_cpfcnpj, "
                    . "cli.cli_rginscricaoest, "
                    . "cli.cli_email "
                    . "from clientes cli left outer join usuarios usu "
                    . "on usu.usu_codigo = cli.usu_codigo  left outer join cidades cid on cid.cid_codigo = cli.cid_codigo    where cli_codigo = :cli_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":cli_codigo", $codigo);
            $statement_sql->execute();
            return $this->m_popula_objeto_cliente($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_buscar_cliente_por_codigo " . $e->getMessage();
        }
    }

    public function m_buscar_cliente_por_chave($cli_chave) {
        try {

            $sql = "select "
                    . "cli.cli_codigo, "
                    . "cli.cli_nome, "
                    . "cli.cli_endereco, "
                    . "cli.cli_cep, "
                    . "cli.cli_nascimento, "
                    . "cli.cli_cpfcnpj, "
                    . "cli.cli_rginscricaoest, "
                    . "cli.cli_chave, "
                    . "cli.cli_fantasia, "
                    . "cli.cli_bairro, "
                    . "cid.cid_nome, "
                    . "cli.cli_contato, "
                    . "cli.cli_email "
                    . "from clientes cli left outer join cidades cid on cid.cid_codigo = cli.cid_codigo where cli_chave =  :cli_chave    ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":cli_chave", $cli_chave);
            $statement_sql->execute();
            return $this->m_popula_objeto_cliente($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_buscar_cliente_por_chave " . $e->getMessage();
        }
    }

    public function m_buscar_cliente_por_nome($cli_nome) {
        
    }

    public function m_buscar_clientes_do_vendedor($usu_codigo) {

        try {

            $sql = "select "
                    . "cli.cli_codigo, "
                    . "cli.cli_nome, "
                    . "cli.cli_endereco, "
                    . "cli.cli_cep, "
                    . "cli.cli_nascimento, "
                    . "cli.cli_cpfcnpj, "
                    . "cli.cli_rginscricaoest, "
                    . "cli.cli_chave, "
                    . "cli.cli_fantasia, "
                    . "cli.cli_bairro, "
                    . "cid.cid_nome, "
                    . "cli.cli_contato, "
                    . "cli.cli_email "
                    . "from clientes cli  left outer join cidades cid on cid.cid_codigo = cli.cid_codigo where usu_codigo = :usu_codigo ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":usu_codigo", $usu_codigo);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_buscar_cliente_por_codigo " . $e->getMessage();
        }
    }

    private function fecht_array($statement_sql) {
        $resultado = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $cliente = new ClienteBean();

                $cliente->setCli_codigo($linha->cli_codigo);
                $cliente->setCli_nome($linha->cli_nome);
                $cliente->setCli_endereco($linha->cli_endereco);
                $cliente->setCli_cep($linha->cli_cep);
                $cliente->setCli_nascimento($linha->cli_nascimento);
                $cliente->setCli_cpfcnpj($linha->cli_cpfcnpj);
                $cliente->setCli_rginscricaoest($linha->cli_rginscricaoest);
                $cliente->setCli_chave($linha->cli_chave);
                $cliente->setCli_fantasia($linha->cli_fantasia);
                $cliente->setUsu_codigo($linha->usu_codigo);
                $cliente->setUsu_nome($linha->usu_nome);
                $cliente->setCid_codigo($linha->cid_codigo);
                $cliente->setCid_nome($linha->cid_nome);
                $cliente->setCli_bairro($linha->cli_bairro);
                $cliente->setCli_contato($linha->cli_contato);
                $cliente->setCli_email($linha->cli_email);
                $resultado[] = $cliente;
            }
        }
        return $resultado;
    }

    private function m_popula_objeto_cliente($linha) {
        $cliente = new ClienteBean();
        $cliente->setCli_codigo($linha["cli_codigo"]);
        $cliente->setCli_nome($linha["cli_nome"]);
        $cliente->setCli_fantasia($linha["cli_fantasia"]);
        $cliente->setCli_endereco($linha["cli_endereco"]);
        $cliente->setCli_cpfcnpj($linha["cli_cpfcnpj"]);
        $cliente->setCli_cep($linha["cli_cep"]);
        $cliente->setCli_nascimento(Util::format_data_DD_MM_AAAA($linha["cli_nascimento"]));
        $cliente->setCli_rginscricaoest($linha["cli_rginscricaoest"]);
        $cliente->setCli_chave($linha["cli_chave"]);
        $cliente->setUsu_codigo($linha["usu_codigo"]);
        $cliente->setUsu_nome($linha["usu_nome"]);
        $cliente->setCid_codigo($linha["cid_codigo"]);
        $cliente->setCli_bairro($linha["cli_bairro"]);
        $cliente->setCli_contato($linha["cli_contato"]);
        $cliente->setCli_email($linha["cli_email"]);
        $cliente->setCid_nome($linha["cid_nome"]);
        return $cliente;
    }

}
?>

