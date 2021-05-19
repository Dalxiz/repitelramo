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
                return 'ok';
            }
            else
            {
                return 'err';
            }

        }catch(PDOException $pe){

            if(strpos($pe->getMessage(),"violation: 1062")){
                return "err : El Código del Producto: '" . $nuevoProducto->getCodProd() ."' ya se encuentra registrada. El código debe ser único.";
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
                $unidadMedida, $tablaProdBBDD['precioUnitario'], );

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
    

?>