<?php
    if(isset($_POST['registrar']))
    { 
            require_once '../entidades/producto.php';
            require_once '../entidades/unidadMedida.php';
            require_once '../persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = registrarProducto($nuevoProducto);
            
            header("Location: ../presentacion/producto/principalProducto.php?msj=". $mensaje);

            die();
    }

    else if(isset($_POST['actualizar']))
    { 
            require_once '../entidades/producto.php';
            require_once '../entidades/unidadMedida.php';
            require_once '../persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = actualizarProducto($nuevoProducto);
            
            
            header("Location: ../presentacion/producto/principalProducto.php?msj=".  $mensaje . " - Producto: " . $nuevoProducto->getCodProd() . " - " . $nuevoProducto->getDescripcion() . " Actualizado Correctamente!");

            die();
    }

    else if(isset($_POST['eliminar']))
    { 
            require_once '../entidades/producto.php';
            require_once '../entidades/unidadMedida.php';
            require_once '../persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = eliminarProducto($nuevoProducto);
            
            header("Location: ../presentacion/producto/principalProducto.php?msj=".  $mensaje );

            die();
    }


    function getTodosLosProductos(){
            require_once '../../persistencia/daoProducto.php';
            //require_once '../../persistencia/daoUM.php';
            require_once '../../entidades/producto.php';
            //require_once '../../entidades/unidadMedida.php';
    
            $lista = consultarProductos();
            
            return $lista;
    }

?>