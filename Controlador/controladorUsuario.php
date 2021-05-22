<?php 

    if (isset($_POST['validar'])) {
        
        require_once '../entidades/usuario.php';
        require_once '../persistencia/daoUsuario.php';
        require_once '../entidades/tipoUsuario.php';

        $usuario = $_POST['Usuario'];
        $password = $_POST['Password'];

        $tipoUsuario= new TipoUsuario("","");

        $nuevoUsuario = new usuario("",$tipoUsuario,$usuario,$password,"");

        $mensaje = validarUsuario($nuevoUsuario);
        
        if ($mensaje ==='ok') {
            
            header("Location: ../Presentacion/principal.php");
        }else{
            echo "andate a la chachu";
        }
    }



?>