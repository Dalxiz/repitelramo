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
    <!-- script de bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- script de datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

    <script type="text/javascript" src="/repitelramo/presentacion/dist/js/main.js"></script>

    <link rel="stylesheet" href="../dist/css/number.css">
    <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/mantenedorGenerico.css">
    <title>Mantenedor Cliente</title>
</head>
<body>
    <?php require_once '../menu.php' ?>
    <div class="container-fluid contenedorH3"> 
            <h3>Mantenedor Clientes</h3>
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
        <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#ventanaModal"><i class="bi bi-plus-circle-fill"></i> Nuevo Cliente</button>
    </div>
    <table id="example" class="table is-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Rut</th>
                <th>Dv</th>
                <th>Razón Social</th>
                <th>Giro</th>
                <th>Dirección</th>
                <th>Comuna</th>
                <th>Ciudad</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                require '../../controlador/controladorCliente.php';

                $listaClientes = getTodosLosClientes();

                if (count($listaClientes) > 0) {
                    foreach ($listaClientes as $cliente) {
                ?>
                <tr>
                    <td><?php echo $cliente->getRutCliente(); ?></td>
                    <td><?php echo $cliente->getDvCliente(); ?></td>
                    <td><?php echo $cliente->getNombRazonSocial();?></td>
                    <td><?php echo $cliente->getGiroCliente();?></td>
                    <td><?php echo $cliente->getDireccion();?></td>
                    <td><?php echo $cliente->getComuna();?></td>
                    <td><?php echo $cliente->getCiudad();?></td>
                    <td><?php echo $cliente->getTelefono();?></td>
                    <td><?php echo $cliente->getEmail();?></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" 
                                data-rut='<?php echo $cliente->getRutCliente()?>'
                                data-dv='<?php echo $cliente->getDvCliente()?>'
                                data-razon='<?php echo $cliente->getNombRazonSocial()?>'
                                data-giro='<?php echo $cliente->getGiroCliente()?>'
                                data-direccion='<?php echo $cliente->getDireccion()?>'
                                data-comuna='<?php echo $cliente->getComuna()?>'
                                data-ciudad='<?php echo $cliente->getCiudad()?>'
                                data-telefono='<?php echo $cliente->getTelefono()?>'
                                data-email='<?php echo $cliente->getEmail()?>'><i class="bi bi-pencil-fill"></i></button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar" 
                                data-rut='<?php echo $cliente->getRutCliente()?>'
                                data-dv='<?php echo $cliente->getDvCliente()?>'
                                data-razon='<?php echo $cliente->getNombRazonSocial()?>'><i class="bi bi-trash2-fill"></i></button>
                    </td>
                </tr>
                <?php
                    }
                }else{

                }
            
            
            ?>            
            </tr>           
          
    </table>
    </div>

    <!-- ventana modal registrar-->
    <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="bi bi-bookmark-plus-fill"></i> Registrar Nuevo Cliente</h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../controlador/controladorCliente.php" method="POST">
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-9">
                                        <input class="form-control" name="Rut" placeholder="Ingrese su Rut" type="text" pattern="\d*" maxlength="8" required>                        
                                    </div>
                                    <div class="col col-xs-3">                        
                                        <input class="form-control l" type="text" name="Dv" placeholder="Dv" maxlength="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                <input class="form-control" type="text" name="Razon" placeholder="Razón Social" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Giro" placeholder="Giro" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Direccion" placeholder="Direccion" required>
                            </div>               
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="text" name="Comuna" placeholder="Comuna" required>                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="text" name="Ciudad"  placeholder="Ciudad" required>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="number" name="Telefono" placeholder="Telefono">                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="email" name="Email" placeholder="E-mail">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                        <div class="form-group">
                            <button class="btn btn-dark col-lg-12" name="registrar" type="submit">Registrar</button>
                        </div>
                    </div>                        
                    </form>
                </div>                
            </div>
        </div>
    </div>
 
    
    <!-- ventana modal editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="bi bi-pencil-square"></i> Modificar Cliente</h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../controlador/controladorCliente.php" method="POST">
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-9">
                                        <input class="form-control" type="number" readonly="true" name="Rut" id="txtRut" placeholder="Ingrese su Rut" type="text" pattern="\d*" maxlength="8">                        
                                    </div>
                                    <div class="col col-xs-3">                        
                                        <input class="form-control l" type="text" readonly="true" name="Dv" id="txtDv" placeholder="Dv" maxlength="1" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                <input class="form-control" type="text" name="Razon" id="txtRazon" placeholder="Razón Social">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Giro" id="txtGiro" placeholder="Giro">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Direccion" id="txtDireccion" placeholder="Direccion">
                            </div>               
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="text" name="Comuna" id="txtComuna" placeholder="Comuna">                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="text" name="Ciudad" id="txtCiudad" placeholder="Ciudad">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="number" name="Telefono" id="txtTelefono" placeholder="Telefono">                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="email" name="Email" id="txtEmail" placeholder="E-mail">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                        <div class="form-group">
                            <button class="btn btn-dark col-lg-12" name="modificar" type="submit">Modificar</button>
                        </div>
                    </div>                        
                    </form>
                </div>                
            </div>
        </div>
    </div>
    
    <!-- ventana modal Eliminar-->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="bi bi-x-octagon-fill"></i> Eliminar Cliente</h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../controlador/controladorCliente.php" method="POST">                         
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-9">
                                        <input class="form-control" type="number" readonly="true" name="Rut" id="txtRutEl" placeholder="Ingrese su Rut" type="text" pattern="\d*" maxlength="8">                        
                                    </div>
                                    <div class="col col-xs-3">                        
                                        <input class="form-control l" type="text" readonly="true" name="Dv" id="txtDvEl" placeholder="Dv" maxlength="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                <input class="form-control" type="text" name="Razon" readonly="true" id="txtRazonEl" placeholder="Razón Social">
                            </div> 
                            </div>                    
                        <div class="container-fluid">
                            <div class="form-group">
                                <center>
                                <label for="">¿Seguro qsssue desea Eliminar el registro?</label>
                                </center>
                            </div>
                        </div> 
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-6">
                                        <button class="btn btn-success col-lg-12" name="eliminar" type="submit">Si</button>                        
                                    </div>
                                    <div class="col col-xs-6">                        
                                    <button class="btn btn-danger col-lg-12" data-dismiss="modal" type="button">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>                
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/repitelramo/presentacion/dist/js/principalCliente.js"></script>

</body>
    <?php require_once '../footer.php' ?>
</html>
