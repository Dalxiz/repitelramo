<?php
    class TipoDocumento{
        private $idTipoDoc;
        private $nombreTipoDoc;

        function __construct($idTipoDoc,$nombreTipoDoc){
            $this->idTipoDoc=$idTipoDoc;
            $this->nombreTipoDoc=$nombreTipoDoc;
        }

        function getIdTipoDoc(){
            return $this->idTipoDoc;
        }

        function getNombreTipoDoc(){
            return $this->nombreTipoDoc;
        }
    }

?>