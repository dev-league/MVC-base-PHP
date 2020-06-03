<?php

/**
 * @author Jonas Lima
 * @version 1.0
 */

/**
 * autoload das classes de requisições e respostas utilizadas na maioria dos codigos
 */
spl_autoload_register(function ($class_name) {
    if (file_exists('./class/' . $class_name . '.php')) {
        require_once './class/' . $class_name . '.php';
    } elseif (file_exists('./components/' . $class_name . '.php')) {
        require_once './components/' . $class_name . '.php';
    } elseif (file_exists('./tools/' . $class_name . '.php')) {
        require_once './tools/' . $class_name . '.php';
    } elseif (file_exists('./models/' . $class_name . '.php')) {
        require_once './models/' . $class_name . '.php';
    } elseif (file_exists('./models/static' . $class_name . '.php')) {
        require_once './models/static' . $class_name . '.php';
    }
});

//timeset para definir horario local
date_default_timezone_set('America/Bahia');

/**
 * carregando arquivo ORM.php
 * @author Jonas Lima <jonasearth1@gmail.com>
 */
require_once './database/ORM.php';

//tipos de erros visualizaveis
error_reporting(E_ALL ^ E_NOTICE);

//mostrar erros
ini_set("log_errors", 1);
ini_set("display_errors", 1);

//objeto com configurações do banco de dados
$banco = (object) [
    "host" => "localhost",
    "user" => "usuario",
    "password" => "senha",
    "database" => "banco"
];

//inicializando ORM
$orm = new ORM();

//criando conexão com banco de dados
$orm->create($banco);

//deixando ORM globalmente acessivel
$GLOBALS["ORM"] = $orm;
