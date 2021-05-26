<?php

    ///POR IMPLEMENTAR
    function registrarEncabezadoDocumento(Producto $nuevoProducto){

        require 'parametrosBD.php';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO PRODUCTO (codProd, descripcion, idUM, precioUnitario) 
                                    VALUES (?, ?, ?, ?)");
    
            $result = $query->execute([$nuevoProducto->getCodProd(), $nuevoProducto->getDescripcion(), 
            $nuevoProducto->getUnidadMedida()->getIdUM(), $nuevoProducto->getPrecioUnitaro()]);
            
            if($result === true)
            {
                return 'ok'  . " - Producto: " . $nuevoProducto->getCodProd() . " - " . $nuevoProducto->getDescripcion()  . " Registrado Correctamente!";
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            if(strpos($pe->getMessage(),"violation: 1062")){
                return "err : El Código del Producto: '" . $nuevoProducto->getCodProd() ."' ya se encuentra registrado. El código debe ser único.";
            }

            else{
                return "err : " . $pe->getMessage();
            }

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

                $encabeadoSel= new EncabezadoDocumento($usuario, $empresa, $tipoDoc, $tablaEncabezadoBBDD['folioDoc'],
                $tablaEncabezadoBBDD['fechaEmision'], $cliente, $tablaEncabezadoBBDD['condPago'], $tablaEncabezadoBBDD['estadoDoc'], 
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

    ///POR IMPLEMENTAR
    function actualizarEncabezadoDocumento(Producto $nuevoProducto){

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
    function cambiarEstadoEncabezadoDocumento(Producto $nuevoProducto){

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


    

?>