<?php

class FornecedoresDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new FornecedoresDao();
        return self::$instance;
    }

    public function m_gravarFornecedores(FornecedoresBean $fornecedor) {

        try {
            $sql = "insert into fornecedores (		
                 for_razaosocial, for_fantasia, for_endereco, for_cep,  
                for_bairro,for_contato1, for_email,
                for_cnpjcpf,cid_codigo) 
                VALUES (:for_razaosocial,:for_fantasia,
                :for_endereco,:for_cep,:for_bairro,:for_contato1,:for_email,:for_cnpjcpf,:cid_codigo)";

            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":for_razaosocial", $fornecedor->getFor_razaosocial());
            $statement_sql->bindValue(":for_fantasia", $fornecedor->getFor_fantasia());
            $statement_sql->bindValue(":for_endereco", $fornecedor->getFor_endereco());
            $statement_sql->bindValue(":for_cep", $fornecedor->getFor_cep());
            $statement_sql->bindValue(":for_bairro", $fornecedor->getFor_bairro());
            $statement_sql->bindValue(":for_contato1", $fornecedor->getFor_contato1());
            $statement_sql->bindValue(":for_email", $fornecedor->getFor_email());
            $statement_sql->bindValue(":for_cnpjcpf", $fornecedor->getFor_cnpjcpf());
            $statement_sql->bindValue(":cid_codigo", $fornecedor->getCid_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarFornecedores :: " . $e->getMessage();
        }
    }

    public function m_editarFornecedores(FornecedoresBean $fornecedor) {
        try {
            $sql = "update fornecedores set		
               
                for_razaosocial=:for_razaosocial, 
                for_fantasia=:for_fantasia, 
                for_endereco=:for_endereco,
                for_cep=:for_cep,  
                for_bairro=:for_bairro,
                for_contato1=:for_contato1,     
                for_email=:for_email,
                for_cnpjcpf=:for_cnpjcpf,
                cid_codigo=:cid_codigo where for_codigo = :for_codigo";

            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":for_razaosocial", $fornecedor->getFor_razaosocial());
            $statement_sql->bindValue(":for_fantasia", $fornecedor->getFor_fantasia());
            $statement_sql->bindValue(":for_endereco", $fornecedor->getFor_endereco());
            $statement_sql->bindValue(":for_cep", $fornecedor->getFor_cep());
            $statement_sql->bindValue(":for_bairro", $fornecedor->getFor_bairro());
            $statement_sql->bindValue(":for_contato1", $fornecedor->getFor_contato1());
            $statement_sql->bindValue(":for_email", $fornecedor->getFor_email());
            $statement_sql->bindValue(":for_cnpjcpf", $fornecedor->getFor_cnpjcpf());
            $statement_sql->bindValue(":cid_codigo", $fornecedor->getCid_codigo());
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_editarFornecedores :: " . $e->getMessage();
        }
    }

    public function m_excluirFornecedor(FornecedoresBean $fornecedor) {
        try {
            $sql = "delete from fornecedores where for_codigo = :for_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluirFornecedor :: " . $e->getMessage();
        }
    }

    public function m_BuscarFornecedorPorCodigo(FornecedoresBean $fornecedor) {
        try {
            $sql = "SELECT f.cid_codigo,f.for_codigo,f.for_razaosocial,f.for_fantasia,
                f.for_endereco,c.cid_nome,f.for_cep,f.for_bairro,
                f.for_contato1,f.for_email,f.for_cnpjcpf FROM fornecedores f 
                left outer join cidades c on c.cid_codigo = f.cid_codigo where for_codigo = :for_codigo ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":for_codigo", $fornecedor->getFor_codigo());
            $statement_sql->execute();
            return $this->populaFornecedor($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_BuscarFornecedorPorCodigo :: " . $e->getMessage();
        }
    }

    private function populaFornecedor($linha) {

        $fornBean = new FornecedoresBean();
        $fornBean->setFor_codigo($linha["for_codigo"]);
        $fornBean->setFor_razaosocial($linha["for_razaosocial"]);
        $fornBean->setFor_fantasia($linha["for_fantasia"]);
        $fornBean->setFor_endereco($linha["for_endereco"]);
        $fornBean->setFor_cep($linha["for_cep"]);
        $fornBean->setFor_bairro($linha["for_bairro"]);
        $fornBean->setFor_contato1($linha["for_contato1"]);
        $fornBean->setFor_email($linha["for_email"]);
        $fornBean->setFor_cnpjcpf($linha["for_cnpjcpf"]);
        $fornBean->setCid_codigo($linha["cid_codigo"]);
        $fornBean->setCid_nome($linha["cid_nome"]);
        return $fornBean;
    }

    public function m_buscaTodosFornecedores() {
        $sql = "SELECT f.for_codigo,f.for_razaosocial,f.for_fantasia,
                f.for_endereco,c.cid_nome,f.for_cep,f.for_bairro,
                f.for_contato1,f.for_email,f.for_cnpjcpf FROM fornecedores f 
                left outer join cidades c on c.cid_codigo = f.cid_codigo";
        $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
        $statement_sql->execute();
        return $this->fetch_array($statement_sql);
    }

    private function fetch_array($statement) {

        $results = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $fornBean = new FornecedoresBean();
                $fornBean->setFor_codigo($row->for_codigo);
                $fornBean->setFor_razaosocial($row->for_razaosocial);
                $fornBean->setFor_fantasia($row->for_fantasia);
                $fornBean->setFor_endereco($row->for_endereco);
                $fornBean->setFor_cep($row->for_cep);
                $fornBean->setFor_bairro($row->for_bairro);
                $fornBean->setFor_contato1($row->for_contato1);
                $fornBean->setFor_email($row->for_email);
                $fornBean->setFor_cnpjcpf($row->for_cnpjcpf);
                $fornBean->setCid_codigo($row->cid_codigo);
                $fornBean->setCid_nome($row->cid_nome);
                $results[] = $fornBean;
            }
        }

        return $results;
    }

}
