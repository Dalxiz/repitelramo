<?php 

    require_once 'tipoUsuario.php';
    class Usuario{

        private $idUsu;
        private $tipoUsuario;
        private $nombreUsu;
        private $passUsu;
        private $correoUsu;

        function __construct($idUsu, TipoUsuario $tipoUsuario,$nombreUsu,$passUsu,$correoUsu){
            $this->idUsu=$idUsu;
            $this->tipoUsuario=$tipoUsuario;
            $this->nombreUsu=$nombreUsu;
            $this->passUsu=$passUsu;
            $this->correoUsu=$correoUsu;
        }

        function getIdUsu(){
            return $this->idUsu;
        }

        function getTipoUsuario(){
            return $this->tipoUsuario;
        }

        function getNombreUsu(){
            return $this->nombreUsu;
        }

        function getPassUsu(){
            return $this->passUsu;
        }

        function getCorreoUsu(){
            return $this->correoUsu;
        }
    }

?>