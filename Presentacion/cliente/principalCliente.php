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
                width: 80%;
            }
            
        </style>
    <title>Registro Cliente</title>
</head>
<body>
    <div class="container-fluid contenedorH3"> 
            <h3>Mantenedor Clientes</h3>
    </div>
    
    <!-- datatable -->
    <div class="container-fluid  contenedorTabla">
    <!-- contenedor de registro nuevo -->
    <div class="container-fluid contenedorBoton">
        <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#ventanaModal"><i class="bi bi-plus-circle-fill"></i> Nuevo Cliente</button>
    </div>
    <table id="example" class="table is-striped" style="width:100%">
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
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ventanaModal"><i class="bi bi-pencil-fill"></i></button>
                <span class="btn btn-danger"><i class="bi bi-trash2-fill"></i></span>
                </td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>
                <span class="btn btn-warning" data-toggle="modal" data-target="#ventanaModal"><i class="bi bi-pencil-fill"></i></span>
                <span class="btn btn-danger"><i class="bi bi-trash2-fill"></i></span>
                </td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>
                <span class="btn btn-warning" data-toggle="modal" data-target="#ventanaModal" ><i class="bi bi-pencil-fill"></i></span>
                <span class="btn btn-danger"><i class="bi bi-trash2-fill"></i></span>
                </td>
            </tr>           
          
    </table>

    <!-- ventana modal -->
    <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="bi bi-bookmark-plus-fill"></i> Nuevo Cliente</h5>
                    <button class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../Controlador/controladorCliente.php" method="POST">
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-9">
                                        <input class="form-control" type="text" name="Rut" id="" placeholder="Ingrese su Rut">                        
                                    </div>
                                    <div class="col col-xs-3">                        
                                        <input class="form-control l" type="text" name="Dv" id="" placeholder="Dv">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                <input class="form-control" type="text" name="Razon" id="" placeholder="Razón Social">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Giro" id="" placeholder="Giro">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="Direccion" id="" placeholder="Direccion">
                            </div>               
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="text" name="Comuna" id="" placeholder="Comuna">                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="text" name="Ciudad" id="" placeholder="Ciudad">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <input class="form-control" type="tel" name="Telefono" id="" placeholder="Telefono">                        
                                        </div>
                                        <div class="col col-lg-6">                        
                                            <input class="form-control l" type="email" name="Email" id="" placeholder="E-mail">
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

    </div>
    <!-- script de jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!-- script de bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- script de datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

    <script type="text/javascript" src="../main.js"></script>
</body>
</html>