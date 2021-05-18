<?php 

    class UnidadMedida{

        private $idUM;
        private $nombreUM;

        function __construct($idUM,$nombreUM){
            $this->idUM=$idUM;
            $this->nombreUM=$nombreUM;
        }

        function getIdUM(){
            return $this->idUM;
        }

        function getNombreUM(){
            return $this->nombreUM;
        }
    }

?>