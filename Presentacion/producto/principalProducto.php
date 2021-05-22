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

    <script type="text/javascript" src="../main.js"></script>

    <script type="text/javascript">

    function validarNumeroEntero(e){
        if(!((e.keyCode > 95 && e.keyCode < 106) || (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8)) {
            return false;
        }
    }

    function validarCampos(){
        var codProd = document.getElementById("txtCodProd").value;
        var descripcion = document.getElementById("txtDescripcion").value;
        var precioUnitario = document.getElementById("txtPrecioUnitario").value;
        var unidadMedida = document.getElementById("cbxUnidadMedida").value;
        var accion = document.getElementById("btnAccion").getAttribute("name");

        if(codProd === "" || descripcion === "" || precioUnitario === "" || unidadMedida == ""){
            if( accion == "registrar"){
            alert("¡Debe rellenar todos los campos antes de ingresar un producto!");
            }
            else{
                alert("¡Debe rellenar todos los campos antes de actualizar un producto!");

            }
        }


    }

    </script>


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
 

        </style>
    <title>Mantenedor Producto</title>
</head>
<body>
    <?php require_once '../menu.php' ?>
 
    <div class="container-fluid contenedorH3"> 
            <h3>Mantenedor Productos</h3>
    </div>
    
    <!-- datatable -->
    <div class="container-fluid contenedorTabla">
    
    <!-- alert -->
    <?php if(isset($_GET['msj']) && strpos($_GET['msj'],"ok",) === 0) {  ?>
        
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



    
    <table id="example" class="table is-striped" style="width:100%">
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

                require '../../Controlador/controladorProducto.php';

                $listaProductos = getTodosLosProductos();

                if (count($listaProductos) > 0) {
                    foreach ($listaProductos as $producto) {
                ?>
                <tr>
                    <td><?php echo $producto->getCodProd();?></td>
                    <td><?php echo $producto->getDescripcion(); ?></td>
                    <td><?php echo $producto->getUnidadMedida()->getNombreUM()?></td>
                    <td><?php echo $producto->getPrecioUnitaro() ?></td>

                    <td class="text-center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalProd" data-prod-id='<?php echo $producto->getCodProd() ?>'
                                    data-prod-des='<?php echo $producto->getDescripcion() ?>' data-prod-um='<?php echo $producto->getUnidadMedida()->getIdUm() ?>'
                                    data-prod-precio='<?php echo $producto->getPrecioUnitaro() ?>' data-prod-accion='Actualizar Producto'><i class="bi bi-pencil-fill"></i></button>
                        <span class="btn btn-danger"  data-toggle="modal" data-target="#modalProd" data-prod-id='<?php echo $producto->getCodProd() ?>'
                                    data-prod-des='<?php echo $producto->getDescripcion() ?>' data-prod-um='<?php echo $producto->getUnidadMedida()->getIdUm() ?>'
                                    data-prod-precio='<?php echo $producto->getPrecioUnitaro() ?>' data-prod-accion='Eliminar Producto'><i class="bi bi-trash2-fill"></i></span>
                    </td>
                </tr>
                <?php
                    }
                }else{

                }


            
            
            ?>            
            </tr>           
          
    </table>

    <!-- ventana modal -->
    <div class="modal fade" id="modalProd" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 ><i class="bi bi-bookmark-plus-fill"></i><span id="txtTituloModal">Nuevo Cliente</span></h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../Controlador/controladorProducto.php" id="formProd" method="POST">
                        
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
                                        include_once "../../Controlador/controladorUM.php";

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

    <script type="text/javascript">

        $('#modalProd').on('show.bs.modal', function (e) {
        //A penas se habrá el modal la infomraicon se carga
        var opener=e.relatedTarget;//Esto tiene el elemento que llamó al modal (osea el botón correspondiente)

        //Obtenemos los valores de los atributos definidos

        /* MANERA 1:
        var prodId=$(opener).attr('data-prod-id');
        var prodDesc=$(opener).attr('data-prod-des');
        var prodUM=$(opener).attr('data-prod-um');
        var prodPrecio=$(opener).attr('data-prod-precio');
        */

        /* MANERA 2: */
        var prodId=$(opener).data('prod-id');
        var prodDesc=$(opener).data('prod-des');
        var prodUM=$(opener).data('prod-um');
        var prodPrecio=$(opener).data('prod-precio');
        var txtTituloModal=$(opener).data('prod-accion')

        //Ahora ponemos los valores de la fila a los campos del form del modal
        $('#formProd #txtCodProd').val(prodId);
        $('#formProd').find('[id="txtDescripcion"]').val(prodDesc);
        $('#formProd').find('[id="cbxUnidadMedida"]').val(prodUM);
        $('#formProd').find('[id="txtPrecioUnitario"]').val(prodPrecio);
        $('#txtTituloModal').text(txtTituloModal);

        //Segun el model abierto, los atributos cambian:
        if(txtTituloModal == "Nuevo Producto"){
            //Condición de disabled o readonly
            $('#txtCodProd').attr("readonly", false);
            $('#txtDescripcion').attr("readonly", false);
            $('#cbxUnidadMedida').attr("disabled", false);
            $('#txtPrecioUnitario').attr("readonly", false);

            $('#btnAccion').attr("name", "registrar");  //name para Post
            $('#cbxUnidadMedida').val('') //ComboBox se selecciona opción con valor vacío
            $('#btnAccion').text("Registrar"); //Texto Botón
            $('#formProd label').attr("hidden",true); 
        }

        else if (txtTituloModal == "Actualizar Producto"){
            $('#txtCodProd').attr("readonly", true);
            $('#txtDescripcion').attr("readonly", false);
            $('#cbxUnidadMedida').attr("disabled", false);
            $('#txtPrecioUnitario').attr("readonly", false);
            $('#btnAccion').attr("name", "actualizar");
            $('#btnAccion').text("Actualizar");
            $('#formProd label').removeAttr('hidden'); 
        }

        else if (txtTituloModal == "Eliminar Producto"){
            $('#txtCodProd').attr("readonly", true);
            $('#txtDescripcion').attr("readonly", true);
            $('#cbxUnidadMedida').attr("disabled", true);
            $('#txtPrecioUnitario').attr("readonly", true);

            $('#btnAccion').attr("name", "eliminar");
            $('#btnAccion').text("Eliminar");
            $('#formProd label').removeAttr('hidden'); 
        }

        });

    </script>
    
</body>

 <?php require_once '../footer.php' ?> 
</html>