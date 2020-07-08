<?php

class ProdutoDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ProdutoDao();
        return self::$instance;
    }

    public function m_gravarProduto(ProdutoBean $produto) {

        try {
            $sql = "insert into produtos   (prd_descricao, prd_EAN13, prd_unmedida, prd_custo, prd_preco, prd_quantidade, cat_codigo, for_codigo, prd_ativo) values (:prd_descricao, :prd_EAN13, :prd_unmedida, :prd_custo, :prd_preco, :prd_quantidade, :cat_codigo, :for_codigo, :prd_ativo)    ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":prd_EAN13", $produto->getPrd_EAN13());
            $statement_sql->bindValue(":prd_descricao", $produto->getPrd_descricao());
            $statement_sql->bindValue(":prd_unmedida", $produto->getPrd_unmedida());
            $statement_sql->bindValue(":prd_custo", $produto->getPrd_custo());
            $statement_sql->bindValue(":prd_quantidade", $produto->getPrd_quantidade());
            $statement_sql->bindValue(":prd_preco", $produto->getPrd_preco());
            $statement_sql->bindValue(":cat_codigo", $produto->getCat_codigo());
            $statement_sql->bindValue(":for_codigo", $produto->getFor_codigo());
            $statement_sql->bindValue(":prd_ativo", $produto->getPrd_ativo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_gravarProduto :: " . $e->getMessage();
        }
    }

    public function m_alterar_produtos(ProdutoBean $produto) {

        try {
            $sql = "update produtos set "
                    . "prd_EAN13=:prd_EAN13,"
                    . "prd_descricao=:prd_descricao,"
                    . "prd_unmedida=:prd_unmedida,"
                    . "prd_custo=:prd_custo,"
                    . "prd_quantidade=:prd_quantidade,"
                    . "prd_preco=:prd_preco,"
                    . "cat_codigo=:cat_codigo,"
                    . "for_codigo=:for_codigo,prd_ativo=:prd_ativo where prd_codigo = :prd_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            $statement_sql->bindValue(":prd_EAN13", $produto->getPrd_EAN13());
            $statement_sql->bindValue(":prd_descricao", $produto->getPrd_descricao());
            $statement_sql->bindValue(":prd_unmedida", $produto->getPrd_unmedida());
            $statement_sql->bindValue(":prd_custo", $produto->getPrd_custo());
            $statement_sql->bindValue(":prd_quantidade", $produto->getPrd_quantidade());
            $statement_sql->bindValue(":prd_preco", $produto->getPrd_preco());
            $statement_sql->bindValue(":cat_codigo", $produto->getCat_codigo());
            $statement_sql->bindValue(":for_codigo", $produto->getFor_codigo());
            $statement_sql->bindValue(":prd_ativo", $produto->getPrd_ativo());
            return $statement_sql->execute();
        } catch (PDOException $exc) {
            print "Erro em M_buscaProdutoPorCodigo :: " . $e->getMessage();
        }
    }

    public function m_buscar_produtos() {
        try {

            $sql = "select  p.for_codigo, p.prd_unmedida,p.prd_codigo,p.prd_descricao,p.prd_EAN13,p.prd_custo,p.prd_preco,p.prd_ativo,p.prd_quantidade,c.cat_descricao  from produtos p left outer join categorias c on c.cat_codigo = p.cat_codigo order by prd_descricao";

            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            return $this->fetch_array($statement_sql);
        } catch (PDOException $e) {
            print "Erro em M_buscarTodosProdutos :: " . $e->getMessage();
        }
    }

    private function fetch_array($statement_sql) {

        $results = array();

        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $produto = new ProdutoBean();
                $produto->setPrd_codigo($linha->prd_codigo);
                $produto->setPrd_descricao($linha->prd_descricao);
                $produto->setPrd_EAN13($linha->prd_EAN13);
                $produto->setPrd_unmedida($linha->prd_unmedida);
                $produto->setPrd_custo($linha->prd_custo);
                $produto->setPrd_preco($linha->prd_preco);
                $produto->setPrd_ativo($linha->prd_ativo);
                $produto->setPrd_quantidade($linha->prd_quantidade);
                $produto->setFor_codigo($linha->for_codigo);
                // $produto->setFor_nome($linha->for_nome);
                $produto->setCat_descricao($linha->cat_descricao);
                $results[] = $produto;
            }
        }

        return $results;
    }

    public function m_buscaProdutoPorCodigo(ProdutoBean $produto) {

        try {
            $sql = "select  p.prd_codigo,p.prd_descricao,p.prd_EAN13,p.prd_custo,p.prd_preco,p.prd_ativo,p.prd_quantidade,p.prd_unmedida,p.cat_codigo,c.cat_descricao  from produtos p left outer join categorias c on c.cat_codigo = p.cat_codigo where prd_codigo = :prd_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            $statement_sql->execute();
            return $this->pegavaloresproduto($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $exc) {
            print "Erro em M_buscaProdutoPorCodigo :: " . $e->getMessage();
        }
    }

    public function pegavaloresproduto($prod) {
        $produto = new ProdutoBean();
        $produto->setPrd_codigo($prod["prd_codigo"]);
        $produto->setPrd_descricao($prod["prd_descricao"]);
        $produto->setPrd_ativo($prod["prd_ativo"]);
        $produto->setPrd_EAN13($prod["prd_EAN13"]);
        $produto->setPrd_custo($prod["prd_custo"]);
        $produto->setPrd_preco($prod["prd_preco"]);
        $produto->setPrd_unmedida($prod["prd_unmedida"]);
        $produto->setPrd_quantidade($prod["prd_quantidade"]);
        $produto->setCat_codigo($prod["cat_codigo"]);
        $produto->setCat_descricao($prod["cat_descricao"]);
        return $produto;
    }

    public function m_excluirProduto(ProdutoBean $produto) {
        try {
            $sql = "delete from produtos where prd_codigo = :prd_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":prd_codigo", $produto->getPrd_codigo());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em M_excluirProduto :: " . $e->getMessage();
        }
    }

}
