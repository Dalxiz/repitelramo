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
    <title>Principal</title>
</head>
<body>
<nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuBarra">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="principal.php"><i class="glyphicon glyphicon-home"></i></a>
              </div>
              
              <div class="collapse navbar-collapse" id="menuBarra">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Cliente</a></li>
                  <li class="active"><a href="#">Empresa</a></li>
                  <li class="active"><a href="producto/principalProducto.php">Producto</a></li>
                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown">Documentos<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                            <li><a href="#">Facturas</a></li>
                            <li><a href="#">Nota de Credito</a></li>
                      </ul>
                  </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>
                  </ul>
            </div>
        </nav>
    
</body>
</html>