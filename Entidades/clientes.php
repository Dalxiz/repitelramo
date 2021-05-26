<?php 

    class Cliente{

        private $rutCliente;
        private $dvCliente;
        private $nombRazonSocial;
        private $giroCliente;
        private $direccion;
        private $comuna;
        private $ciudad;
        private $telefono;
        private $email;

        function __construct($rutCliente,$dvCliente,$nombRazonSocial,$giroCliente,$direccion,$comuna,$ciudad,$telefono,$email){
            $this->rutCliente=$rutCliente;
            $this->dvCliente=$dvCliente;
            $this->nombRazonSocial=$nombRazonSocial;
            $this->giroCliente=$giroCliente;
            $this->direccion=$direccion;
            $this->comuna=$comuna;
            $this->ciudad=$ciudad;
            $this->telefono=$telefono;
            $this->email=$email;
        }

        function getRutCliente(){
            return $this->rutCliente;
        }

        function getDvCliente(){
            return $this->dvCliente;
        }

        function getNombRazonSocial(){
            return $this->nombRazonSocial;
        }

        function getGiroCliente(){
            return $this->giroCliente;
        }

        function getDireccion(){
            return $this->direccion;
        }

        function getComuna(){
            return $this->comuna;
        }

        function getCiudad(){
            return $this->ciudad;
        }

        function getTelefono(){
            return $this->telefono;
        }

        function getEmail(){
            return $this->email;
        }

        function getRutCompleto(){
            return $this->rutCliente . '-' . $this->dvCliente;
        }
    }


?>