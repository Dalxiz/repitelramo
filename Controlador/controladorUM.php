<?php
    function getTodasUM(){
        include_once "../../Persistencia/daoUM.php";
        include_once "../../Entidades/unidadMedida.php";

        $lista = consultarTodasUM();
        
        return $lista;
    }

?>