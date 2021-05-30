<form action="../../../controlador/controladorEncabezadoDocumento.php" id="formFactActualizar" method="POST">            
    <div class="container-fluid">
        <div class="form-group row">
            <div class="col col-md-6 col-12 mb-3 mb-md-0">
                <label for="cbxEmpresa" class="labelForm">Empresa</label>
                <select class="form-control" name="empresa" id="cbxEmpresa" required="required">
                <option value="" disabled="1">Empresa</option>
                    <?php
                        include_once  $_SERVER['DOCUMENT_ROOT'] . '/repitelramo/controlador/controladorEmpresa.php';

                        $listaEmpresas = getTodasLasEmpresas();

                        foreach($listaEmpresas as $empresas){
                            if($empresas->getRutEmp() == $_SESSION['encabezado'][0]->getEmpresa()->getRutEmp()){
                                echo "<option selected value='" . $empresas->getRutEmp() . "'>" . $empresas->getRazonEmp(). "</option>";
                            }

                            else{
                                echo "<option value='" . $empresas->getRutEmp() . "'>" . $empresas->getRazonEmp(). "</option>";
                            }

                        }
                    ?>
                </select>
            </div>  
    

            <div class="col col-md-6 col-12">
                        <label for="cbxTipoDoc" class="labelForm">Tipo de documento</label>
                        <select disabled class="form-control" name="tipoDoc" id="cbxTipoDoc" required="required">
                            <option selected value="" disabled="1">Tipo de documento</option>
                            <?php
                                include_once  $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/controlador/controladorTipoDocumento.php";

                                $listaTipoDoc = getTodosTipoDocumento();

                                foreach($listaTipoDoc as $tipoDoc){
                                    if($tipoDoc->getIdTipoDoc() == $_SESSION['encabezado'][0]->getTipoDoc()->getIdTipoDoc()){
                                        echo "<option selected value='" . $tipoDoc->getIdTipoDoc() . "'>" . $tipoDoc->getNombreTipoDoc(). "</option>"; 
                                    }
                                    else{
                                        echo "<option value='" . $tipoDoc->getIdTipoDoc() . "'>" . $tipoDoc->getNombreTipoDoc(). "</option>"; 
                                    }
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
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/controlador/controladorCliente.php";

                        $listaClientes = getTodosLosClientes();

                        foreach($listaClientes as $clientes){
                            if($clientes->getRutCliente() == $_SESSION['encabezado'][0]->getCliente()->getRutCliente()){
                                echo "<option selected value='" . $clientes->getRutCliente() . "'>" . $clientes->getRutCompleto() . " | " . $clientes->getNombRazonSocial(). "</option>";
                            }
                            else{
                                echo "<option value='" . $clientes->getRutCliente() . "'>" . $clientes->getRutCompleto() . " | " . $clientes->getNombRazonSocial(). "</option>";
                            } 
                        }
                    ?>
                </select>
            </div>

            <div class="col col-md-6 col-12">
                <label for="txtFolio" class="labelForm">Folio del documento</label>
                <input required="required" readonly value="<?php echo $_SESSION['encabezado'][0]->getFolioDoc(); ?>" class="form-control" type="number" name="folio" id="txtFolio" placeholder="Folio del documento">
            </div>

        </div>  
    </div>

    <div class="container-fluid">
    
        <div class="form-group row">
        <div class="col col-lg-6">
            <label for="txtFechaRegistro" class="labelForm" >Fecha de registro</label>
            <input required="required" value="<?php echo $_SESSION['encabezado'][0]->getFechaRegistro(); ?>" class="form-control" type="date" name="fechaRegistro" id="txtFechaRegistro" placeholder="Fecha de registro" maxlength="10">
            </div>
            <div class="col col-lg-6">
            <label for="txtCondPago" class="labelForm">Condicion de pago</label>
            <input required="required" value="<?php echo $_SESSION['encabezado'][0]->getCondPago(); ?>" class="form-control" type="text" name="condPago" id="txtCondPago" placeholder="Condición de pago">
                </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="form-group">
                <label for="cbxEstadoDoc" class="labelForm">Estado del documento</label>
                <select disabled class="form-control" name="estadoDoc" id="cbxEstadoDoc" required="required">
                    <option selected value="" disabled="1">Estado del documento</option>
                    <option <?php if($_SESSION['encabezado'][0]->getEstadoDoc() == "Registrado") {echo "selected";} ?> class ="text-info" value="Registrado">Registrado</option>
                    <option <?php if($_SESSION['encabezado'][0]->getEstadoDoc() == "Emitido") {echo "selected";}; ?> class="text-success" value="Emitido">Emitido</option>
                    <option <?php if($_SESSION['encabezado'][0]->getEstadoDoc() == "Anulado") {echo "selected";} ?> class="text-danger" value="Anulado">Anulado</option>
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
                    <select onchange="cargaPrecioUnitYUM('actualizar')"  class="form-control" name="producto" id="cbxProducto">
                        <option selected value="" disabled="1">Selecciona Producto</option>
                        <?php
                            include_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/controlador/controladorProducto.php";

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
                        <button onclick="agregarProd('actualizar')" type="button" class="btn btn-success" id="btnAgregar" name="btnAgregar"><i class="bi bi-plus-circle-fill"></i></button>                 
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

                <?php 

                    foreach ($_SESSION['encabezado'][0]->getListaDetalles() as $detalle) {
                        $codProd = $detalle->getProducto()->getCodProd();
                        $descripcion = $detalle->getProducto()->getDescripcion();
                        $nombreUM = $detalle->getProducto()->getUnidadMedida()->getNombreUM();
                        $cantUn = $detalle->getCantUnitaria();
                        $precioUnitario = $detalle->getPrecioUnitario();
                        $descuento = $detalle->getDescuento();
                        $valor = $detalle->getValor();
                        $valorDescuento = ( ($cantUn * $precioUnitario) * $descuento / 100);
                ?>
                
                <tr>
                    <td class="text-center align-middle">
                        <span><?php echo $codProd;?></span>
                        <input type="hidden" name="idProd[]" value="<?php echo $codProd;?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <span><?php echo $descripcion;?></span>
                        <input type="hidden" name="nomProd[]" value="<?php echo $descripcion;?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <span><?php echo $nombreUM;?></span>
                        <input type="hidden" name="um[]" value="<?php echo $nombreUM;?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <span><?php echo $cantUn ?></span>
                        <input type="hidden" name="cantUn[]" value="<?php echo $cantUn?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <span><?php echo number_format ($precioUnitario, 0, ",", ".")?></span>
                        <input type="hidden" name="precioUn[]" value="<?php echo $precioUnitario?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <span><?php echo str_replace(",00", "", number_format ($descuento , 2, ",", "." ) )?>%</span>
                        <input type="hidden" name="desc[]" value="<?php echo $descuento?>"></input>
                        <br>
                        <span>(<?php echo str_replace(",00", "", number_format ($valorDescuento , 2, ",", "." ) ) ?>)</span>
                    </td>

                    <td class="text-center align-middle" name="valorparacalculo">
                        <span><?php echo number_format ($detalle->getValor(), 0, ",", ".")?></span>
                        <input type="hidden" name="valor[]" value="<?php echo $detalle->getValor()?>"></input>
                    </td>

                    <td class="text-center align-middle">
                        <button type="button" onclick="eliminarProd(this, '#modalFactAct')" class="btn btn-danger"><span class="bi bi-dash-circle-fill"></span></button>

                    </td>

                </tr>
                <?php } ?>

                </tbody>
            </table>
                
        </div>    

    </div>

    <div class="container-fluid">
        <div class="form-group row">
            <div class="col col-lg-4">
                <label class="labelForm" for="txtNeto">Neto</label>
                <input readonly="true" value="<?php echo number_format ( $_SESSION['encabezado'][0]->getNeto(), 0, ",", "."); ?>" required="required" class="form-control" type="text" name="neto" id="txtNeto" placeholder="-">
            </div>
            <div class="col col-lg-4">
                <label class="labelForm" for="txtIVA">IVA</label>
                <input readonly="true" value="<?php echo str_replace(",00", "", number_format ($_SESSION['encabezado'][0]->getIVA(), 2, ",", "." )); ?>" required="required" class="form-control" type="text" name="iva" id="txtIVA" placeholder="-">
            </div>
            <div class="col col-lg-4">
                <label class="labelForm" for="txtTotal">Total</label>
                <input readonly="true" value="<?php echo number_format ( $_SESSION['encabezado'][0]->getTotal(), 0, ",", "." ); ?>" required="required" class="form-control" type="text" name="total" id="txtTotal" placeholder="-">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="form-group row">
            <div class="col col-lg-12">
                <label class="labelForm" for="txtObservaciones">Observaciones</label>
                <textarea class="form-control" id="txtObservaciones" name="observaciones" rows="2"><?php echo $_SESSION['encabezado'][0]->getObservaciones() ?></textarea>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="form-group row">
            <div class="col col-lg-12">
                <label class="labelForm" for="txtCancelado">Cancelado por</label>
                <input value = "<?php echo $_SESSION['encabezado'][0]->getCanceladoPor() ?>" class="form-control" type="text" name="cancelado" id="txtCancelado" placeholder="">
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="form-group">
            <button class="btn btn-dark col-lg-12" id="btnAccion" name="actualizar" onclick="return validarCampos('actualizar')" type="submit">Actualizar</button>
        </div>
    </div>                        
</form>