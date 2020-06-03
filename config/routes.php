<?php

class Routes
{
    public $uri;

    /**
     * init function
     *
     * @param [FastRoute] $r
     * @return void
     */
    public static function init($r)
    {
        /**
         * Rotas De visualização
         */
        $r->addGroup('', function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/admins', '["AdminController", "admins"]');
        });
    }

    /**
     * getParam function
     * metodo para pegar a url e o metodo da requisição
     * @return array
     */
    public static function getParam()
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $letrafinal = substr($uri, -1);
        if ($letrafinal == "/") {
            $uri = substr($uri, 0, -1);
        }
        $uri = rawurldecode($uri);
        $GLOBALS['URL_PARAM'] = $uri;
        $GLOBALS['httpMethod'] = $httpMethod;
        return [$httpMethod, $uri];
    }

    /**
     * startRoutes function
     * metodo que verifica se o request é valido
     * e permitido
     * @param [Routes] $dispatcher
     * @param [array] $parm
     * @return void
     */
    public static function startRoutes($dispatcher, $parm)
    {
        //Returns.php é um modelo padrão de retorno para facilitar o tratamento do front-end

        require_once './class/Returns.php';
        $routeInfo = $dispatcher->dispatch($parm[0], $parm[1]);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                Pages::ERROR404();
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                Pages::ERROR403();
                break;
            case FastRoute\Dispatcher::FOUND:
                self::castHandler($routeInfo);
                break;
        }
    }

    /**
     * castHandler function
     * metodo chamado quando o request é valido e a rota existe
     * pega os parametros recebidos da rota e chama o objeto/methodo/controlador
     * responsavel por aquela rota
     * @param [array] $route
     * @return void
     */
    private static function castHandler($route)
    {
        $httpM = "_" . $GLOBALS['httpMethod'];
        $handler = json_decode($route[1]);
        //separação entre rotas para visualização e rotas para requisições

        require_once './models/' . $handler[0] . '.php';

        $component = new $handler[0]();
        $fun = $handler[1];
        $component->$fun($httpM, $route);
    }
}
