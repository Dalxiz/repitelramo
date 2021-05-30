<?php
    //Si no es administador devuelve a pagina principal
    require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/entidades/usuario.php";

    if(session_status() !== 2  || session_id() === ""){
        session_start();
    }

    if((isset($_SESSION['usuario'])) && $_SESSION['usuario']->getTipoUsuario()->getNombreTipoUsu() == "Operador"){ 
        header ("Location: /repitelramo/presentacion/principal.php?msj=sinpermiso");
    }

?>