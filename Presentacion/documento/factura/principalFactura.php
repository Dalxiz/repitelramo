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

        <tbody>
            <tr>
                <td>1</td>
                <td>Factura Electrónica</td>
                <td>19/02/2021</td>
                <td>Ignacio Lo</td>
                <td>2312302</td>
                <td>340242</td>
                <td>2765400</td>
                <td class="text-center"> 
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalFact"><i class="bi bi-pencil-fill"></i></button>
                    <span class="btn btn-danger"  data-toggle="modal" data-target="#modalFact"><i class="bi bi-trash2-fill"></i></span>
                </td>

            </tr>       
            <tr>
                <td>2</td>
                <td>Factura Electrónica</td>
                <td>24/02/2021</td>
                <td>Daniel Camacho</td>
                <td>321321</td>
                <td>45042</td>
                <td>376544</td>
                <td class="text-center"> 
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalFact"><i class="bi bi-pencil-fill"></i></button>
                    <span class="btn btn-danger"  data-toggle="modal" data-target="#modalFact"><i class="bi bi-trash2-fill"></i></span>
                </td>
            </tr>  
            <tr>
                <td>3</td>
                <td>Factura Electrónica</td>
                <td>20/04/2021</td>
                <td>Javier Miranda</td>
                <td>1230440</td>
                <td>103021</td>
                <td>1330440</td>
                <td class="text-center"> 
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalFact"><i class="bi bi-pencil-fill"></i></button>
                    <span class="btn btn-danger"  data-toggle="modal" data-target="#modalFact"><i class="bi bi-trash2-fill"></i></span>
                </td>
            </tr>
        </tbody>         
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalFact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

 <?php require_once '../../footer.php' ?> 
</html>