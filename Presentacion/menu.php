<?php
  //Llamamos a la clase usuario.php, ocupamos document_root para evitar problemas con los directorios
  require $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/entidades/usuario.php";
      //If para ver si la session esta activa o no 
      if(session_status() !== 2  || session_id() === ""){
        session_start();
    }
    
    //Corroboramos que la sesión a sido inicada
    require_once "validacionSesion.php";
  
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-*-start" id="navbarsExample08">
    <ul class="navbar-nav">
      <a href="" class="navbar-brand">Repi <small class="font-weight-bold lead">Telramo Electronics</small> </a>
    <li class="nav-item">
        <a class="nav-link" href=<?php echo "/repitelramo/presentacion/principal.php" ?>><i class="bi bi-house-door-fill"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "/repitelramo/presentacion/empresa/principalEmpresa.php"?>>Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "/repitelramo/presentacion/cliente/principalCliente.php"?>>Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=<?php echo "/repitelramo/presentacion/producto/principalProducto.php"?>>Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Mantenedor</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Documentos</a>
        <div class="dropdown-menu" aria-labelledby="dropdown08">
          <a class="dropdown-item navbar-dark disabled" href="#">Boleta</a>
          <a class="dropdown-item" href=<?php echo "/repitelramo/presentacion/documento/factura/principalFactura.php"?>>Factura</a>
          <a class="dropdown-item disabled" href="#">Nota de Credito</a>
        </div>
      </li>                             
    </ul>
    <li class="navbar-nav nav-item dropdown ml-auto dropleft">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usuario']->getNombreUsu(); ?> </a>
        <div class="dropdown-menu ml" aria-labelledby="dropdown08">
          <a class="dropdown-item navbar-dark disabled" href="#">Mi Perfil</a>
          <a class="dropdown-item" href=<?php echo "/repitelramo/index.php?msj=logout"?>>Cerrar sesión</a>
        </div>
      </li>
            
  </div>  
</nav>