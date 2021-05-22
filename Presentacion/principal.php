<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css de datdatble-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> 
    <!-- css de icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Principal</title>

    <style>
        
      .contenedor-footer {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
      }

      .footer {
        background-color: #f5f5f5;
      }

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="http://localhost/repitelramo/presentacion/principal.php"><i class="bi bi-house-door-fill"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Presentacion/empresa/principalEmpresa.php">Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Presentacion/cliente/principalCliente.php">Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Presentacion/producto/principalProducto.php">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Mantenedor</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Documentos</a>
        <div class="dropdown-menu" aria-labelledby="dropdown08">
          <a class="dropdown-item navbar-dark disabled" href="#">Boleta</a>
          <a class="dropdown-item" href="../Presentacion/documento/factura/principalFactura.php">Factura</a>
          <a class="dropdown-item disabled" href="#">Nota de Credito</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


<footer class="footer mt-auto py-3">
  <div class="contenedor-footer">
    <a href="http://localhost/repitelramo/presentacion/principal.php"><img src="../img/logo.png" height="70" width="70" alt=""></a>
    <span class="text-muted">© 2021 Repi Telramo Copyright . Desarrollado por The Vapers</span>
  </div>
</footer>


    <!-- script de bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- script de datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

    <script type="text/javascript" src="main.js"></script>
</body>
</html>