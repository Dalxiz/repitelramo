<?php
  
    if(session_status() !== 2  || session_id() === ""){
        session_start();
    }

    //Si no hay usuario identificado redirige a index con un GET para el alert
    if(!isset($_SESSION['usuario'])){
        header ("Location: /repitelramo/index.php?msj=inc");
    }


?>