<?php

class UsuarioDao {

    private static $instance;

    function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new UsuarioDao ();
        return self::$instance;
    }

    public function m_gravar_usuario(UsuarioBean $usuario) {

        try {
//            $sql = "insert into usuarios (usu_nome, usu_email, usu_celkey, usu_numerocel, usu_liberado, usu_desconto, usu_comissao, usu_usuario, usu_senha, usu_nivel)  values (?,?,?,?,?,?,?,?,?,?)     ";
            $sql = "insert into usuarios (usu_nome, usu_email, usu_celkey, usu_numerocel, usu_liberado, usu_desconto, usu_comissao, usu_usuario, usu_senha, usu_nivel)  values (?,?,?,?,?,?,?,?,?,?)     ";
 
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(1, $usuario->getUsu_nome());
            $statement_sql->bindvalue(2, $usuario->getUsu_email());
            $statement_sql->bindvalue(3, $usuario->getUsu_celkey());
            $statement_sql->bindvalue(4, $usuario->getUsu_numerocel());
            $statement_sql->bindvalue(5, $usuario->getUsu_liberado());
            $statement_sql->bindvalue(6, $usuario->getUsu_desconto());
            $statement_sql->bindvalue(7, $usuario->getUsu_comissao());
            $statement_sql->bindvalue(8, $usuario->getUsu_usuario());
            $statement_sql->bindvalue(9, $usuario->getUsu_senha());
            $statement_sql->bindvalue(10, $usuario->getUsu_nivel());

            $statement_sql->execute();
            return ConexaoPDO::getInstance()->lastInsertId();
        } catch (PDOException $e) {
            print " Erro em m_gravar_usuario " . $e->getMessage();
        }
    }

    public function m_buscar_registro_por_usuario_senha(UsuarioBean $usuario) {
        try {
            $sql = "select * from usuarios where usu_usuario = :usu_usuario and usu_senha = :usu_senha and usu_liberado = 'S'";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":usu_usuario", $usuario->getUsu_usuario());
            $statement_sql->bindvalue(":usu_senha", $usuario->getUsu_senha());
            $statement_sql->execute();
            return $this->m_popula_objeto_usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_buscar_registro_por_usuario_senha" . $e->getMessage();
        }
    }

    public function m_buscar_usuario_por_codigo($codigo) {
        try {
            $sql = "select * from usuarios where usu_codigo = :usu_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":usu_codigo", $codigo);

            $statement_sql->execute();
            return $this->m_popula_objeto_usuario($statement_sql->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print " Erro em m_buscar_usuario_por_codigo" . $e->getMessage();
        }
    }

    public function m_alterar_usuario(UsuarioBean $usuario) {
        try {

            $sql = "update usuarios set usu_nome= :usu_nome, usu_email=:usu_email, usu_celkey=:usu_celkey, usu_numerocel=:usu_numerocel, usu_liberado=:usu_liberado, usu_desconto=:usu_desconto, usu_comissao=:usu_comissao, usu_usuario=:usu_usuario, usu_senha=:usu_senha where usu_codigo=:usu_codigo  ";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":usu_nome", $usuario->getUsu_nome());
            $statement_sql->bindvalue(":usu_email", $usuario->getUsu_email());
            $statement_sql->bindvalue(":usu_celkey", "dd");
            $statement_sql->bindvalue(":usu_numerocel", $usuario->getUsu_numerocel());
            $statement_sql->bindvalue(":usu_liberado", $usuario->getUsu_liberado());
            $statement_sql->bindvalue(":usu_desconto", $usuario->getUsu_desconto());
            $statement_sql->bindvalue(":usu_comissao", $usuario->getUsu_comissao());
            $statement_sql->bindvalue(":usu_usuario", $usuario->getUsu_usuario());
            $statement_sql->bindvalue(":usu_senha", $usuario->getUsu_senha());
            $statement_sql->bindvalue(":usu_codigo", $usuario->getUsu_codigo());
            return $statement_sql->execute();

            // $statement_sql->debugDumpParams();
        } catch (PDOException $e) {
            print " Erro em m_alterar_cliente" . $e->getMessage();
        }
    }

    public function m_buscar_todos_os_usuarios() {

        try {
            $sql = "select * from usuarios";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            return $this->fecht_array($statement_sql);
        } catch (PDOException $e) {
            print " Erro em m_buscar_registro_por_usuario_senha" . $e->getMessage();
        }
    }

    private function fecht_array($statement_sql) {

        $resultado = array();
        if ($statement_sql) {

            while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                $usuario = new UsuarioBean();
                $usuario->setUsu_codigo($linha->usu_codigo);
                $usuario->setUsu_nome($linha->usu_nome);
                $usuario->setUsu_email($linha->usu_email);
                $usuario->setUsu_celkey($linha->usu_celkey);
                $usuario->setUsu_numerocel($linha->usu_numerocel);
                $usuario->setUsu_liberado($linha->usu_liberado);
                $usuario->setUsu_desconto($linha->usu_desconto);
                $usuario->setUsu_comissao($linha->usu_comissao);
                $usuario->setUsu_usuario($linha->usu_usuario);
                $usuario->setUsu_senha($linha->usu_senha);
                $usuario->setUsu_nivel($linha->usu_nivel);
                $resultado[] = $usuario;
            }
        }
        return $resultado;
    }

    private function m_popula_objeto_usuario($linha) {
        $usuario = new UsuarioBean();
        $usuario->setUsu_codigo($linha["usu_codigo"]);
        $usuario->setUsu_nome($linha["usu_nome"]);
        $usuario->setUsu_email($linha["usu_email"]);
        $usuario->setUsu_celkey($linha["usu_celkey"]);
        $usuario->setUsu_numerocel($linha["usu_numerocel"]);
        $usuario->setUsu_liberado($linha["usu_liberado"]);
        $usuario->setUsu_desconto($linha["usu_desconto"]);
        $usuario->setUsu_comissao($linha["usu_comissao"]);
        $usuario->setUsu_usuario($linha["usu_usuario"]);
        $usuario->setUsu_senha($linha["usu_senha"]);
        $usuario->setUsu_nivel($linha["usu_nivel"]);
        return $usuario;
    }

    public function m_deleta_usuario($codigo) {
        try {
            $sql = "delete from usuarios where usu_codigo = :usu_codigo";
            $statement_sql = ConexaoPDO::getInstance()->prepare($sql);
            $statement_sql->bindvalue(":usu_codigo", $codigo);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print " Erro em m_deleta_usuario" . $e->getMessage();
        }
    }

}