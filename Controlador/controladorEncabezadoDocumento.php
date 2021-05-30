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
      $fechaEmision = $_POST['fechaEmision'];
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

      $nuevoEncabezado = new EncabezadoDocumento($usuario, $empresa, $tipoDocumento, $folioDoc, $fechaEmision, $cliente, 
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

   if(isset($_POST['actualizar']))
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
      $fechaEmision = $_POST['fechaEmision'];
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

      $nuevoEncabezado = new EncabezadoDocumento($usuario, $empresa, $tipoDocumento, $folioDoc, $fechaEmision, $cliente, 
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

   //Para cargar modal con datos
   if(isset($_POST['cargarModal']))
   { 
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/detalleDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/producto.php';

      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";
      
      session_start();
      $folio = $_POST['folio'];
      $idTipoDoc = $_POST['idTipoDoc'];
      $cargarModal = $_POST['cargarModal'];

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


     function getTodosEncabezadoDocumento(){

        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';

        require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

        $lista = consultarEncabezadoDocumento();
        
        return $lista;
     }

   if (isset($_POST['consulta'])) {
      
      session_start();
      
      $fecha = $_POST['fecha'];
      
      $anio = substr($fecha,0,4);
      
      $mes = substr($fecha,5,2);
      

      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/usuario.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/empresa.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/tipoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/entidades/encabezadoDocumento.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEncabezadoDocumento.php";

      $lista = consultaLibroVenta($mes,$anio);

      $_SESSION['libro'] = $lista;

      // header("Location: /repitelramo/presentacion/documento/factura/libroVentas.php");

      return require $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/presentacion/documento/factura/resultadoLibro.php';
      
      die();
      
   }
?>