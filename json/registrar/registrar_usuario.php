<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST["usu_usuario"]) && isset($_POST["usu_senha"])) {

    require_once '../../include/auto_load_path_2.php';

    $usuario = new UsuarioInstance();
    $usuarioBean = new UsuarioBean();
    $usuarioBean = $usuario->c_buscar_registro_por_usuario_senha();

    if (!is_null($usuarioBean->getUsu_usuario()) && !is_null($usuarioBean->getUsu_senha())) {

        $resposta["usuario_array"] = array();
        $user = array();
        $user["usu_codigo"] = $usuarioBean->getUsu_codigo();
        $user["usu_desconto"] = $usuarioBean->getUsu_desconto();
        $user["usu_usuario"] = $usuarioBean->getUsu_usuario();
        $user["usu_senha"] = $usuarioBean->getUsu_senha();
        array_push($resposta["usuario_array"], $user);
        $resposta ["sucesso"] = 1;
        $resposta ["mensagem"] = "Dados retornados com sucesso!";

        echo json_encode($resposta);
    } else {
        $resposta ["sucesso"] = 2;
        $resposta ["mensagem"] = "Não foi possivel registrar!";
        echo json_encode($resposta);
    }
}
?>