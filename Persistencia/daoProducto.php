<?php

    function registrarProducto(Producto $nuevoProducto){

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

    function consultarProductos(){

        require 'parametrosBD.php';
        require_once 'daoUM.php';
        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaProductos=[];

            $querySelect = $conexion->query("SELECT * FROM PRODUCTO");

            foreach($querySelect->fetchAll() as $tablaProdBBDD)
            {

                $unidadMedida = consultarUMPorId($tablaProdBBDD['idUM']);

                $productoSel= new Producto($tablaProdBBDD['codProd'], $tablaProdBBDD['descripcion'],
                $unidadMedida, $tablaProdBBDD['precioUnitario']);

                $listaProductos[]=$productoSel; //1,2,3,4,5,6,7,
            }

            if(count($listaProductos) > 0){
                return $listaProductos;
            }else{
                return ($lista=[]);
            }
        }
        catch(PDOException $pe)
        {
            return $pe->getMessage();

        }
    }

    function actualizarProducto(Producto $nuevoProducto){

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

    function eliminarProducto(Producto $nuevoProducto){

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

    function consultarProductoPorCodigo($codProd){

        require 'parametrosBD.php';
        require_once 'daoUM.php';
        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaProductos=[];

            $querySelect = $conexion->query("SELECT * FROM PRODUCTO WHERE codProd = '" . $codProd . "'" );

            foreach($querySelect->fetchAll() as $tablaProdBBDD)
            {

                $unidadMedida = consultarUMPorId($tablaProdBBDD['idUM']);

                $productoSel= new Producto($tablaProdBBDD['codProd'], $tablaProdBBDD['descripcion'],
                $unidadMedida, $tablaProdBBDD['precioUnitario']);

                $listaProductos[]=$productoSel; //1,2,3,4,5,6,7,
            }

            if(count($listaProductos) > 0){
                return $listaProductos[0];
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