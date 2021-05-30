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
    <link rel="stylesheet" href="../../dist/css/number.css">
    <!-- script de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>     
    <!-- script de datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
    <!-- Js boostrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../dist/js/main.js"></script>


    <title>Libro Ventas</title>

    

</head>
<body>
    <?php require_once '../../menu.php' ?>
  <div class="container mt-5">
        <div class="col-lg-10 form-control h-100">
            <div class="row">
                <div class="col-lg-8 d-flex">
                    <div class="form-group col-lg-8">
                        <label for="">Mes</label>
                        <input type="month" name="fecha" id="fecha" class="form-control" value="2021-05">
                    </div>
                    <div class="form-group col-lg-4 pt-3 mt-3">
                        <button type="button" name="consulta"  id="consulta"class="btn btn-success"><i class="bi bi-search"></i> Generar</button>
                    </div>
                </div>
                <div class="form-group col-lg-4 alaign-content-end">
                    <label for="">Total mes:</label>
                    <input class="form-control" type="number" name="" id="" disabled>
                </div>
            </div>
            <div class="row">
                <table class="table is-striped table-hover m-3">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Tipo Documento</th>
                            <th>Fecha Emisión</th>
                            <th>Cliente</th>
                            <th>Total Neto</th>
                            <th>IVA</th>
                            <th>Total Bruto</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                    
                </tbody>   
                </table>
            </div>
        </div>
  </div>
  <script>
  //Evento click sobre eliminar.
     $('#consulta').click(function(){
        
       var fecha=$("#fecha").val();
        // AJAX request
        $.ajax({
            url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
            type: 'post',
            data: {consulta: "consulta", fecha:fecha},
            success: function(response){ 
                // Add response in Modal body
                $('#resultado').html(response);
            
            }
        });
    });
    </script> 
    
</body>

    <?php require_once '../../footer.php' ?> 
</html>