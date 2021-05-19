<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Document</title>
    
</head>
<body>
    <div class="container col-lg-8"></div>
        <form action="../../Controlador/controladorCliente.php" method="POST">

        

            <div class="form-group">
                <input class="form-control caja" type="text" name="Rut" id="" placeholder="ingrese rut"><br>               
                <input class="form-control caja" type="text" name="Dv" id="" placeholder="dv">
            </div>
            <input  class="form-control caja" type="text" name="Razon" id="" placeholder="Razon Social"><br>
            <input class="form-control caja" type="text" name="Giro" id="" placeholder="Giro"><br>
            <input class="form-control caja" type="text" name="Direccion" id="" placeholder="Direccion"><br>
            <div class="form-group">
                <input  class="form-control caja" type="text" name="Comuna" id="" placeholder="Comuna"><br>
                <input class="form-control caja" type="text" name="Ciudad" id="" placeholder="Ciudad">
            </div>
            <div class="form-group">
                <input class="form-control caja" type="tel" name="Telefono" id="" placeholder="Telefono"><br>
                <input class="form-control caja" type="email" name="Email" id="" placeholder="Email">
            </div>
        
        <button class="btn btn-primary" id="btnAccion" type="submit" name="modificar">Enviar</button>

    </form>
</div>
</body>
</html>