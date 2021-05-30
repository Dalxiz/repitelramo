<?php
    function getTodasUM(){
        include_once "../../persistencia/daoUM.php";
        include_once "../../entidades/unidadMedida.php";

        $lista = consultarTodasUM();
        
        return $lista;
    }

?>