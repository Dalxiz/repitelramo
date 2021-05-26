<?php
     function getTodosEncabezadoDocumento(){

        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';

        require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

        $lista = consultarEncabezadoDocumento();
        
        return $lista;
     }
?>