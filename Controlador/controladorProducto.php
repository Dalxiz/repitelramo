<?php
    if(isset($_POST['registrar']))
    { 
            require_once '../Entidades/producto.php';
            require_once '../Entidades/unidadMedida.php';
            require_once '../Persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = registrarProducto($nuevoProducto);
            
            //header("Location: ../presentacion/alumno/registrar.php?msj=" . registrarAlumno($nuevoAlumno) . " [Alumno: " . $nuevoAlumno->getNombreCompleto() . "]");
            
            //echo $mensaje;
            
            header("Location: ../Presentacion/producto/principalProducto.php?msj=". $mensaje . " - Producto: " . $nuevoProducto->getCodProd() . " - " . $nuevoProducto->getDescripcion()  . " Registrado Correctamente!");

            die();
    }

    else if(isset($_POST['actualizar']))
    { 
            require_once '../Entidades/producto.php';
            require_once '../Entidades/unidadMedida.php';
            require_once '../Persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = actualizarProducto($nuevoProducto);
            
            //header("Location: ../presentacion/alumno/registrar.php?msj=" . registrarAlumno($nuevoAlumno) . " [Alumno: " . $nuevoAlumno->getNombreCompleto() . "]");
            
            //echo $mensaje;
            
            header("Location: ../Presentacion/producto/principalProducto.php?msj=".  $mensaje . " - Producto: " . $nuevoProducto->getCodProd() . " - " . $nuevoProducto->getDescripcion() . " Actualizado Correctamente!");

            die();
    }

    else if(isset($_POST['eliminar']))
    { 
            require_once '../Entidades/producto.php';
            require_once '../Entidades/unidadMedida.php';
            require_once '../Persistencia/daoProducto.php';

            $codProd = $_POST['codProd'];
            $descripcion = $_POST['descripcion'];
            $idUM = $_POST['unidadMedida'];
            $precioUnitario = $_POST['precioUnitario'];

            $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

            $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

            $mensaje = eliminarProducto($nuevoProducto);
            
            //header("Location: ../presentacion/alumno/registrar.php?msj=" . registrarAlumno($nuevoAlumno) . " [Alumno: " . $nuevoAlumno->getNombreCompleto() . "]");
            
            //echo $mensaje;
            
            header("Location: ../Presentacion/producto/principalProducto.php?msj=".  $mensaje . " - Producto: " . $nuevoProducto->getCodProd() . " - " . $nuevoProducto->getDescripcion() . " Eliminado Correctamente!");

            die();
    }





    function getTodosLosProductos(){
            require_once '../../Persistencia/daoProducto.php';
            //require_once '../../Persistencia/daoUM.php';
            require_once '../../Entidades/Producto.php';
            //require_once '../../Entidades/unidadMedida.php';
    
            $lista = consultarProductos();
            
            return $lista;
    }

?>