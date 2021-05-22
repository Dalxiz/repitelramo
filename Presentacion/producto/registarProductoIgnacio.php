<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <style>
        .contFormulario{
            margin: 100px;
            border: 1px solid grey;
            border-radius: 10px;
        }
    </style>
     
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

        if(codProd === "" || descripcion === "" || precioUnitario === ""){
            alert("¡Debe rellenar todos los campos antes de ingresar un producto!");
        }        

    }

    </script>

    <title>Registrar Producto</title>


</head>
<body>
    
<div class="col-lg-5 contFormulario">
            <form action="../../controlador/controladorProducto.php" method="POST">
                <div class="form-group">
                    <label for="txtCodProd"></label>
                    <input required="required" class="form-control" type="text" name="codProd" id="txtCodProd" placeholder="Código del producto" maxlength="10">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion"></label>
                    <input required="required" class="form-control" type="text" name="descripcion" id="txtDescripcion" placeholder="Descripción del producto">
                </div>
                
                <div class="form-group">
                    <label for="cbxUnidadMedida">Unidad de Medida</label>
                    <select class="form-control" name="unidadMedida" id="cbxUnidadMedida">
                          
                        <?php
                            include "../../controlador/controladorUM.php";

                            $listaUM = getTodasUM();

                            foreach($listaUM as $UM){
                                echo "<option value='" . $UM->getIdUM() . "'>" . $UM->getNombreUM(). "</option>"; 
                            }
                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="txtPrecioUnitario"></label>
                    <input required="required" class="form-control" onkeydown="return validarNumeroEntero(event)" type="number" name="precioUnitario" id="txtPrecioUnitario" placeholder="Precio unitario" min="0">
                </div>
                <div class="form-group"> 
                <button id="btnAccion" type="submit" name="registrar" class="btn btn-primary" onclick="return validarCampos()">Guardar</button>
                </div>
            </form>
       </div>

</body>
</html>