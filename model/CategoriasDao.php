<?php

class CategoriasDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new CategoriasDao ();
        return self::$instance;
    }

    public function m_gravarCategorias(CategoriasBean $categoria) {

        try {
            $sql = "insert into categorias (cat_descricao) values (:cat_descricao)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_descricao", $categoria->getCat_descricao());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarCategorias :: " . $e->getMessage();
        }
    }

    public function m_buscaTodasCategorias() {
        try {
            $sql = "select * from categorias";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fetch_array_categorias($statement_sql);
        } catch (PDOException $e) {
            print "Erro em m_buscaTodasCategorias :: " . $e->getMessage();
        }
    }

    public function m_alterarCategorias(CategoriasBean $categoria) {
        try {
            $sql = "update categorias set cat_descricao = :cat_descricao where cat_codigo=:cat_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":cat_descricao", $categoria->getCat_descricao());
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_alterarCategorias :: " . $e->getMessage();
        }
    }

    public function m_excluirCategorias(CategoriasBean $categoria) {
        try {
            $sql = "delete from categorias where cat_codigo=:cat_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_excluirCategorias :: " . $e->getMessage();
        }
    }

    public function m_buscaCategoriasPorCodigo(CategoriasBean $categoria) {
        try {
            $sql = "select * from categorias where  cat_codigo = :cat_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":cat_codigo", $categoria->getCat_codigo());
            $statement_sql->execute();
            return $this->popula_objeto_categoria($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print "Erro em m_buscaTodasCategorias :: " . $e->getMessage();
        }
    }

    public function popula_objeto_categoria($linha) {
        $categoria = new CategoriasBean();
        $categoria->setCat_codigo($linha["cat_codigo"]);
        $categoria->setCat_descricao($linha["cat_descricao"]);
        return $categoria;
    }

    private function fetch_array_categorias($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                $categoria = new CategoriasBean();
                $categoria->setCat_codigo($linha->cat_codigo);
                $categoria->setCat_descricao($linha->cat_descricao);
                $results [] = $categoria;
            }
        }
        return $results;
    }

}

?>