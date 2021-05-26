<?php 

    function consultarTiposDocumento(){

        include 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $listaTD=[];

            $querySelect = $conn->query("SELECT * FROM TIPO_DOCUMENTO");

            foreach ($querySelect->fetchAll() as $arregloTD) {
                $TD= new TipoDocumento($arregloTD['idTipoDoc'],
                                     $arregloTD['nombreTipoDoc']);

                $listaTD[]=$TD;
            }

            if (count($listaTD) > 0) {
                return $listaTD;
            }else{
                return "La Consulta no devuelve valores";
            }

        } catch (PDOException $pe) {
            return $pe->getMessage();
        }
    }

    function consultarTiposDocumentoPorId($idTipoDoc){
        
        require 'parametrosBD.php';

        try {

            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $listaTD=[];

            $querySelect = $conn->query("SELECT * FROM TIPO_DOCUMENTO WHERE idTipoDoc=".$idTipoDoc);

            foreach ($querySelect->fetchAll() as $arregloTD) {
                $TD= new TipoDocumento($arregloTD['idTipoDoc'],
                                    $arregloTD['nombreTipoDoc']);

                $listaTD[]=$TD;
            }

            if(count($listaTD) > 0){
                return $listaTD[0];
            }else{
                return "La consulta no devuelve registros";
            }
        } catch (PDOException $pe) {

            return $pe->getMessage();
        }
    }

?>