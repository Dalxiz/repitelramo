
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href=<?php echo "//localhost/repitelramo/presentacion/principal.php" ?>><i class="bi bi-house-door-fill"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "//localhost/repitelramo/presentacion/empresa/principalEmpresa.php"?>>Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "//localhost/repitelramo/presentacion/cliente/principalCliente.php"?>>Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "//localhost/repitelramo/presentacion/producto/principalProducto.php"?>>Productos</a>
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