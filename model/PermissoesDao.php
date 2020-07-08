<?php

class PermissoesDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new PermissoesDao();
        return self::$instance;
    }

    static public function getPermission($user) {
        try {
            $sql = "select * from permissoes where usu_codigo = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $user);
            $statement_sql->execute();
            return $statement_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    static public function getPermission_in_table($usu_codigo, $tabela) {
        try {
            $sql = "select * from permissoes where usu_codigo = ? and tabela = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $usu_codigo);
            $statement_sql->bindValue(2, $tabela);
            $statement_sql->execute();
            return $statement_sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function m_update_permissao($campo, $valor_campo, $per_codigo) {
        try {
            $sql = "update permissoes set $campo = ? where per_codigo = ?";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $valor_campo);
            $statement_sql->bindValue(2, $per_codigo);
            return $statement_sql->execute();
        } catch (Exception $ex) {
            print "Erro em m_update_permissao :: " . $e->getMessage();
        }
    }

    public function m_salvar_permissao(PermissoesBean $permissao) {
        try {
            $sql = "insert into permissoes (usu_codigo, tabela, inserir, atualizar, visualizar, excluir, imprimir_relatorios, nivel) values (?,?,?,?,?,?,?,?)";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $permissao->getUsu_codigo());
            $statement_sql->bindValue(2, $permissao->getTabela());
            $statement_sql->bindValue(3, $permissao->getInserir());
            $statement_sql->bindValue(4, $permissao->getAtualizar());
            $statement_sql->bindValue(5, $permissao->getVisualizar());
            $statement_sql->bindValue(6, $permissao->getExcluir());
            $statement_sql->bindValue(7, $permissao->getImprimir_relatorios());
            $statement_sql->bindValue(8, $permissao->getNivel());
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_salvar_permissao :: " . $e->getMessage();
        }
    }

    public function m_getTabelas() {
        try {
            $sql = "show tables where 
                    Tables_in_cursoappvendassistemaweb = 'categorias' or
                    Tables_in_cursoappvendassistemaweb = 'boletos' or
                    Tables_in_cursoappvendassistemaweb = 'clientes' or
                    Tables_in_cursoappvendassistemaweb = 'fornecedores' or
                    Tables_in_cursoappvendassistemaweb = 'produtos' or
                    Tables_in_cursoappvendassistemaweb = 'vendac'";

            return ConexaoPDO::getInstance()
                            ->query($sql)
                            ->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            print "Erro em getTabelas :: " . $e->getMessage();
        }
    }

}
