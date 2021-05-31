<?php   
    //No dejar acceder a esta página si no es admin
    require_once "../permisosAdmin.php";
?>

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
        <!-- script de jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <!-- script de datatable -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
        <!-- Js boostrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <script type="text/javascript" src="../dist/js/main.js"></script>

        <link rel="stylesheet" href="../dist/css/number.css">


        <script type="text/javascript">

            

        </script>
        <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/principalProducto.css">
        <title>Mantenedor Producto</title>
    </head>
    <body>
        <?php require_once '../menu.php' ?>
    
        <div class="container-fluid contenedorH3"> 
                <h3>Mantenedor Productos</h3>
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

        <!-- contenedor de registro nuevo -->
        <div class="container-fluid contenedorBoton">
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalProd" data-prod-accion='Nuevo Producto'><i class="bi bi-plus-circle-fill"></i> Nuevo Producto</button>
        </div>
        
        <table id="example" class="table is-striped table-hover " style="width:100%">
            <thead>
                <tr>
                <th>Codigo Producto</th>
                <th>Descripción Producto</th>
                <th>Unidad de Medida</th>
                <th>Precio Unitario</th>
                <th class='text-center'>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php 

                    require '../../controlador/controladorProducto.php';

                    $listaProductos = getTodosLosProductos();

                    if (count($listaProductos) > 0) {
                        foreach ($listaProductos as $producto) {
                    ?>
                    <tr>
                        <td><?php echo $producto->getCodProd();?></td>
                        <td><?php echo $producto->getDescripcion(); ?></td>
                        <td><?php echo $producto->getUnidadMedida()->getNombreUM()?></td>
                        <td><?php echo number_format ( $producto->getPrecioUnitaro(),  0, ",", "." ) //numberFormat para poner separador de miles y sacar decimales 0 ?></td>

                        <td class="text-center">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalProd" data-prod-id='<?php echo $producto->getCodProd() ?>'
                                        data-prod-des='<?php echo $producto->getDescripcion() ?>' data-prod-um='<?php echo $producto->getUnidadMedida()->getIdUm() ?>'
                                        data-prod-precio='<?php echo floatval($producto->getPrecioUnitaro())?>' data-prod-accion='Actualizar Producto'><i class="bi bi-pencil-fill"></i></button>
                            <span class="btn btn-danger"  data-toggle="modal" data-target="#modalProd" data-prod-id='<?php echo $producto->getCodProd() ?>'
                                        data-prod-des='<?php echo $producto->getDescripcion() ?>' data-prod-um='<?php echo $producto->getUnidadMedida()->getIdUm() ?>'
                                        data-prod-precio='<?php echo floatval($producto->getPrecioUnitaro()) ?>' data-prod-accion='Eliminar Producto'><i class="bi bi-trash2-fill"></i></span>
                        </td>
                    </tr>
                    <?php
                        }
                    }else
                    {
                        ?> 
                        <tr><td colspan=4 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen productos registrados</td></tr> 
                    <?php 
                    }
                ?>            
        </table>

        <!-- ventana modal -->
        <div class="modal fade" id="modalProd" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 ><i id="iconoModal" class="bi bi-bookmark-plus-fill"> </i><span id="txtTituloModal">Nuevo Cliente</span></h5>
                        <button class="close" data-dismiss="modal" aria-label="cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../../controlador/controladorProducto.php" id="formProd" method="POST">
                            
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="txtCodProd" class="labelForm" >Código del producto</label>
                                    <input readonly=true required="required" class="form-control" type="text" name="codProd" id="txtCodProd" placeholder="Código del producto" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="txtCodProd" class="labelForm">Descripción del producto</label>
                                    <input required="required" class="form-control" type="text" name="descripcion" id="txtDescripcion" placeholder="Descripción del producto">
                                </div>

                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                        <label for="cbxUnidadMedida" class="labelForm">Unidad de Medida</label>
                                        <select class="form-control" name="unidadMedida" id="cbxUnidadMedida" required="required">
                                        <option selected value="" disabled="1">Unidad de medida</option>
                                        <?php
                                            include_once "../../controlador/controladorUM.php";

                                            $listaUM = getTodasUM();

                                            foreach($listaUM as $UM){
                                                echo "<option value='" . $UM->getIdUM() . "'>" . $UM->getNombreUM(). "</option>"; 
                                            }
                                        ?>
                                        </select>
                                </div>  
                        
                            </div>
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label class="labelForm" for="txtPrecioUnitario">Precio unitario</label>
                                    <input required="required" class="form-control" onkeydown="return validarNumeroEntero(event)" type="number" name="precioUnitario" id="txtPrecioUnitario" placeholder="Precio unitario" min="0">
                                </div>
                            </div>

                            <div class="text-center form-group" id="lblEliminar">
                            <label>Si esta seguro de eliminar el registro presione el botón</label>
                            </div>

                            <div class="container-fluid">
                                <div class="form-group">
                                    <button class="btn btn-dark col-lg-12" id="btnAccion" name="registrar" onclick="validarCampos()" type="submit">Registrar</button>
                                </div>
                            </div>                        
                        </form>
                    </div>                
                </div>
            </div>
        </div>

        </div>

        <script src="/repitelramo/presentacion/dist/js/principalProducto.js" type="text/javascript"></script> 
        
    </body>

    <?php require_once '../footer.php' ?> 
</html>