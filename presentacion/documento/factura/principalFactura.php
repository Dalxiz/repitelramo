<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css de bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css de datdatble-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> 
    <!-- css de icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../dist/css/number.css">
    <!-- script de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>     
    <!-- script de datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
    <!-- Js boostrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../dist/js/main.js"></script>
    <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/mantenedorGenerico.css">
    <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/principalFactura.css">


    <title>Administración de Facturas</title>

</head>
<body>
    <?php require_once '../../menu.php' ?>
   
    <div class="container-fluid contenedorH3"> 
        <h3>Administración de Facturas</h3>
    </div>

    <!-- datatable -->
    <div class="container-fluid contenedorTabla table-responsive">

        <!-- alert -->

        <?php if(isset($_GET['msj']) && strpos($_GET['msj'],"ok") === 0) {  ?>
            
            <div class='alert alert-success alert-dismissible'>
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>¡Operación Realizada!</strong> <?php echo $_GET['msj'] ?> 
            </div>
        
        <?php } elseif(isset($_GET['msj']) && strpos($_GET['msj'],"err") !== false) { ?>

                <div class='alert alert-danger alert-dismissible'>
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>¡Operación Incorrecta!</strong> Sucedió algo inesperado:  <?php echo $_GET['msj'] ?> 
                </div>
        
        <?php    } ?>

        <div class='alert alert-info alert-dismissible'>
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><i class="text-primary bi bi-info-circle-fill"></i> Atención:</strong> Solo es posible modificar las facturas registradas, una vez emitidas o anuladas no pueden editarse. 
        </div>

        <!-- contenedor botones de registro nuevo y libro factura q -->
        <div class="container-fluid contenedorBoton">
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalFact" data-prod-accion='nueva'><i class="bi bi-plus-circle-fill"></i> Nueva Factura</button>
            
            <!-- Botón libro de venta restringido solo para admin -->
            <?php if($_SESSION['usuario']->getTipoUsuario()->getNombreTipoUsu() == "Administrador"){?>

                <button type="button" class="btn btn-outline-dark factura-libro" data-toggle="modal" data-prod-accion='libro'><i class="bi bi-journal-bookmark-fill"></i> Libro de Venta</button>
            
            <?php } ?>

        </div>
        

        <table id="example" class="table is-striped table-hover" style="width:100%">
            <thead>
                <tr>
                <th>Folio Documento</th>
                <th>Tipo de Documento</th>
                <th>Fecha de Registro</th>
                <th>Fecha de Emisión</th>
                <th>Cliente</th>
                <th>Estado Documento</th>
                <th>Total Neto</th>
                <th>IVA</th>
                <th>Total Bruto</th>
                <th class='text-center'>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php 

                    require '../../../controlador/controladorEncabezadoDocumento.php';

                    $listaEncabezados = getTodosEncabezadoDocumento();
                    $listaFolios; //Para guardar folios y luego corroborar si el folio ingresado ya existe con javascript

                    if (count($listaEncabezados) > 0) {
                        foreach ($listaEncabezados as $encabezado) {
                            $listaFolios[] = array($encabezado->getTipoDoc()->getIdTipoDoc() . $encabezado->getFolioDoc());
                            if($encabezado->getTipoDoc()->getNombreTipoDoc() == "Factura Electrónica"){
                ?>
                <tr>
                    <td>
                        <div class="row">
                            <span class=" col-8">
                                <?php echo $encabezado->getFolioDoc();?>
                            </span>
                            <button type="button" title="Información factura" class="btn btn-outline-success factura-info" data-folio='<?php echo $encabezado->getFolioDoc();?>' data-tipo-doc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc(); ?>'><i class="bi bi-eye-fill"></i></button>
                        <div>
                    </td>

                    <td><?php echo $encabezado->getTipoDoc()->getNombreTipoDoc(); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($encabezado->getFechaRegistro())); //Formatear fecha ?></td>
                    
                    <!-- fecha emisión -->
                    <?php if($encabezado->getFechaEmision() != ""){ ?>
                    <td><?php echo date("d-m-Y", strtotime($encabezado->getFechaEmision())); //Formatear fecha ?></td>
                    <?php }else{ ?>
                    <td>N/A</td>
                    <?php } ?>

                    <td><?php echo $encabezado->getCliente()->getNombRazonSocial() ?></td>

                    <?php if($encabezado->getEstadoDoc() === "Registrado"){ ?>
                    <td><span class="badge badge-pill badge-info align-middle p-2 ml-2"><?php echo $encabezado->getEstadoDoc() ?></span></td>           
                    <?php }else if($encabezado->getEstadoDoc() === "Emitido"){ ?>
                    <td ><span class="badge badge-pill badge-success align-middle p-2 ml-2"><?php echo $encabezado->getEstadoDoc() ?></span></td>
                    <?php }else if($encabezado->getEstadoDoc() === "Anulado"){ ?>
                    <td ><span class="badge badge-pill badge-danger align-middle p-2 ml-2"><?php echo $encabezado->getEstadoDoc() ?></span></td>
                    <?php }else { ?>
                    <td ><span class="badge badge-pill badge-dark align-middle p-2 ml-2"><?php echo $encabezado->getEstadoDoc() ?></span></td>
                    <?php } ?>                   

                    <td><?php echo number_format ($encabezado->getNeto(), 0, ",", ".")//number_format para poner separador de miles ?></td>
                    <td><?php echo str_replace(",00", "", number_format ($encabezado->getIva(), 2, ",", "." ) ) //str_replace para no mostrar ,00 innceesarios?></td> 
                    <td><?php echo number_format ( $encabezado->getTotal(), 0, ",", "." ) ?></td>          


                    <td class="text-center">
                        <div style="min-width : 136px">
                            <?php if($encabezado->getEstadoDoc() === "Registrado"){ ?>
                                <span class="btn btn-info factura-emitir"  data-toggle="modal"  data-target="#modalFactEstado" title="Emitir"
                                data-fact-tipodoc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc()?>' 
                                data-fact-folio='<?php echo $encabezado->getFolioDoc();?>' data-fact-accion="emitir">
                                <i class="bi bi bi-check-circle-fill"></i></span>

                                <span class="btn btn-danger factura-anular"  data-toggle="modal" data-target="#modalFactEstado" title="Anular"
                                data-fact-tipodoc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc()?>' 
                                data-fact-folio='<?php echo $encabezado->getFolioDoc();?>' data-fact-accion="anular">
                                <i class="bi bi-x-circle-fill"></i></span>
                                
                                <button type="button" class="btn btn-warning factura-actualizar" data-toggle="modal" title="Modificar" data-folio='<?php echo $encabezado->getFolioDoc();?>' data-tipo-doc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc(); ?>'><i class="bi bi-pencil-fill"></i></button>
                            <?php } ?> 
                        </div>
                    </td>
                </tr>

            
                <?php   }}
                    }else{ ?>
                    <tr><td colspan=8 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen facturas registradas</td></tr> 
                <?php   } ?>    
            </tbody>         
        </table>

    </div>

      <!-- ventana modal registrar factura-->
    <div class="modal fade bd-example-modal-lg" id="modalFact" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i id="iconoModal" class="bi bi-bookmark-plus-fill"> </i><span id="txtTituloModal">Nueva Factura</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../../controlador/controladorEncabezadoDocumento.php" id="formFactNueva" method="POST">
                                                
                    <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-md-6 col-12 mb-3 mb-md-0">
                                    <label for="cbxEmpresa" class="labelForm">Empresa</label>
                                    <select class="form-control" name="empresa" id="cbxEmpresa" required="required">
                                    <option selected value="" disabled="1">Empresa</option>
                                        <?php
                                            include_once "../../../controlador/controladorEmpresa.php";

                                            $listaEmpresas = getTodasLasEmpresas();

                                            foreach($listaEmpresas as $empresas){
                                                echo "<option value='" . $empresas->getRutEmp() . "'>" . $empresas->getRazonEmp(). "</option>"; 
                                            }
                                        ?>
                                    </select>
                                </div>  
                       
    
                                <div class="col col-md-6 col-12">
                                            <label for="cbxTipoDoc" class="labelForm">Tipo de documento</label>
                                            <select disabled class="form-control" name="tipoDoc" id="cbxTipoDoc" required="required">
                                                <option selected value="" disabled="1">Tipo de documento</option>
                                                <?php
                                                    include_once "../../../controlador/controladorTipoDocumento.php";

                                                    $listaTipoDoc = getTodosTipoDocumento();

                                                    foreach($listaTipoDoc as $tipoDoc){
                                                    
                                                        if($tipoDoc->getIdTipoDoc() == '1'){
                                                            echo "<option selected value='" . $tipoDoc->getIdTipoDoc() . "'>" . $tipoDoc->getNombreTipoDoc(). "</option>"; 
                                                        }
                                                        else{
                                                            echo "<option value='" . $tipoDoc->getIdTipoDoc() . "'>" . $tipoDoc->getNombreTipoDoc(). "</option>"; 
                                                        }
                                                    }
                                                ?>
                                            </select>
                                           <!-- <input type="hidden" name="tipoDoc" value="1" > -->
                                    </div>  
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-md-6 col-12 mb-3 mb-md-0">
                                    <label for="cbxCliente" class="labelForm">Cliente</label>
                                    <select class="form-control" name="cliente" id="cbxCliente" required="required">
                                        <option selected value="" disabled="1">Cliente</option>
                                        <?php
                                            include_once "../../../controlador/controladorCliente.php";

                                            $listaClientes = getTodosLosClientes();

                                            foreach($listaClientes as $clientes){
                                                echo "<option value='" . $clientes->getRutCliente() . "'>" . $clientes->getRutCompleto() . " | " . $clientes->getNombRazonSocial(). "</option>"; 
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col col-md-6 col-12">
                                    <label for="txtFolio" class="labelForm">Folio del documento</label>
                                    <input required="required" class="form-control" type="number" name="folio" id="txtFolio" placeholder="Folio del documento">
                                </div>

                            </div>  
                        </div>

                        <div class="container-fluid">
                        
                            <div class="form-group row">
                            <div class="col col-md-6 col-12 mb-3 mb-md-0">
                                <label for="txtFechaRegistro" class="labelForm" >Fecha de registro</label>
                                <input required="required" class="form-control" type="date" name="fechaRegistro" id="txtFechaRegistro" placeholder="Fecha de registro" maxlength="10">
                                </div>
                                <div class="col col-md-6 col-12">
                                <label for="txtCondPago" class="labelForm">Condicion de pago</label>
                                <input required="required" class="form-control" type="text" name="condPago" id="txtCondPago" placeholder="Condición de pago">
                                 </div>
                            </div>

                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <label for="cbxEstadoDoc" class="labelForm">Estado del documento</label>
                                    <select disabled class="form-control" name="estadoDoc" id="cbxEstadoDoc" required="required">
                                        <option value="" disabled="1">Estado del documento</option>
                                        <option selected class ="text-info" value="Registrado">Registrado</option>
                                        <option class="text-success" value="Emitido">Emitido</option>
                                        <option class="text-danger" value="Anulado">Anulado</option>
                                    </select>
                            </div>  
                       
                        </div>

                        <div class="container-fluid">
                            <label><strong>Agregar productos</strong></label>
                        </div>

                        <div class="container-fluid">
                            <div class="container-fluid bg-light pb-1">
                                <div class="form-group row ">
                                    <div class="col col-md-7 col-12 mb-3 mb-md-0">
                                        <label for="cbxProducto" class="labelForm">Selecciona producto</label>
                                        <select onchange="cargaPrecioUnitYUM('registrar')"  class="form-control" name="producto" id="cbxProducto">
                                            <option selected value="" disabled="1">Selecciona Producto</option>
                                            <?php
                                                include_once "../../../controlador/controladorProducto.php";

                                                $listaProductos = getTodosLosProductos();

                                                foreach($listaProductos as $productos){
                                                    echo "<option value='" . $productos->getCodProd() . "' data-prod-precio=" . floatval($productos->getPrecioUnitaro()) . " data-prod-um='" . $productos->getUnidadMedida()->getNombreUM() ."'>" . $productos->getDescripcion(). "</option>"; 
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col col-md-5 col-12">
                                        <label for="txtPrecioUnitario" class="labelForm">Unidad Medida</label>
                                        <input readonly=true class="form-control" type="text" name="unidadMeida" id="txtUnidadMedida" placeholder="-">
                                    </div>
                                </div>


                                <div class="form-group row">
                                
                                    <div class="col col-md-4 col-12 mb-3 mb-md-0">
                                        <label for="txtPrecioUnitario" class="labelForm">Precio Unitario</label>
                                        <input readonly=true class="form-control" type="text" name="precioUnitario" id="txtPrecioUnitario" placeholder="-">
                                    </div>

                                    <div class="col col-md-2 col-12 mb-3 mb-md-0">
                                        <label for="txtPrecioUnitario" class="labelForm">% Descuento</label>
                                        <input class="form-control" onkeydown="return validarNumeroEntero(event)" type="text" name="porcDesc" value=0 id="txtPorcDesc" placeholder="" maxlength="3">
                                    </div>

                                    <div class="col col-md-5 col-6 mb-3 mb-md-0">
                                        <label for="txtCantidad" class="labelForm">Cantidad</label>
                                        <input class="form-control" onkeydown="return validarNumeroEntero(event)" type="text" name="cantidad" id="txtCantidad" placeholder="Cantidad" maxlength="10">
                                    </div>
    
                                    <div class="col-md-offset-1">
                                        <label for="btnAgregar" class="labelForm"> &nbsp;  </label>
                                        <div class="text-center">
                                            <button onclick="agregarProd('registrar')" type="button" class="btn btn-success" id="btnAgregar" name="btnAgregar"><i class="bi bi-plus-circle-fill"></i></button>                 
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="container-fluid mt-3 mb-3">
                            <!-- tabla -->
                            <div class="container-fluid table-responsive bg-light">  
                                <table id="tablaProd" class="table is-striped table-hover " style="width:100%;">
                                    <thead>
                                        <tr>
                                        <th class="text-center">Cód</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">UM</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Precio Unit</th>
                                        <th class="text-center">Descuento</th>
                                        <th class="text-center">Valor</th>
                                        <th class='text-center'>Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                    
                            </div>    

                        </div>

                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                                    <label class="labelForm" for="txtNeto">Neto</label>
                                    <input readonly="true" required="required" class="form-control" type="text" name="neto" id="txtNeto" placeholder="-">
                                </div>
                                <div class="col col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                                    <label class="labelForm" for="txtIVA">IVA</label>
                                    <input readonly="true" required="required" class="form-control" type="text" name="iva" id="txtIVA" placeholder="-">
                                </div>
                                <div class="col col-md-4 col-sm-12 col-12 mb-3 mb-md-0">
                                    <label class="labelForm" for="txtTotal">Total</label>
                                    <input readonly="true" required="required" class="form-control" type="text" name="total" id="txtTotal" placeholder="-">
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-lg-12">
                                    <label class="labelForm" for="txtObservaciones">Observaciones</label>
                                    <textarea class="form-control" id="txtObservaciones" name="observaciones" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-lg-12">
                                    <label class="labelForm" for="txtCancelado">Cancelado por</label>
                                    <input class="form-control" type="text" name="cancelado" id="txtCancelado" placeholder="Cancelado por">
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid mt-4">
                            <div class="form-group">
                                <button class="btn btn-dark col-lg-12" id="btnAccion" name="registrar" onclick="return validarCampos('registrar')" type="submit">Registrar</button>
                            </div>
                        </div>                        
                    </form>
                </div>                
            </div>
        </div>
    </div>

     <!-- ventana modal info -->
     <div class="modal fade bd-example-modal-lg" id="modalFactInfo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i id="iconoModal" class="bi bi-bookmark-plus-fill"> </i><span id="txtTituloModal">Información de la Factura</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>                
            </div>
        </div>
    </div>

    <!-- ventana modal actualizar -->
    <div class="modal fade bd-example-modal-lg" id="modalFactAct" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i id="iconoModal" class="bi bi-pencil-square"> </i><span id="txtTituloModal">Modificar Factura</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>                
            </div>
        </div>
    </div>

    <!-- ventana modal cambiar estado -->
    <div class="modal fade " id="modalFactEstado" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i id="iconoModalEstado" class="bi bi-bookmark-check-fill"> </i><span id="txtTituloModalEstado">Emitir Factura</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../../controlador/controladorEncabezadoDocumento.php" method="POST">
                    
                    <div id="divFechaEmision" class="form-group col-lg-12">
                    <label for="txtNuevaFechaEmision" class="labelForm" >Ingrese la Fecha de Emisión</label>
                        <input required="required" class="form-control" type="date" name="fechaEmision" id="txtNuevaFechaEmision" placeholder="Fecha de registro" maxlength="10">
                    
                    </div>


                    <div class="form-group m-4 ">
                        <div class="text-center">
                        <label class="lead">¿Seguro que desea <strong id="spanAccionEstado"></strong> la Factura Eletrónica folio '<span id="spanFolioEstado"></span>'?</label>
                        </div>
                    </div>
                    <input type="hidden" name="emitirFolio" id="emitirFolio">
                    <input type="hidden" name="emitirTipoDoc" id="emitirTipoDoc">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <button class="btn btn-success col-lg-12" id="btnAccionEstado" name="cambiarestado" value="emitir" type="submit">Emitir</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-danger col-lg-12" id="btnCancelarEstado" data-dismiss="modal" type="button">Cancelar</button>
                        </div>
                    </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <!-- ventana modal libro de ventas -->
    <div class="modal fade bd-example-modal-lg" id="modalLibro" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i class="bi bi-journal-bookmark-fill"> </i><span>Libro de ventas del mes</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>                
            </div>
        </div>
    </div>

    <script src="/repitelramo/presentacion/dist/js/principalFactura.js" type="text/javascript"></script>
                                    
    <!-- Javascript directo debido a uso de php en JS  -->
    <script type="text/javascript">
      
      //Validar campos, ver si ya existe el folio antes de enviar datos al servidro
      function validarCampos(e){
            var tipoModal = determinarTipoDeModal(e);
            //Coroborar si existe ya el folio, solo si es registro nuevo:
            if(e === "registrar"){
                var arrayDeFolios = <?php echo json_encode($listaFolios); ?>; //El array de folios la pasamos desde PHP por json a javascript
                var folioIngresado =  $("#cbxTipoDoc :selected").val() + "" + $('#txtFolio').val(); //folio ingresado la unimo con tipoDoc (por ser PK en la tabla encabezado_doc)
            
                //Revisamos si el folio existe
                for(var i = 0; i < arrayDeFolios.length ; i++){
                    if(folioIngresado === String(arrayDeFolios[i])){
                        alert("¡El folio ingresado ya existe para el tipo de documento seleccionado!");
                        return false;
                    }
                }
            }

            //Corroborar si existen productos agregados:
            var cantCeldas = (($(tipoModal + ' td').length));
            if (cantCeldas == 0){
                alert("¡Agrege productos!");
                return false;
            }

            //$(tipoModal + ' #cbxTipoDoc').prop('disabled', false);
            //$(tipoModal + ' #cbxEstadoDoc').prop('disabled', false);

        }


    </script>
        
    
</body>

 <?php require_once '../../footer.php' ?> 
</html>