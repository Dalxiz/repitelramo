<?php
    require_once "../Entidades/tipoUsuario.php";
    require_once "../Persistencia/daoTipoUsuario.php";

    $lista = consultarTiposUsuarios();
    $lista2 = consultarTUPorId($idTipoUsu);

    return $lista;
    return $lista2;

?>