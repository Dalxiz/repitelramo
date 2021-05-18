<?php

    class Empresa{

        private $rutEmp;
        private $dvEmp;
        private $razonEmp;
        private $giroEmp;

        function __construct($rutEmp,$dvEmp,$razonEmp,$giroEmp){

            $this->rutEmp=$rutEmp;
            $this->dvEmp=$dvEmp;
            $this->razonEmp=$razonEmp;
            $this->giroEmp=$giroEmp;
        }

        function getRutEmp(){
            return $this->rutEmp;
        }

        function getDvEmp(){
            return $this->dvEmp;
        }

        function getRazonEmp(){
            return $this->razonEmp;
        }

        function getGiroEmp(){
            return $this->giroEmp;
        }

        function getRutCompleto(){

        }
    }
?>