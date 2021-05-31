<?php

    //Función para registar documento incluyendo el detalle de documento, usando éste para ingresar un documento
    function registrarDocumentoCompleto(EncabezadoDocumento $nuevoEncabezado){

        require 'parametrosBD.php';
        require 'daoDetalleDocumento.php';
        

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction(); //Comenzar transacción para evitar duplicados
            
            $query = $conn->prepare("INSERT INTO ENCABEZADO_DOCUMENTO (idUsu, rutEmp, idTipoDoc, folioDoc, fechaRegistro,
                                    rutCliente, condPago, estadoDoc, neto, iva, total, observaciones, canceladoPor) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            $resultadoDetalles;
            $result = $query->execute([$nuevoEncabezado->getUsuario()->getIdUsu(),
                                       $nuevoEncabezado->getEmpresa()->getRutEmp(),
                                       $nuevoEncabezado->getTipoDoc()->getIdTipoDoc(),
                                       $nuevoEncabezado->getFolioDoc(),
                                       $nuevoEncabezado->getFechaRegistro(),
                                       $nuevoEncabezado->getCliente()->getRutCliente(),
                                       $nuevoEncabezado->getCondPago(),
                                       $nuevoEncabezado->getEstadoDoc(),
                                       $nuevoEncabezado->getNeto(),
                                       $nuevoEncabezado->getIva(),
                                       $nuevoEncabezado->getTotal(),
                                       !empty($nuevoEncabezado->getObservaciones()) ? $nuevoEncabezado->getObservaciones() : NULL ,
                                       !empty($nuevoEncabezado->getCanceladoPor()) ?  $nuevoEncabezado->getCanceladoPor() : NULL,                                    
                                       ]);

            foreach($nuevoEncabezado->getListaDetalles() as $detalles){
                $resultadoDetalles = registrarDetalleDocumentoDesdeEncabezado($detalles, $conn);
                if( strpos($resultadoDetalles, "err") === 0 ){ //Si da error detalle, quiebra el foreach y devuelve result false para hacer rollback
                    $result = false;
                    break;
                }
            }
            
            if($result === true)
            {
                $conn->commit();
                return 'ok' . " - ¡Factura electrónica con Folio: " . $nuevoEncabezado->getFolioDoc() . " registrado correctamente!";
            }
            else
            {
                $conn->rollBack(); //Si hay algun problema, se devuelve toda la transacción (incuyendo tablas de detalle)
                return $resultadoDetalles; //Se retorna el mensaje de error desde detalleDocumento
            }

        }catch(PDOException $pe){
            $conn->rollBack();
            
            if(strpos($pe->getMessage(),"violation: 1062")){
                return "err : Factura electrónica con Folio: '" . $nuevoEncabezado->getFolioDoc() ."' ya se encuentra registrado. El folio debe ser único.";
            }
            return "err : " . $pe->getMessage();
        }
    }

    function actualizarDocumentoCompleto(EncabezadoDocumento $nuevoEncabezado){

        require 'parametrosBD.php';
        require 'daoDetalleDocumento.php';

        //Coroborar si la sesion se ha iniciado
        if(session_status() !== 2  || session_id() === ""){
            session_start();
        } 

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction(); //Comenzar trasnacción para evitar duplicados
            
            $query = $conn->prepare("UPDATE ENCABEZADO_DOCUMENTO SET rutEmp=?, idTipoDoc=?, folioDoc=?, fechaRegistro=?,
                                    rutCliente=?, condPago=?, estadoDoc=?, neto=?, iva=?, total=?, observaciones=?, canceladoPor=? 
                                    WHERE idTipoDoc=? AND folioDoc=?");
    
            $resultadoDetalles;

            $result = $query->execute([$nuevoEncabezado->getEmpresa()->getRutEmp(),
                                       $nuevoEncabezado->getTipoDoc()->getIdTipoDoc(),
                                       $nuevoEncabezado->getFolioDoc(),
                                       $nuevoEncabezado->getFechaRegistro(),
                                       $nuevoEncabezado->getCliente()->getRutCliente(),
                                       $nuevoEncabezado->getCondPago(),
                                       $nuevoEncabezado->getEstadoDoc(),
                                       $nuevoEncabezado->getNeto(),
                                       $nuevoEncabezado->getIva(),
                                       $nuevoEncabezado->getTotal(),
                                       !empty($nuevoEncabezado->getObservaciones()) ? $nuevoEncabezado->getObservaciones() : NULL ,
                                       !empty($nuevoEncabezado->getCanceladoPor()) ?  $nuevoEncabezado->getCanceladoPor() : NULL,                                    
                                       $_SESSION['encabezado'][0]->getTipoDoc()->getIdTipoDoc(),
                                       $_SESSION['encabezado'][0]->getFolioDoc()]);

            if($nuevoEncabezado->getListaDetalles() != $_SESSION['encabezado'][0]->getListaDetalles()){
                //SI hay cambios de productos se realizan cambios a la tabla detalle
                $resultadoDetalles = eliminarDetalleDocumentoDesdeEncabezado($nuevoEncabezado, $conn);
                
                if(strpos($resultadoDetalles, "err") === 0 ){
                    $result = false;
                }

                else{
                    foreach($nuevoEncabezado->getListaDetalles() as $detalles){
                        
                        $resultadoDetalles = registrarDetalleDocumentoDesdeEncabezadoCon2Clases($detalles, $nuevoEncabezado, $conn);
                        if(strpos($resultadoDetalles, "err") === 0 ){ //Si da error detalle, quiebra el foreach y devuelve result false para hacer rollback
                            $result = false;
                            break;
                        }
                    }

                }  
            }
 
            if($result === true)
            {
                $conn->commit();
                return 'ok' . " - ¡Factura electrónica actualizada correctamente!. Folio: " . $nuevoEncabezado->getFolioDoc() . ".";
            }
            else
            {
                $conn->rollBack(); //Si hay algun problema, se devuelve toda la transacción (incuyendo tablas de detalle)
                return $resultadoDetalles; //Se retorna el mensaje de error desde detalleDocumento
            }

        }catch(PDOException $pe){
            $conn->rollBack();
            return "err : " . $pe->getMessage();
        }
    }

    function cambiarEstadoDoc($idTipoDoc, $folio, $fechaEmision, $estado){
        
        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction(); //Comenzar trasnacción para evitar duplicados
            
            $query = $conn->prepare("UPDATE ENCABEZADO_DOCUMENTO SET estadoDoc=?, fechaEmision=?
                                    WHERE idTipoDoc=? AND folioDoc=?");

            $result = $query->execute([$estado,
                                       !empty($fechaEmision) ? $fechaEmision : NULL, 
                                       $idTipoDoc, $folio]);
 
            if($result === true)
            {
                $conn->commit();
                if ($estado == "Emitido"){
                    return 'ok ' . " - ¡Factura con folio '$folio' emitida correctamente!";
                } else {
                    return 'ok ' . " - ¡Factura con folio '$folio' anulada correctamente!";
                }
            }
            else
            {
                $conn->rollBack(); 
                return $result; 
            }

        }catch(PDOException $pe){
            $conn->rollBack();
            return "err : " . $pe->getMessage();
        }
}

    function consultarEncabezadoDocumento(){

        require 'parametrosBD.php';
        require_once 'daoEmpresa.php';
        require_once 'daoUsuario.php';
        require_once 'daoTipoDocumento.php';
        require_once 'daoClientes.php';
        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaEncabezados=[];

            $querySelect = $conexion->query("SELECT * FROM ENCABEZADO_DOCUMENTO");

            foreach($querySelect->fetchAll() as $tablaEncabezadoBBDD)
            {

                $usuario = consultarUsuarioPorId($tablaEncabezadoBBDD['idUsu']);
                $empresa = consultarEmpresaPorRut($tablaEncabezadoBBDD['rutEmp']);
                $tipoDoc = consultarTiposDocumentoPorId($tablaEncabezadoBBDD['idTipoDoc']);
                $cliente = consultarClientePorRut($tablaEncabezadoBBDD['rutCliente']);

                $encabeadoSel= new EncabezadoDocumento($usuario, $empresa, $tipoDoc, $tablaEncabezadoBBDD['folioDoc'],$tablaEncabezadoBBDD['fechaRegistro'], $tablaEncabezadoBBDD['fechaEmision'], $cliente, $tablaEncabezadoBBDD['condPago'], $tablaEncabezadoBBDD['estadoDoc'], 
                $tablaEncabezadoBBDD['neto'], $tablaEncabezadoBBDD['iva'], $tablaEncabezadoBBDD['total'], $tablaEncabezadoBBDD['observaciones'],
                $tablaEncabezadoBBDD['canceladoPor']);

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

    function consultarEncabezadoDocumentoPorFolio($idTipoDoc, $folioComp){

        require 'parametrosBD.php';
        require_once 'daoEmpresa.php';
        require_once 'daoUsuario.php';
        require_once 'daoTipoDocumento.php';
        require_once 'daoClientes.php';
        require_once 'daoDetalleDocumento.php';

        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaEncabezados=[];

            $querySelect = $conexion->query("SELECT * FROM ENCABEZADO_DOCUMENTO WHERE idTipoDoc = " .$idTipoDoc . " AND folioDoc = " .$folioComp );

            foreach($querySelect->fetchAll() as $tablaEncabezadoBBDD)
            {

                $usuario = consultarUsuarioPorId($tablaEncabezadoBBDD['idUsu']);
                $empresa = consultarEmpresaPorRut($tablaEncabezadoBBDD['rutEmp']);
                $tipoDoc = consultarTiposDocumentoPorId($tablaEncabezadoBBDD['idTipoDoc']);
                $cliente = consultarClientePorRut($tablaEncabezadoBBDD['rutCliente']);

                $encabeadoSel= new EncabezadoDocumento($usuario, $empresa, $tipoDoc, $tablaEncabezadoBBDD['folioDoc'],
                $tablaEncabezadoBBDD['fechaRegistro'], $tablaEncabezadoBBDD['fechaEmision'],  $cliente, $tablaEncabezadoBBDD['condPago'], $tablaEncabezadoBBDD['estadoDoc'], 
                $tablaEncabezadoBBDD['neto'], $tablaEncabezadoBBDD['iva'], $tablaEncabezadoBBDD['total'], $tablaEncabezadoBBDD['observaciones'],
                $tablaEncabezadoBBDD['canceladoPor']);

                $encabeadoSel->addVariosDetalles(consultarDetalleDocumentoPorFolio($idTipoDoc, $folioComp));

                $listaEncabezados[]=$encabeadoSel;
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

    //Metodo solo para ingresar encabezado, no usado por ahora y por ahora usado solo registrarDocumentoCompleto()
    function registrarEncabezadoDocumento(EncabezadoDocumento $nuevoEncabezado){

        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO ENCABEZADO_DOCUMENTO (idUsu, rutEmp, idTipoDoc, folioDoc, fechaRegistro,
                                    rutCliente, condPago, estadoDoc, neto, iva, total, observaciones, canceladoPor) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $result = $query->execute([$nuevoEncabezado->getUsuario()->getIdUsu(),
                                        $nuevoEncabezado->getEmpresa()->getRutEmp(),
                                        $nuevoEncabezado->getTipoDoc()->getIdTipoDoc(),
                                        $nuevoEncabezado->getFolioDoc(),
                                        $nuevoEncabezado->getFechaRegistro(),
                                        $nuevoEncabezado->getCliente()->getRutCliente(),
                                        $nuevoEncabezado->getCondPago(),
                                        $nuevoEncabezado->getEstadoDoc(),
                                        $nuevoEncabezado->getNeto(),
                                        $nuevoEncabezado->getIva(),
                                        $nuevoEncabezado->getTotal(),
                                        !empty($nuevoEncabezado->getObservaciones()) ? $nuevoEncabezado->getObservaciones() : NULL ,
                                        !empty($nuevoEncabezado->getCanceladoPor()) ?  $nuevoEncabezado->getCanceladoPor() : NULL,                                    
                                        ]);
            
            if($result === true)
            {
                return 'ok' ;
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            return "err : " . $pe->getMessage();
        }
    }

    function consultaLibroVenta($mes,$anio){

        require 'parametrosBD.php';
        require_once 'daoEmpresa.php';
        require_once 'daoUsuario.php';
        require_once 'daoTipoDocumento.php';
        require_once 'daoClientes.php';
        require_once 'daoDetalleDocumento.php';

        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaEncabezados=[];

            $querySelect = $conexion->query("SELECT * FROM ENCABEZADO_DOCUMENTO WHERE MONTH(fechaEmision) ='".$mes."' AND YEAR(fechaEmision) ='".$anio."'");

            foreach($querySelect->fetchAll() as $tablaEncabezadoBBDD)
            {

                $usuario = consultarUsuarioPorId($tablaEncabezadoBBDD['idUsu']);
                $empresa = consultarEmpresaPorRut($tablaEncabezadoBBDD['rutEmp']);
                $tipoDoc = consultarTiposDocumentoPorId($tablaEncabezadoBBDD['idTipoDoc']);
                $cliente = consultarClientePorRut($tablaEncabezadoBBDD['rutCliente']);

                $encabeadoSel= new EncabezadoDocumento($usuario, $empresa, $tipoDoc, $tablaEncabezadoBBDD['folioDoc'],
                $tablaEncabezadoBBDD['fechaRegistro'],$tablaEncabezadoBBDD['fechaEmision'], $cliente, $tablaEncabezadoBBDD['condPago'], $tablaEncabezadoBBDD['estadoDoc'], 
                $tablaEncabezadoBBDD['neto'], $tablaEncabezadoBBDD['iva'], $tablaEncabezadoBBDD['total'], $tablaEncabezadoBBDD['observaciones'],
                $tablaEncabezadoBBDD['canceladoPor']);

                // $encabeadoSel->addVariosDetalles(consultarDetalleDocumentoPorFolio($idTipoDoc, $folioComp));

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

?>