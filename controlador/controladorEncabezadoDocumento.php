<?php
   if(isset($_POST['registrar']))
   { 
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/detalleDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/producto.php';


      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

      session_start();
      $idUsu = $_SESSION['usuario']->getIdUsu();
      $idEmp = $_POST['empresa'];
      $idTipoDoc = $_POST['tipoDoc'];
      $folioDoc = $_POST['folio'];
      $fechaRegistro = $_POST['fechaRegistro'];
      $rutCliente = $_POST['cliente'];
      $condPago = $_POST['condPago'];
      $estadoDoc = $_POST['estadoDoc'];
      $observaciones = $_POST['observaciones'];
      $canceladoPor = $_POST['cancelado'];
      
      //reemplazar los puntos por coma:
      $neto = str_replace(".", "", $_POST['neto']); 
      $iva = str_replace(".", "", $_POST['iva']);
      $total = str_replace(".", "", $_POST['total']);

      //reemplazar las comas por punto:
      $neto = str_replace(",", ".", $neto); 
      $iva = str_replace(",", ".", $iva );
      $total = str_replace(",", ".", $total);

      //Datos de los detalles del doc:
      $idProductos = $_POST['idProd']; 
      $precioUn = $_POST['precioUn'];
      $cantidadesUn = $_POST['cantUn']; 
      $descuentos = $_POST['desc'];
      $valores = $_POST['valor'];

      //Creacion de las clases corresondientes
      $tipoUsuario = new TipoUsuario("", ""); //Vacío en este caso solo se necesita para instanciar un Usuario   
      $usuario = new Usuario($idUsu, $tipoUsuario, "", "", "");
      $empresa = new Empresa ($idEmp, "", "", "");
      $tipoDocumento = new TipoDocumento($idTipoDoc,"");
      $cliente = new Cliente($rutCliente, "", "", "", "", "", "", "", "");

      $nuevoEncabezado = new EncabezadoDocumento($usuario, $empresa, $tipoDocumento, $folioDoc, $fechaRegistro, "", $cliente, 
                                                 $condPago, $estadoDoc, $neto, $iva, $total, $observaciones, $canceladoPor);

      for($i = 0 ; $i < count($idProductos) ; $i++){
         $um = new UnidadMedida("","");
         $producto = new Producto($idProductos[$i], "", $um, "");
         $detalle = new DetalleDocumento("", $nuevoEncabezado,$producto, $precioUn[$i],$cantidadesUn[$i], $descuentos[$i], $valores[$i]);
         $nuevoEncabezado->addNuevoDetalle($detalle);
      }

      $mensaje = registrarDocumentoCompleto($nuevoEncabezado);

      header("Location: /repitelramo/presentacion/documento/factura/principalFactura.php?msj=". $mensaje);

      die();
   }

   else if(isset($_POST['actualizar']))
   { 
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/detalleDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/producto.php';

      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";
      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoProducto.php";

      session_start();
      $idUsu = $_SESSION['usuario']->getIdUsu();
      $idEmp = $_POST['empresa'];
      $idTipoDoc = $_POST['tipoDoc'];
      $folioDoc = $_POST['folio'];
      $fechaRegistro = $_POST['fechaRegistro'];
      $rutCliente = $_POST['cliente'];
      $condPago = $_POST['condPago'];
      $estadoDoc = $_POST['estadoDoc'];
      $observaciones = $_POST['observaciones'];
      $canceladoPor = $_POST['cancelado'];
      
      //reemplazar los puntos por coma:
      $neto = str_replace(".", "", $_POST['neto']); 
      $iva = str_replace(".", "", $_POST['iva']);
      $total = str_replace(".", "", $_POST['total']);

      //reemplazar las comas por punto:
      $neto = str_replace(",", ".", $neto); 
      $iva = str_replace(",", ".", $iva );
      $total = str_replace(",", ".", $total);

      //Datos de los detalles del doc:
      $idProductos = $_POST['idProd']; 
      $precioUn = $_POST['precioUn'];
      $cantidadesUn = $_POST['cantUn']; 
      $descuentos = $_POST['desc'];
      $valores = $_POST['valor'];

      //Creacion de las clases corresondientes
      $tipoUsuario = new TipoUsuario("", ""); //Vacío en este caso solo se necesita para instanciar un Usuario   
      $usuario = new Usuario($idUsu, $tipoUsuario, "", "", "");
      $empresa = new Empresa ($idEmp, "", "", "");
      $tipoDocumento = new TipoDocumento($idTipoDoc,"");
      $cliente = new Cliente($rutCliente, "", "", "", "", "", "", "", "");

      $nuevoEncabezado = new EncabezadoDocumento($usuario, $empresa, $tipoDocumento, $folioDoc, $fechaRegistro, "", $cliente, 
                                                 $condPago, $estadoDoc, $neto, $iva, $total, $observaciones, $canceladoPor);

      for($i = 0 ; $i < count($idProductos) ; $i++){
         $um = new UnidadMedida("","");
         $producto = consultarProductoPorCodigo($idProductos[$i]);
         $detalle = new DetalleDocumento("", "" ,$producto, $precioUn[$i],$cantidadesUn[$i], $descuentos[$i], $valores[$i]);
         $nuevoEncabezado->addNuevoDetalle($detalle);
      }

      $mensaje = actualizarDocumentoCompleto($nuevoEncabezado);

      header("Location: /repitelramo/presentacion/documento/factura/principalFactura.php?msj=". $mensaje);
      die();
   }

   //Para cargar modal de inforación y actualización con datos
   else if(isset($_POST['cargarModal']))
   { 

      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/detalleDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/producto.php';

      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

      $cargarModal = $_POST['cargarModal'];

      if($cargarModal == "libro"){
         return require $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/presentacion/documento/factura/modalLibroVentas.php';
      }

      else{
      
         session_start();
         $folio = $_POST['folio'];
         $idTipoDoc = $_POST['idTipoDoc'];

         //Cambiamos elemento session
         $_SESSION['encabezado'] = consultarEncabezadoDocumentoPorFolio($idTipoDoc,$folio);

         //Devoler el modal actualizado:
         if($cargarModal == "informacion"){
            return require $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/presentacion/documento/factura/modalInformacionFactura.php';
         }

         else if($cargarModal == "actualizar"){
            return require $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/presentacion/documento/factura/modalActualizarFactura.php';
         }
      }

   }

   else if(isset($_POST['cambiarestado']))
   { 
      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";
      
      session_start();
      $folio = $_POST['emitirFolio'];
      $idTipoDoc = $_POST['emitirTipoDoc'];
      $estado = $_POST['cambiarestado'];
      $fechaEmision = $_POST['fechaEmision'];
      $mensaje = "";

      if($estado == "emitir"){
         $mensaje = cambiarEstadoDoc ($idTipoDoc, $folio, $fechaEmision, "Emitido");
      }

      if($estado == "anular"){
         $mensaje = cambiarEstadoDoc ($idTipoDoc, $folio, $fechaEmision, "Anulado");
      }

      header("Location: /repitelramo/presentacion/documento/factura/principalFactura.php?msj=". $mensaje);

   }//Libro de venta
   else if (isset($_POST['consulta'])) {
      
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

      session_start();
      
      $fecha = $_POST['fecha'];
      
      $anio = substr($fecha,0,4);
      
      $mes = substr($fecha,5,2);

      $lista = consultaLibroVenta($mes,$anio);

      $_SESSION['libro'] = $lista;

      return require $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/presentacion/documento/factura/resultadoLibro.php';
      
      die();
      
   }


     function getTodosEncabezadoDocumento(){

        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';

        require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

        $lista = consultarEncabezadoDocumento();
        
        return $lista;
     }

   
?>