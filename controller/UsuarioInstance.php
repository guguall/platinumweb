<?php

class UsuarioInstance {

    function __construct() {
        
    }

    public function c_buscar_registro_por_usuario_senha() {
        $usuario = new UsuarioBean();
        $usuario->setUsu_usuario($_POST["usu_usuario"]);
        $usuario->setUsu_senha($_POST["usu_senha"]);
        return UsuarioDao::getInstance()->m_buscar_registro_por_usuario_senha($usuario);
    }

    public function c_gravar_usuario() {
        $usuario = new UsuarioBean();
        $usuario->setUsu_nome($_POST["usu_nome"]);
        $usuario->setUsu_email($_POST["usu_email"]);
        $usuario->setUsu_celkey("");
        $usuario->setUsu_numerocel($_POST["usu_numerocel"]);
        $usuario->setUsu_liberado($_POST["usu_liberado"]);
        $usuario->setUsu_desconto($_POST["usu_desconto"]);
        $usuario->setUsu_comissao($_POST["usu_comissao"]);
        $usuario->setUsu_usuario($_POST["usu_usuario"]);
        $usuario->setUsu_senha($_POST["usu_senha"]);
        $usuario->setUsu_nivel("USER");
        return UsuarioDao::getInstance()->m_gravar_usuario($usuario);
    }

    public function c_buscar_todos_os_usuarios() {
        return UsuarioDao::getInstance()->m_buscar_todos_os_usuarios();
    }

    public function c_buscar_usuario_por_codigo($usu_codigo) {
        return UsuarioDao::getInstance()->m_buscar_usuario_por_codigo($usu_codigo);
    }

    public function c_alterar_usuario() {
        $usuario = new UsuarioBean();
        $usuario->setUsu_codigo($_POST["usu_codigo"]);
        $usuario->setUsu_nome($_POST["usu_nome"]);
        $usuario->setUsu_email($_POST["usu_email"]);
        $usuario->setUsu_celkey($_POST["usu_celkey"]);
        $usuario->setUsu_numerocel($_POST["usu_numerocel"]);
        $usuario->setUsu_liberado($_POST["usu_liberado"]);
        $usuario->setUsu_desconto($_POST["usu_desconto"]);
        $usuario->setUsu_comissao($_POST["usu_comissao"]);
        $usuario->setUsu_usuario($_POST["usu_usuario"]);
        $usuario->setUsu_senha($_POST["usu_senha"]);
        return UsuarioDao::getInstance()->m_alterar_usuario($usuario);
    }

    public function c_deleta_usuario() {
        return UsuarioDao::getInstance()->m_deleta_usuario($_GET["usu_codigo"]);
    }

}

?>
