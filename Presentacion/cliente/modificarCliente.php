<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../../Controlador/controladorCliente.php" method="POST">
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-lg-10">
                                        <input class="form-control" type="text" name="Rut" id="" placeholder="Ingrese su Rut">                        
                                    </div>
                                    <div class="col col-xs-2">                        
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
                            <button class="btn btn-dark col-lg-12" name="eliminar" type="submit">Registrar</button>
                        </div>
                    </div>                        
                    </form>
</body>
</html>