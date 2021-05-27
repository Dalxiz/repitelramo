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

    //Por implementar
    function consultarDetalleDocumento(){

        require 'parametrosBD.php';
        require_once 'daoEncabezadoDocumento.php';
        require_once 'daoProducto.php';

        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaEncabezados=[];

            $querySelect = $conexion->query("SELECT * FROM DETALLE_DOCUMENTO");

            foreach($querySelect->fetchAll() as $tablaEncabezadoBBDD)
            {

                $encabezadoDocumento = consultarUsuarioPorId($tablaEncabezadoBBDD['idUsu']);
                $producto = consultarProductoPorCodigo($tablaEncabezadoBBDD['codProd']);
              
                /*
                $encabeadoSel= new EncabezadoDocumento($usuario, $empresa, $tipoDoc, $tablaEncabezadoBBDD['folioDoc'],
                $tablaEncabezadoBBDD['fechaEmision'], $cliente, $tablaEncabezadoBBDD['condPago'], $tablaEncabezadoBBDD['estadoDoc'], 
                $tablaEncabezadoBBDD['neto'], $tablaEncabezadoBBDD['iva'], $tablaEncabezadoBBDD['total'], $tablaEncabezadoBBDD['observaciones'],
                $tablaEncabezadoBBDD['canceladoPor']);*/

                $listaEncabezados[]=$encabeadoSel; //1,2,3,4,5,6,7,
            }

            if(count($listaEncabezados) > 0){
                return $listaEncabezados;
            }else{
                return ($lista=[]);
            }
        }
        catch(PDOException $pe)
        {
            return $pe->getMessage();

        }
    }

    ///POR IMPLEMENTAR
    function actualizarDetalleDocumento(Producto $nuevoProducto){

        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryUpdate = $conn->prepare("UPDATE PRODUCTO SET descripcion=?, idUM=?, precioUnitario=? 
                                    WHERE codProd=?");
    
            $result = $queryUpdate->execute([$nuevoProducto->getDescripcion(), $nuevoProducto->getUnidadMedida()->getIdUM(),
                                        $nuevoProducto->getPrecioUnitaro(), $nuevoProducto->getCodProd()]);
            
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

    ///POR IMPLEMENTAR
    function eliminarDetalleoDocumento(Producto $nuevoProducto){

        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryDelete = $conn->prepare("DELETE FROM PRODUCTO WHERE codProd=?");
    
            $result = $queryDelete->execute([$nuevoProducto->getCodProd()]);
            
            if($result === true)
            {
                return 'ok  - Producto: ' . $nuevoProducto->getCodProd() . ' - ' . $nuevoProducto->getDescripcion() . ' Eliminado Correctamente!';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            if(strpos($pe->getMessage(),"violation: 1451")){
                return "err : El Código del Producto: '" . $nuevoProducto->getCodProd() ."' esta siendo utilizado por documentos, no es posible eliminarlo. Contactese con el administador del sistema si desea eleminarlo del sistema";
            }

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