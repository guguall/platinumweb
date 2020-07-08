<?php
// header('Content-Type: text/html; charset=UTF-8');
// error_reporting(E_ALL ^ E_NOTICE);
session_start();

function inicializa_sessao($tempoExpiracao, $erro = null) {


    if (!$_SESSION["usu_usuario"]) {
        header("Location:../index.php?erro=" . $erro);
    } else {

        if (isset($_SESSION["ultimoclick"]) and ! empty($_SESSION["ultimoclick"])) {

            $tempoAtual = time();

            if (($tempoAtual - $_SESSION["ultimoclick"]) > $tempoExpiracao) {
                unset($_SESSION["ultimoclick"]);
                $_SESSION = array();
                session_destroy();
                header("Location:../index.php");
                exit();
            } else {
                $_SESSION["ultimoclick"] = time();
            }
        } else {
            $_SESSION["ultimoclick"] = time();
        }
    }
}