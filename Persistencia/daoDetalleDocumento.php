<?php

    //Recibe la conexión desde daoEncabezadoDocumento
    function registrarDetalleDocumentoDesdeEncabezado(DetalleDocumento $nuevoDetalle, PDO $conn){

        require 'parametrosBD.php';

        try{
           
            $query = $conn->prepare("INSERT INTO DETALLE_DOCUMENTO (idTipoDoc, folioDoc, codProd, precioUnitario, cantUnitaria, descuento, valor) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
            $result = $query->execute([$nuevoDetalle->getEncabezadoDocumento()->getTipoDoc()->getIdTipoDoc(),
                                       $nuevoDetalle->getEncabezadoDocumento()->getFolioDoc(), 
                                       $nuevoDetalle->getProducto()->getCodProd(),
                                       $nuevoDetalle->getPrecioUnitario(),
                                       $nuevoDetalle->getCantUnitaria(),
                                       $nuevoDetalle->getDescuento(),
                                       $nuevoDetalle->getValor()]);
            
            if($result === true)
            {
                return 'ok';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            return "err : " . $pe->getMessage();

        }
    } 
    

    //Recibe la conexión desde daoEncabezadoDocumento
    function eliminarDetalleDocumentoDesdeEncabezado(EncabezadoDocumento $nuevoEncabezado, PDO $conn){

        require 'parametrosBD.php';

        try{
           
            $query = $conn->prepare("DELETE FROM DETALLE_DOCUMENTO 
                                    WHERE idTipoDoc =  ? AND folioDoc = ?");
    
            $result = $query->execute([$nuevoEncabezado->getTipoDoc()->getIdTipoDoc(),
                                       $nuevoEncabezado->getFolioDoc()]);
            
            if($result === true)
            {
                return 'ok';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            return "err : " . $pe->getMessage();

        }
    }  

    function consultarDetalleDocumentoPorFolio($idTipoDoc, $folioComp){

        require 'parametrosBD.php';
        require_once 'daoProducto.php';

        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaDetalles=[];

            $querySelect = $conexion->query("SELECT * FROM DETALLE_DOCUMENTO WHERE idTipoDoc = " . $idTipoDoc . " AND folioDoc = " . $folioComp);

            foreach($querySelect->fetchAll() as $tablaDetalleBBDD)
            {

                $producto = consultarProductoPorCodigo($tablaDetalleBBDD['codProd']);

                $detalleSel = new DetalleDocumento("", "", $producto, $tablaDetalleBBDD['precioUnitario'], 
                $tablaDetalleBBDD['cantUnitaria'], $tablaDetalleBBDD['descuento'], $tablaDetalleBBDD['valor']);
              
                $listaDetalles[]=$detalleSel; //1,2,3,4,5,6,7,
            }

            if(count($listaDetalles) > 0){
                return $listaDetalles;
            }else{
                return ($lista=[]);
            }
        }
        catch(PDOException $pe)
        {
            return $pe->getMessage();

        }
    }

    function registrarDetalleDocumentoDesdeEncabezadoCon2Clases(DetalleDocumento $nuevoDetalle, EncabezadoDocumento $nuevoEncabezado, PDO $conn){

        require 'parametrosBD.php';

        try{
           
            $query = $conn->prepare("INSERT INTO DETALLE_DOCUMENTO (idTipoDoc, folioDoc, codProd, precioUnitario, cantUnitaria, descuento, valor) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
            $result = $query->execute([$nuevoEncabezado->getTipoDoc()->getIdTipoDoc(),
                                       $nuevoEncabezado->getFolioDoc(), 
                                       $nuevoDetalle->getProducto()->getCodProd(),
                                       $nuevoDetalle->getPrecioUnitario(),
                                       $nuevoDetalle->getCantUnitaria(),
                                       $nuevoDetalle->getDescuento(),
                                       $nuevoDetalle->getValor()]);
            
            if($result === true)
            {
                return 'ok';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            return "err : " . $pe->getMessage();

        }
    } 


    //No usado por ahora, la pagina usa el registrarDetalleDocumentoDesdeEncabezado(), puede servir a futuro si se cambia llamada
    function registrarDetalleDocumento(DetalleDocumento $nuevoDetalle){

        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO DETALLE_DOCUMENTO (idTipoDoc, folioDoc, codProd, precioUnitario, cantUnitaria, descuento, valor) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
            $result = $query->execute([$nuevoDetalle->getEncabezadoDocumento()->getTipoDoc()->getIdTipoDoc(),
                                        $nuevoDetalle->getEncabezadoDocumento()->getFolioDoc(), 
                                        $nuevoDetalle->getProducto()->getCodProd(),
                                        $nuevoDetalle->getPrecioUnitario(),
                                        $nuevoDetalle->getCantUnitaria(),
                                        $nuevoDetalle->getDescuento(),
                                        $nuevoDetalle->getValor()]);
            
            if($result === true)
            {
                return 'ok';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            return "err : " . $pe->getMessage();

        }
    }


    

?>