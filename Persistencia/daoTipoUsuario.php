<?php 

    function consultarTiposUsuarios(){

        include_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $listaTU=[];

            $querySelect = $conn->query("SELECT * FROM TIPO_USUARIO");

            foreach ($querySelect->fetchAll() as $arregloTU) {
                $TU= new tipoUsuario($arregloTU['idTipoUsu'],
                                     $arregloTU['nombreTipoUsu']);

                $listaTU[]=$TU;
            }

            if (count($listaTU) > 0) {
                return $listaTU;
            }else{
                return "La Consulta no devuelve valores";
            }

        } catch (PDOException $pe) {
            return $pe->getMessage();
        }
    }

    function consultarTUPorId($idTipoUsu){
        
        require 'parametrosBD.php';

        try {

            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $listaTU=[];

            $querySelect = $conn->query("SELECT * FROM TIPO_USUARIO WHERE idTipoUsu=".$idTipoUsu);

            foreach ($querySelect->fetchAll() as $arregloTU) {
                $TU= new TipoUsuario($arregloTU['idTipoUsu'],
                                    $arregloTU['nombreTipoUsu']);

                $listaTU[]=$TU;
            }

            if(count($listaTU) > 0){
                return $listaTU[0];
            }else{
                return "La consulta no devuelve registros";
            }
        } catch (PDOException $pe) {

            return $pe->getMessage();
        }
    }

?>