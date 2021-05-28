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


    <title>Administración de Facturas</title>

    <style>
        .contenedor{
            width: 40%;
            height: 50%;
            padding-top: 2rem;
            padding-bottom: 2rem;
            border: 1px solid silver;
            border-radius: 5px;
        }
        h3{
            color: white;
        }
        .contenedorH3{
            background-color: #343A40;
            height: 3rem;
            padding-top: 5px;
        }
        .contenedorBoton{
            padding-top: 7px;
            margin-bottom: 40px;
            margin-left: -1rem;
        }
        .contenedorTabla{
            padding-top: 15px;
            width: 100%;
            padding-left: 4rem;
            padding-right: 4rem;
        }
        .labelForm{
            font-size: 0.8rem;
            margin-bottom: .3rem;
        }


        /*Modificación tamaño a diferentes pantallas del modal*/
        @media (max-width: 992px) AND (min-width: 576px){
        .modal-dialog {
            max-width: 85%;
            margin: 1.75rem auto;
        }
        }
        </style>

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

        <!-- contenedor de registro nuevo y libro factura q -->
        <div class="container-fluid contenedorBoton">
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalFact" data-prod-accion='nueva'><i class="bi bi-plus-circle-fill"></i> Nueva Factura</button>
            
            <!-- Botón libro de venta restringido solo para admin -->
            <?php if($_SESSION['usuario']->getTipoUsuario()->getNombreTipoUsu() == "Administrador"){?>

                <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalFact" data-prod-accion='libro'><i class="bi bi-plus-circle-fill"></i> Libro de Venta</button>
            
            <?php } ?>

        </div>
        

        <table id="example" class="table is-striped table-hover" style="width:100%">
            <thead>
                <tr>
                <th>Folio Documento</th>
                <th>Tipo de Documento</th>
                <th>Fecha de Emisión</th>
                <th>Cliente</th>
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

                ?>
                <tr>
                    <td><?php echo $encabezado->getFolioDoc();?></td>
                    <td><?php echo $encabezado->getTipoDoc()->getNombreTipoDoc(); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($encabezado->getFechaEmision())); //Formatear fecha ?></td>
                    <td><?php echo $encabezado->getCliente()->getNombRazonSocial() ?></td>
                    <td><?php echo number_format ($encabezado->getNeto(), 0, ",", ".")//number_format para poner separador de miles ?></td>
                    <td><?php echo str_replace(",00", "", number_format ($encabezado->getIva(), 2, ",", "." ) ) //str_replace para no mostrar ,00 innceesarios?></td> 
                    <td><?php echo number_format ( $encabezado->getTotal(), 0, ",", "." ) ?></td>          


                    <td class="text-center">
                        <div style="min-width : 136px">
                            <button type="button" class="btn btn-success facturainfo" data-folio='<?php echo $encabezado->getFolioDoc();?>' data-tipo-doc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc(); ?>'><i class="bi bi-eye-fill"></i></button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalFact"><i class="bi bi-pencil-fill"></i></button>
                            <span class="btn btn-danger"  data-toggle="modal" data-target="#modalFact" ><i class="bi bi-trash2-fill"></i></span>
                        </div>
                    </td>
                </tr>

            
                <?php   }
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
                    <form action="../../../controlador/controladorEncabezadoDocumento.php" id="formProd" method="POST">
                                                
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
                                            <select class="form-control" name="tipoDoc" id="cbxTipoDoc" required="required">
                                                <option selected value="" disabled="1">Tipo de documento</option>
                                                <?php
                                                    include_once "../../../controlador/controladorTipoDocumento.php";

                                                    $listaTipoDoc = getTodosTipoDocumento();

                                                    foreach($listaTipoDoc as $tipoDoc){
                                                        echo "<option value='" . $tipoDoc->getIdTipoDoc() . "'>" . $tipoDoc->getNombreTipoDoc(). "</option>"; 
                                                    }
                                                ?>
                                            </select>
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
                            <div class="col col-lg-6">
                                <label for="txtFechaEmision" class="labelForm" >Fecha de emisión</label>
                                <input required="required" class="form-control" type="date" name="fechaEmision" id="txtFechaEmision" placeholder="Fecha de emisión" maxlength="10">
                                </div>
                                <div class="col col-lg-6">
                                <label for="txtCondPago" class="labelForm">Condicion de pago</label>
                                <input required="required" class="form-control" type="text" name="condPago" id="txtCondPago" placeholder="Condición de pago">
                                 </div>
                            </div>

                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <label for="cbxEstadoDoc" class="labelForm">Estado del documento</label>
                                    <select class="form-control" name="estadoDoc" id="cbxEstadoDoc" required="required">
                                        <option selected value="" disabled="1">Estado del documento</option>
                                        <option class ="text-info" value="Creado">Creado</option>
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
                                    <div class="col-7">
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

                                    <div class="col-5">
                                        <label for="txtPrecioUnitario" class="labelForm">Unidad Medida</label>
                                        <input readonly=true class="form-control" type="text" name="unidadMeida" id="txtUnidadMedida" placeholder="-">
                                    </div>
                                </div>


                                <div class="form-group row">
                                
                                    <div class="col-4">
                                        <label for="txtPrecioUnitario" class="labelForm">Precio Unitario</label>
                                        <input readonly=true class="form-control" type="text" name="precioUnitario" id="txtPrecioUnitario" placeholder="-">
                                    </div>

                                    <div class="col-2">
                                        <label for="txtPrecioUnitario" class="labelForm">% Descuento</label>
                                        <input class="form-control" onkeydown="return validarNumeroEntero(event)" type="text" name="porcDesc" value=0 id="txtPorcDesc" placeholder="" maxlength="3">
                                    </div>

                                    <div class="col-5">
                                        <label for="txtCantidad" class="labelForm">Cantidad</label>
                                        <input class="form-control" onkeydown="return validarNumeroEntero(event)" type="text" name="cantidad" id="txtCantidad" placeholder="Cantidad" maxlength="10">
                                    </div>
    
                                    <div class="col-offset-1">
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
                                <div class="col col-lg-4">
                                    <label class="labelForm" for="txtNeto">Neto</label>
                                    <input readonly="true" required="required" class="form-control" type="text" name="neto" id="txtNeto" placeholder="-">
                                </div>
                                <div class="col col-lg-4">
                                    <label class="labelForm" for="txtIVA">IVA</label>
                                    <input readonly="true" required="required" class="form-control" type="text" name="iva" id="txtIVA" placeholder="-">
                                </div>
                                <div class="col col-lg-4">
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
                                    
    <!-- Javascript -->
    <script type="text/javascript">

        var numFila = 1; //Contador de filas y para asigar un id unico
        var neto = 0; //Almacena el neto

        //Obtener el id del modal correspondiente
        function determinarTipoDeModal(tipoModal){
            if(tipoModal === "registrar"){
                return "#modalFact";
            }

            else if (tipoModal == "info"){
                return "#modalFactInfo";
            }
            else if (tipoModal == "actualizar"){
                return "#modalFactAct";
            }
        }

        //Permite que solo se puedan ingresar numeros y uso de ctrl+c y ctrl+v
        function validarNumeroEntero(e){
            if(!((e.keyCode > 95 && e.keyCode < 106) || (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8 || e.keyCode == 9 
                || e.ctrlKey == true || (e.ctrlKey == true && e.keyCode == 86) || (e.ctrlKey == true && e.keyCode == 67))) {
                return false;
            }
        }

        //Evento para evitar pegar datos no numericos en los textbxo que son exclusivo de numeros
        $('#txtPorcDesc, #txtCantidad').on('paste', function (event) {
            if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) { 
                event.preventDefault();
            }
        });

    
        //Validar campos, ver si ya existe el folio antes de enviar datos al servidro
        function validarCampos(e){
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
            var cantCeldas = (($('#tablaProd td').length));
            if (cantCeldas == 0){
                alert("¡Agrege productos!");
                return false;
            }

        }

        //Carga Precio Unitario y Unidad de Medida a los txtbox segun producto elegido
        function cargaPrecioUnitYUM(accion){
            var tipoModal = determinarTipoDeModal(accion);
            var precioUn = $(tipoModal + ' #cbxProducto :selected').data("prod-precio");
            $(tipoModal + ' #txtPrecioUnitario').val(precioUn.toLocaleString("es-CL"));

            var um = $(tipoModal + ' #cbxProducto :selected').data("prod-um");
            $(tipoModal + ' #txtUnidadMedida').val(um);

        }

        //Función para agregar productos a la tabla
        function agregarProd(e){
            var tipoModal = determinarTipoDeModal(e);

            var prodSel = $(tipoModal + " #cbxProducto :selected").text(); 
            var idProdSel = $(tipoModal + " #cbxProducto :selected").val();
            var um = $(tipoModal + " #cbxProducto :selected").data("prod-um");
            var precioUn = $(tipoModal + " #cbxProducto :selected").data("prod-precio");
            var cantUn = parseInt($(tipoModal + " #txtCantidad").val());
            var descuento = parseInt($(tipoModal + " #txtPorcDesc").val());
            var total = (cantUn * precioUn);
            var valorDescuento = (total * descuento/100);
            total = Math.round(total - valorDescuento);

            //Para corroborar si ya existe el producto en la tabla
            var existe = (($(tipoModal + ' #tablaProd [name="idProd[]"]').parent(':contains(' + idProdSel + ')')).length);
            
            if(isNaN(descuento) || !(descuento >=0 && descuento <=100)){
                alert("¡El descuento debe ser entre 0 al 100% del producto!");
            }
            
            else if(idProdSel == "" || isNaN(cantUn) || cantUn <0 ){
                alert ("¡Debe seleccionar un producto y una cantidad para agregarlo!");
            }
            else if (existe >0){
                alert ("¡El producto seleccionado ya esta ingresado en la factura!")
            }

            else{
            //Agregar a la tabla:               
                $(tipoModal).find('tbody')
                .append($('<tr>')
                    .append($('<td class="text-center align-middle">')
                        .text(idProdSel)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'idProd[]')
                                .attr('id', 'idProd'+ numFila)
                                .attr('value', idProdSel)
                            
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(prodSel)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'nomProd[]')
                                .attr('id', 'nomProd'+ numFila)
                                .attr('value', prodSel)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(um)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'um[]')
                                .attr('id', 'um'+ numFila)
                                .attr('value', um)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(cantUn)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'cantUn[]')
                                .attr('id', 'cantUn'+ numFila)
                                .attr('value', cantUn)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(precioUn.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'precioUn[]')
                                .attr('id', 'precioUn'+ numFila)
                                .attr('value', precioUn)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(descuento.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'desc[]')
                                .attr('id', 'desc'+ numFila)
                                .attr('value', descuento)
                        )
                        .append($('<span>')
                            .text("%")
                        )
                        .append($('<br><span>')
                            .text(" (" + valorDescuento.toLocaleString("es-CL") + ")")
                        )
                        
                    )
                    .append($('<td class="text-center align-middle" name="valorparacalculo">')
                        .text(total.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'valor[]')
                                .attr('id', 'valor'+ numFila)
                                .attr('value', total)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .append($('<button>')
                            .attr('class', 'btn btn-danger')
                            .attr('type', 'button')
                            .attr('onclick', 'eliminarProd(this, "' + tipoModal + '")')
                                .append($('<span>')
                                    .attr('class', 'bi bi-dash-circle-fill')
                                )
                        )
                    )
                )

                numFila++;

                //Limpiar campos
                $(tipoModal + " #cbxProducto").val('');
                $(tipoModal + " #txtPrecioUnitario").val('-');
                $(tipoModal + " #txtCantidad").val('');
                $(tipoModal + " #txtPorcDesc").val(0);

                //Calcular totales
                calcularTotales(tipoModal);
            }
        
        }

        function eliminarProd(e, tipoModal){
            //Removemos la fila correspondiente al botón de eliminar
            $(e).parent().parent().remove();
            calcularTotales(tipoModal);
        }
        
        //Se llama cada vez que se elmina o agrega un producto, calcula los totales
        function calcularTotales(tipoModal){
            neto=0;

            $(tipoModal + ' #tablaProd [name="valorparacalculo"]').each(function( index ) {
                neto = neto + parseInt($( this ).text().split('.').join("")); //Tomamos el texto, le sacamos los puntos y lo pasamos a numero
            });

            var iva = neto * 0.19;
            //Dejar iva con solo dos decimales cómo máximo
            iva = Math.round (iva * 100) / 100
            
            //Total sin decimales   
            var total = Math.round(iva+neto);

            //Para formatear por miles
            netoFor = neto.toLocaleString("es-CL");
            ivaFor = iva.toLocaleString("es-CL");
            totalFor = total.toLocaleString("es-CL");

            $(tipoModal + ' #txtNeto').val(netoFor);
            $(tipoModal + ' #txtIVA').val(ivaFor);
            $(tipoModal +' #txtTotal').val(totalFor);
        }

        //Evento click sobre icono de información de factura, toma el folio-tipoDoc y se lo envia por ajax a traves de post al controlador.
        $('.facturainfo').click(function(){
        
            var folio = $(this).data('folio');
            var idTipoDoc = $(this).data('tipo-doc');

            // AJAX request
            $.ajax({
                url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
                type: 'post',
                data: {folio: folio, idTipoDoc:idTipoDoc, cargarModal: "informacion"},
                success: function(response){ 
                    // Add response in Modal body
                    $('#modalFactInfo .modal-body').html(response);
                
                    // Display Modal
                    $('#modalFactInfo').modal('show'); 
                }
            });
        });

    </script>
        
    
</body>

 <?php require_once '../../footer.php' ?> 
</html>