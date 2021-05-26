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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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


        /*Modificación del modal*/
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

        <!-- contenedor de registro nuevo y libro factura q -->
        <div class="container-fluid contenedorBoton">
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalFact" data-prod-accion='Nueva Factura'><i class="bi bi-plus-circle-fill"></i> Nueva Factura</button>
            
            <!-- Botón libro de venta restringido solo para admin -->
            <?php if($_SESSION['usuario']->getTipoUsuario()->getNombreTipoUsu() == "Administrador"){?>
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalFact" data-prod-accion='Libro de Venta'><i class="bi bi-plus-circle-fill"></i> Libro de Venta</button>
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

        <?php 

            require '../../../controlador/controladorEncabezadoDocumento.php';

            $listaEncabezados = getTodosEncabezadoDocumento();

            if (count($listaEncabezados) > 0) {
                foreach ($listaEncabezados as $encabezado) {
        ?>
           <tr>
                    <td><?php echo $encabezado->getFolioDoc();?></td>
                    <td><?php echo $encabezado->getTipoDoc()->getNombreTipoDoc(); ?></td>
                    <td><?php echo $encabezado->getFechaEmision() ?></td>
                    <td><?php echo $encabezado->getCliente()->getNombRazonSocial() ?></td>
                    <td><?php echo $encabezado->getNeto() ?></td>
                    <td><?php echo $encabezado->getIva() ?></td>
                    <td><?php echo $encabezado->getTotal() ?></td>          


                    <td class="text-center">
                        <div style="min-width : 136px">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFact"><i class="bi bi-eye-fill"></i></button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalFact"><i class="bi bi-pencil-fill"></i></button>
                            <span class="btn btn-danger"  data-toggle="modal" data-target="#modalFact" ><i class="bi bi-trash2-fill"></i></span>
                        </div>
                    </td>
                </tr>

        
        <?php
                }
                }else
                {
                    ?> 
                    <tr><td colspan=4 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen facturas registradas</td></tr> 
                <?php 
                }
                ?>  

        <tbody>
  
        </tbody>         
    </table>

    </div>

      <!-- ventana modal -->
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
                    <form action="../../controlador/controladorProducto.php" id="formProd" method="POST">
                                                
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
                            <div class="form-group row">
                                <div class="col-4">
                                <label for="cbxProducto" class="labelForm">Agregar producto</label>
                                <select onchange="cargaPrecioUnit()"  class="form-control" name="producto" id="cbxProducto">
                                    <option selected value="" disabled="1">Selecciona Producto</option>
                                    <?php
                                        include_once "../../../controlador/controladorProducto.php";

                                        $listaProductos = getTodosLosProductos();

                                        foreach($listaProductos as $productos){
                                            echo "<option value='" . $productos->getCodProd() . "' data-prod-precio=" . $productos->getPrecioUnitaro() . " data-prod-um='" . $productos->getUnidadMedida()->getNombreUM() ."'>" . $productos->getDescripcion(). "</option>"; 
                                        }
                                    ?>
                                </select>
                                </div>

                                <div class="col-4">
                                    <label for="txtPrecioUnitario" class="labelForm">Precio Unitario</label>
                                    <input readonly=true class="form-control" type="text" name="precioUnitario" id="txtPrecioUnitario" placeholder="-">
                                </div>

                                <div class="col-3">
                                    <label for="txtCantidad" class="labelForm">Cantidad</label>
                                    <input class="form-control" type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad" maxlength="10">
                                </div>
 
                                <div class="col-offset-1">
                                <label for="btnAgregar" class="labelForm"> &nbsp;  </label>
                                <div class="text-center">
                                <button onclick="agregarProd()" type="button" class="btn btn-success" id="btnAgregar" name="btnAgregar"><i class="bi bi-plus-circle-fill"></i></button>                 
                                </div>
                                </div>
                            </div>

                        </div>

                        <div class="container-fluid">
                            <!-- datatable -->
                            <div class="container-fluid table-responsive">  
                            <table id="tablaProd" class="table is-striped table-hover bg-light" style="width:100%;">
                                <thead>
                                    <tr>
                                   <!-- <th>Item</th> -->
                                    <th>Cód</th>
                                    <th>Descripción</th>
                                    <th>UM</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unit</th>
                                    <th>Descuento</th>
                                    <th>Valor</th>
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
                                <input readonly="true" required="required" class="form-control" type="number" name="neto" id="txtNeto" placeholder="-">
                            </div>
                            <div class="col col-lg-4">
                                <label class="labelForm" for="txtIVA">IVA</label>
                                <input readonly="true" required="required" class="form-control" type="number" name="iva" id="txtIVA" placeholder="-">
                            </div>
                            <div class="col col-lg-4">
                                <label class="labelForm" for="txtTotal">Total</label>
                                <input readonly="true" required="required" class="form-control" type="number" name="total" id="txtTotal" placeholder="-">
                            </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="form-group row">
                                <div class="col col-lg-12">
                                    <label class="labelForm" for="txtObservaciones">Observaciones</label>
                                    <textarea class="form-control" id="txtObservaciones" mame="observaciones" rows="2"></textarea>
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

                        <div class="text-center form-group" id="lblEliminar">
                        <label>Si esta seguro de eliminar el registro presione el botón</label>
                        </div>

                        <div class="container-fluid">
                            <div class="form-group">
                                <button class="btn btn-dark col-lg-12" id="btnAccion" name="registrar" onclick="return validarCampos()" type="submit">Registrar</button>
                            </div>
                        </div>                        
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <script type="text/javascript">

    var numFila = 1;
    var neto = 0;

    function validarCampos(){
        var cantCeldas = (($('#tablaProd td').length));
        if (cantCeldas == 0){
            alert("¡Agrege productos!");
            return false;
        }
    }

    function cargaPrecioUnit(){
        var precioUn = $('#cbxProducto :selected').data("prod-precio");
        $('#txtPrecioUnitario').val(precioUn);
    }

    function agregarProd(){
        var prodSel = $("#cbxProducto :selected").text(); 
        var idProdSel = $("#cbxProducto :selected").val();
        var um = $("#cbxProducto :selected").data("prod-um");
        var precioUn = $('#cbxProducto :selected').data("prod-precio");
        var cantUn = parseInt($("#txtCantidad").val());
        var total = cantUn * precioUn;
        //Para corroborar si ya existe el producto en la tabla
        var existe = (($('#tablaProd [name="idProd[]"]:contains(' + idProdSel + ')').length));

        if(idProdSel == "" || isNaN(cantUn) || cantUn <0 ){
            alert ("¡Debe seleccionar un producto y una cantidad para agregarlo!");
        }
        else if (existe >0){
            alert ("¡El producto seleccionado ya esta ingresado en la factura!")
        }

        else{
        
        $("#tablaProd").find('tbody')
        .append($('<tr>')
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'idProd[]')
                    .attr('id', 'idProd'+ numFila)
                    .text(idProdSel)
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'nomProd[]')
                    .attr('id', 'nomProd'+ numFila)
                    .text(prodSel)
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'um[]')
                    .attr('id', 'um'+ numFila)
                    .text(um)
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'cantUn[]')
                    .attr('id', 'cantUn'+ numFila)
                    .text(cantUn)
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'precioUn[]')
                    .attr('id', 'precioUn'+ numFila)
                    .text(precioUn)
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'desc[]')
                    .attr('id', 'desc'+ numFila)
                    .text('0')
                )
            )
            .append($('<td>')
                .append($('<span>')
                    .attr('name', 'valor[]')
                    .attr('id', 'valor'+ numFila)
                    .text(total)
                )
            )
            .append($('<td>')
                .append($('<button>')
                    .attr('class', 'btn btn-danger')
                    .attr('type', 'button')
                    .attr('onclick', 'eliminarProd(this)')
                        .append($('<span>')
                            .attr('class', 'bi bi-dash-circle-fill')
                        )
                )
            )
        )

        numFila++;

        //Limpiar campos
        $("#cbxProducto").val('');
        $("#txtPrecioUnitario").val('-');
        $("#txtCantidad").val('');

        //Calcular totales
        calcularTotales();
        }
    
    }

    function eliminarProd(e){
        var opener=e.relatedTarget;//Esta var tiene el elemento que llamó al modal (osea el botón correspondiente)
        $(e).parent().parent().remove();
        alert("se borra");
        calcularTotales();
    }

    function calcularTotales(){
        neto=0;

        $('#tablaProd [name="valor[]"]').each(function( index ) {
            neto = neto + parseInt($( this ).text());
        });

        var iva = neto * 0.19;
        var total = iva+neto;

        $('#txtNeto').val(neto);
        $('#txtIVA').val(iva);
        $('#txtTotal').val(total);
    }



    </script>
        
    
</body>

 <?php require_once '../../footer.php' ?> 
</html>