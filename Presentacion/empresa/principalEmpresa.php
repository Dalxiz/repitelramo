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
 

        </style>

</head>
<body>
    <?php require_once '../menu.php' ?>
   
    <div class="container-fluid contenedorH3"> 
        <h3>Mantenedor de Empresas</h3>
    </div>

    <!-- datatable -->
    <div class="container-fluid contenedorTabla table-responsive">

        <!-- contenedor de registro nuevo y libro factura q -->
        <div class="container-fluid contenedorBoton">
            <button type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modalEmp" data-prod-accion='Nueva Empresa'><i class="bi bi-plus-circle-fill"></i> Nueva Empresa</button>
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
                foreach($listaEmpresas as $empresa)
                { ?>
                    <tr>
                    <td> <span class='label label-primary'> <?php echo $empresa->getRutEmp();?> </span></td>
                    <td> <span class='label label-primary'> <?php echo $empresa->getdvEmp();?> </span></td>
                    <td> <span class='label label-primary'> <?php echo $empresa->getrazonEmp();?> </span></td>
                    <td> <span class='label label-primary'> <?php echo $empresa->getgiroEmp();?> </span></td>

                    
                      
                    <td class="text-center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEmp"><i class="bi bi-pencil-fill"></i></button>
                    </td>
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

    <!-- Modal -->
    <div class="modal fade" id="modalEmp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Por implementar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Funcionalidad por implementar
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>
        


    </div>
    
</body>

 <?php require_once '../footer.php' ?> 
</html>