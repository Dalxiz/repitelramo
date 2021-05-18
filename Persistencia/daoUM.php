<?php

    function consultarTodasUM(){

    include 'parametrosBD.php';

    try
    {
        $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario, $password);

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $listaUM=[];

        $querySelect = $conexion->query("SELECT * FROM UNIDAD_MEDIDA");

        foreach($querySelect->fetchAll() as $arregloUM)
        {
            $UM= new unidadMedida($arregloUM['idUM'], $arregloUM['nombreUM']);

            $listaUM[]=$UM;
        }

        if(count($listaUM) > 0){
            return $listaUM;
        }else{
            return "La consulta no devuelve registros";
        }
    }
    catch(PDOException $pe)
    {
        return $pe->getMessage();
    }
    }

?>