<?php 

    require_once 'tipoUsuario.php';

    class Usuario{

        private $idUsu;
        private $tipoUsuario;
        private $nombreUsu;
        private $passUsu;
        private $CorreoUsu;

        function __construct($idUsu, TipoUsuario $tipoUsuario,$nombreUsu,){
            $this->idUsu=$idUsu;
            $this->tipoUsuario=$tipoUsuario;
        }
    }

?>