<?php

/*
define('HOST', 'appvendas.mysql.dbaas.com.br');
define('DBNAME', 'appvendas');
define('CHARSET', 'utf8');
define('USER', 'appvendas');
define('PASSWORD', 'cursoappvendas');
*/

class ConexaoPDO {

    public static $instance;  

    public static function getInstance() {
        if (!isset(self::$instance)) {
//            self::$instance = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE));
            self::$instance = new PDO('mysql:host=localhost;dbname=cursoappvendassistemaweb','root','020473',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE));

            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }

}