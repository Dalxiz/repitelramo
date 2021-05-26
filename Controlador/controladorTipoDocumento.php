<?php
    function getTodosTipoDocumento(){
        //Se usea DOCUMENT_ROOT para evitar problemas con las rutas de documentos
        require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/entidades/tipoDocumento.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoTipoDocumento.php";

        $lista = consultarTiposDocumento();
        
        return $lista;
    }

?>