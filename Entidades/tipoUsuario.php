<?php 

    class TipoUsuario{

        private $idTipoUsu;
        private $nombreTipoUsu;

        function __construct($idTipoUsu,$nombreTipoUsu){
            $this->idTipoUsu=$idTipoUsu;
            $this->nombreTipoUsu=$nombreTipoUsu;
        }

        function getIdTipoUsu(){
            return $this->idTipoUsu;
        }

        function getNombreTipoUsu(){
            return $this->nombreTipoUsu;
        }
    }

?>