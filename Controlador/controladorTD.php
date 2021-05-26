<?php
    function getTodasTD(){
        include_once "../../persistencia/daoTipoDocumento.php";
        include_once "../../entidades/unidadMedida.php";

        $lista = consultarTodasUM();
        
        return $lista;
    }

?>