<?php

/**
 * 
 * @author Jonas Lima <jonasearth1@gmail.com>
 */

/**
 * Inicializador de sessao
 */
session_start();
/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Expose-Headers: *');
header('Access-Control-Allow-Credentials: true');
*/

/**
 * Condicional para aceitar post com json
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-type:application/json');
    $json = json_decode(file_get_contents('php://input'));
    if ($json != null) {
        foreach ($json as $key => $value) {
            @$_POST[$key] = $value;
        }
    }
}

//carrega o FastRoute
require './vendor/autoload.php';
//carrega algumas configurações do sistema
require_once './config/config.php';
//carrega classe com rotas
require './config/routes.php';

//inicializado FastRoute
$dispatcher = FastRoute\simpleDispatcher(function (
    FastRoute\RouteCollector $r
) {
    //Adicionando rotas pelo arquivo de rotas
    Routes::init($r);
});

// Fetch method and URI from somewhere
$parm = Routes::getParam();

//inicializando as rotas
Routes::startRoutes($dispatcher, $parm);
