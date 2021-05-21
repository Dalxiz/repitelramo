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


    

    <title>Modificar Producto</title>


</head>
<body>

<!--<div class="col-lg-5 contFormulario">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProd">
  Modificar Empresa
</button>

</div>


<div class="modal fade" id="modalProd" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <form action="../../Controlador/controladorEmpresa.php" id="formEmpr" method="POST">
                <div class="form-group">
                    <label for="txtCodProd"></label>
                    <input required="required" class="form-control" type="number" name="rutEmp" id="txtRutEmp" placeholder="Rut empresa sin dv" maxlength="10">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion"></label>
                    <input required="required" class="form-control" type="text" name="dvEmpresa" id="txtDvEmpresa" placeholder="Digito verificador">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion"></label>
                    <input required="required" class="form-control" type="text" name="razonSocial" id="txtrazonSocial" placeholder="Razón social">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion"></label>
                    <input required="required" class="form-control" type="text" name="giroEmpresa" id="txtGiroEmpresa" placeholder="Giro de la empresa">
                </div>                

                <div class="form-group"> 
                <button id="btnAccion" type="submit" name="registrar" class="btn btn-primary" onclick="return validarCampos()">Guardar</button>
                </div>
                
            </form>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>-->


<div class="col-lg-12">
            <h4><b><i class="glyphicon glyphicon-education">&nbsp;</i>MODIFICAR EMPRESAS</b></h4>
            <form action="modificarProductoIgnacio.php" method="POST">
                <div>
                    <table class='table table-bordered table-hover table-responsive'>

                    <thead>
                        <tr>
                            <th>Rut empresa</th>
                            <th>Dv</th>
                            <th>Razon Social</th>
                            <th>Giro</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php

                            require '../../Controlador/controladorEmpresa.php';

                            $listaEmpresas = getTodasLasEmpresas();

                            if(count($listaEmpresas) > 0){
                                foreach($listaEmpresas as $empresa)
                                { ?>
                                    <tr>
                                    <td> <span class='label label-primary'> <?php echo $empresa->getRutEmp();?> </span></td>
                                    <td> <span class='label label-primary'> <?php echo $empresa->getdvEmp();?> </span></td>
                                    <td> <span class='label label-primary'> <?php echo $empresa->getrazonEmp();?> </span></td>
                                    <td> <span class='label label-primary'> <?php echo $empresa->getgiroEmp();?> </span></td>

                                    
                                    <td class="text-center"><button class="btn btn-primary" type='button' data-toggle='modal' data-target='#modalProd' data-prod-rut='<?php echo $empresa->getRutEmp() ?>'
                                    data-prod-dv='<?php echo $empresa->getdvEmp() ?>' data-prod-razonem='<?php echo $empresa->getrazonEmp() ?>' 
                                    data-prod-giro='<?php echo $empresa->getgiroEmp() ?>'>Edit</button></td>

                                    </tr>
                                <?php
                                }
                            }
                            else
                            { //TODO: IMPLEMENTAR REGISTAR en caso de no haber datos
                                ?> 
                                <tr><td colspan=4 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen productos registrados</td>
                                <td class='text-center'><a href='registrar.php'><span class='glyphicon glyphicon-plus'>Registar Producto</span></a></td>
                            <?php 
                            }



                            ?>

                    </tbody>

                    </table>
                </div>

                <button id="btnAccion" type="submit" class="btn btn-primary">Refrescar</button>

            </form>

        </div>

        <script type="text/javascript">

        $('#modalProd').on('show.bs.modal', function (e) {
        //A penas se habrá el modal la infomraicon se carga
        var opener=e.relatedTarget;//Esto tiene el elemento que llamó al modal (osea el botón correspondiente)
        
        //Obtenemos los valores de los atributos definidos
        var prodId=$(opener).attr('prod-id');
        var prodDesc=$(opener).attr('prod-des');
        var prodUM=$(opener).attr('prod-um');
        var prodPrecio=$(opener).attr('prod-precio');

        //Ahora ponemos los valores a los campos del form
        $('#formProd').find('[id="txtCodProd"]').val(prodId);
        $('#formProd').find('[id="txtDescripcion"]').val(prodDesc);
        $('#formProd').find('[id="cbxUnidadMedida"]').val(prodUM);
        $('#formProd').find('[id="txtPrecioUnitario"]').val(prodPrecio);
        
        });
        
        </script>

    



</body>
</html>