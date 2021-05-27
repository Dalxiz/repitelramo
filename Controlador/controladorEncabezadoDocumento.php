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

      echo $mensaje;

      /*
      
      $unidadMedida = new UnidadMedida($idUM, ""); // Por ahora solo id.

      $nuevoProducto = new Producto($codProd, $descripcion, $unidadMedida, $precioUnitario);

      $mensaje = registrarProducto($nuevoProducto);*/
      
      //header("Location: ../presentacion/producto/principalProducto.php?msj=". $mensaje);

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