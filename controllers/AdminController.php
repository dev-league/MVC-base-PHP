<?php

/**
 * Controlador da Classe Admin
 * responsavel pelo gerenciamento 
 * das paginas da classe Admin
 */
class AdminController extends Admin
{

    public function admins($method, $route) //parâmetros recebidos do castHandler (Opcional) 
    {
        $this->construct("AdminModel", "pageAdmins");
    }

    //recebe a classe e metodo do modelo que construirá aquela pagina
    public function construct($modelClass, $model)
    {
        /**
         * chama todas os codigos estaticos da pagina, como cabeçalho e rodapé
         * você pode retiralos dessa função e colicar direto no model se deseja que 
         * os mesmo tambem sejam dinamicos
         */

        /**
         * metodos chamados de maneira estatica pois
         * não dependem do controlador para agir
         */
        Header::getHeader();


        /**
         * Aberto um objeto para que o mesmo tenha acesso ao 
         * controlador 
         */
        $class = new $modelClass();
        $class->$model();

        /**
         * metodos chamados de maneira estatica pois
         * não dependem do controlador para agir
         */
        Footer::getFooter();
    }
}


/**
 * Responsavel pelas requisições ao ORM
 */
class AdminControllerDB extends AdminController
{

    public static function getAll()
    {
        $response = $GLOBALS["ORM"]->getAll(new Admin);

        return $response->status ? $response->data : [];
    }
}

/**
 * Responsavel pelas regras envolvidas 
 * com a classe Admin (verificações de permições, tratamento de expt e etc)
 */
class AdminControllerData extends AdminController
{


    /**
     * 
     * verifica se o usuario tem permição para 
     * executar esta ação
     *
     * @return array
     */
    public static function getAllAdmins()
    {
        return self::verifyAuth() ? AdminControllerDB::getAll() : Pages::ERROR403();
    }

    /**
     * 
     * verifica se o usuario tem permição para 
     * executar esta ação
     *
     * @return bool
     */
    public static function verifyAuth()
    {
    }
}
