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

        <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/mantenedorGenerico.css">
        <title>Mantenedor Empresas</title>

        
    </head>

    <body>
        <?php require_once '../menu.php' ?>
    
        <div class="container-fluid contenedorH3"> 
            <h3>Mantenedor Empresas</h3>
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
                
                <?php    
            } ?>

                <!-- contenedor de registro nuevo  -->
                <div class="container-fluid contenedorBoton">
                    <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalEmp" data-emp-accion='nueva'><i class="bi bi-plus-circle-fill"></i> Nueva Empresa</button>
                </div>

                <table id="example" class="table is-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                    <th>Rut Empresa</th>
                    <th>Dv</th>
                    <th>Razón Social</th>
                    <th>Giro</th>
                    <th class='text-center'>Acción</th>
                    </tr>
                </thead>

                <tbody>
                <?php

                    require '../../controlador/controladorEmpresa.php';

                    $listaEmpresas = getTodasLasEmpresas();

                    if(count($listaEmpresas) > 0){
                        foreach($listaEmpresas as $empresa){ 
                        ?>
                            <tr>
                                <td> <span class='label label-primary'> <?php echo $empresa->getRutEmp();?> </span></td>
                                <td> <span class='label label-primary'> <?php echo $empresa->getdvEmp();?> </span></td>
                                <td> <span class='label label-primary'> <?php echo $empresa->getrazonEmp();?> </span></td>
                                <td> <span class='label label-primary'> <?php echo $empresa->getgiroEmp();?> </span></td>
                            
                                <td class="text-center">
                                    
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEmp" 
                                    data-emp-rut="<?php echo $empresa->getRutEmp();?>" 
                                    data-emp-dvemp="<?php echo $empresa->getdvEmp();?>" 
                                    data-emp-razonsocial="<?php echo $empresa->getrazonEmp();?>"
                                    data-emp-giro="<?php echo $empresa->getgiroEmp();?>" data-emp-accion='actualizar'><i class="bi bi-pencil-fill"></i></button>

                                    <span class="btn btn-danger"  data-toggle="modal" data-target="#modalEmp" 
                                        data-emp-rut='<?php echo $empresa->getRutEmp() ?>'
                                        data-emp-dvemp='<?php echo $empresa->getdvEmp() ?>' 
                                        data-emp-razonsocial='<?php echo $empresa->getrazonEmp() ?>'
                                        data-emp-giro='<?php echo $empresa->getgiroEmp() ?>' data-emp-accion='eliminar'><i class="bi bi-trash2-fill"></i></span>
                                </td>
                            </tr>    
                        <?php
                        }
                    }
                    else
                    { //TODO: IMPLEMENTAR REGISTAR en caso de no haber datos
                        ?> 
                        <tr><td colspan=4 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen Empresas registradas</td>
                        <td class='text-center'><a href='registrar.php'><span class='glyphicon glyphicon-plus'>Registar nueva Empresa</span></a></td>
                    <?php 
                    }

                    ?>
                </tbody>         
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEmp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 ><i id="iconoModal" class="bi bi-bookmark-plus-fill"> </i><span id="tituloModal">Nueva Empresa</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="../../controlador/controladorEmpresa.php" id="formEmp" method="POST">
                                    
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="txtRutEmp" class="labelForm" >Rut Empresa</label>
                                    <input required="required" class="form-control" type="number" name="rutEmp" id="txtRutEmp" placeholder="Rut empresa" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="txtDvEmpresa" class="labelForm">Digito verificador</label>
                                    <input required="required" class="form-control" type="text" name="dvEmpresa" id="txtDvEmpresa" placeholder="Digito verificador" maxlength="1">
                                </div>
                                <div class="form-group">
                                    <label for="txtRazonSocial" class="labelForm">Razón Social</label>
                                    <input required="required" class="form-control" type="text" name="razonSocial" id="txtRazonSocial" placeholder="Razón social">
                                </div>
                                <div class="form-group">
                                    <label for="txtGiroEmpresa" class="labelForm">Giro de la Empresa</label>
                                    <input required="required" class="form-control" type="text" name="giroEmpresa" id="txtGiroEmpresa" placeholder="Giro de la empresa">
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

        <script src="/repitelramo/presentacion/dist/js/principalEmpresa.js" type="text/javascript"></script>
        
    </body>

    <?php require_once '../footer.php' ?> 

</html>