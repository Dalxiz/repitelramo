<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <style>
        .formulario{
            margin: 100px;
            border: 1px solid grey;
            border-radius: 4px;
        }
    </style>

    <title>Registrar Empresa</title>


</head>
<body>
    
<div class="col-lg-5 formulario">
            <form action="../../Controlador/controladorEmpresa.php" method="POST">

                <div class="form-group">
                    <label for="txtRutEmpresa"></label>
                    <input class="form-control" type="number" name="rutEmp" id="txtRutEmpresa" placeholder="Rut de la empresa">
                </div>

                <div class="form-group">
                    <label for="txtDvEmpresa"></label>
                    <input class="form-control" type="text" name="dvEmpresa" id="txtDvEmpresa" placeholder="Digito Verificador de la empresa">
                </div>

                <div class="form-group">
                    <label for="txtRazonSocial"></label>
                    <input class="form-control" type="text" name="razonSocial" id="txtRazonSocial" placeholder="Razon Social de la empresa">
                </div>

                <div class="form-group">
                    <label for="txtGiroEmpresa"></label>
                    <input class="form-control" type="text" name="giroEmpresa" id="txtGiroEmpresa" placeholder="Giro de la empresa">
                </div>

                <div class="form-group">
                <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
                <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                </div>
 
            </form>

       </div>

</body>
</html>