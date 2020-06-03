<?php
class AdminModel extends AdminController
{
    /**
     * Classe responsavel pelos modelos 
     * que serão exibidos para o usuário
     * 
     */

    public function pageAdmins()
    {
        $admins = AdminControllerData::getAllAdmins();
        $this->createTable($admins);
    }


    public function createTable($admins)
    {
        /**
         * monta uma tabela listando os administradores
         */
        foreach ($admins as $index => $admin) {
            /**
             * utiliza html para mostrar ou 
             * alguma outa lib para montar o html
             */
        }
    }
}
