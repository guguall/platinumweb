<?php

session_start();
unset($_SESSION["usu_codigo"]);
unset($_SESSION["usu_nome"]);
unset($_SESSION["usu_usuario"]);
unset($_SESSION["usu_email"]);
session_destroy();
header("Location:../index.php");