<?php

class Returns
{
    const BUSCA_SUCCESS  = "Busca concluida com sucesso!";
    const BUSCA_EMPTY  = "Nenhum resultado encontrado!";

    const INSERIDO_SUCCESS = "Inserido com sucesso!";
    const INSERIDO_ERROR = "Error ao adicionar!";

    const UPDATE_SUCCESS = "Atualizado com sucesso!";
    const UPDATE_ERROR = "Error ao atualizar!";

    const DELETE_SUCCESS = "Excluido com sucesso!";
    const DELETE_ERROR = "Error ao excluir!";

    const PERM_FAIL  = "Você não tem permição!";

    const CAMPOS_INVALIDOS = "Verifique os campos e tente novamente!";


    public static function simpleMsgError($msg)
    {
        $data = [
            "message" => $msg,
            "error" => true,
            "data" => []
        ];
        self::jsonSend($data);
    }

    public static function msgData($msg, $data = [])
    {
        $dat = [
            "message" => $msg,
            "error" => false,
            "data" => $data
        ];
        self::jsonSend($dat);
    }
    private static function jsonSend($data)
    {
        die(json_encode($data));
    }
}
