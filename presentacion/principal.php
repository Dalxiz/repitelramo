<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css de bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css de icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- script de jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Js boostrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/principal.css">
    
    <title>Panel Principal</title>

    
</head>
<body>

<?php require_once 'menu.php' ?>

  <?php if(isset($_GET['msj']) && strpos($_GET['msj'],"sinpermiso") === 0) {  ?>
                
                <div class='alert alert-danger alert-dismissible'>
                        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>¡No posee los permisos para acceder a esa página!</strong>
                </div>
            
  <?php } ?>

  <div class="container d-block">
  <div class="row no-gutters  ">
    <div class="d-inline-block p-12 m-auto pt-3">
    <h2>Bienvenido al proyecto con HTML, CSS, JAVASCRIPT, PHP.-</h2>
    <small class="text-muted">Proyecto se divide en 2 entregas</small>
    <small class="text-muted">Realizado por:
      <ul>
        <li>Ignacio Barria</li>
        <li>Niculas Guzman</li>
        <li>Ignacio Hao Ten LO</li>
        <li>David Morales</li>
      </ul>
    </small>
    </div>
    <div class="col-lg-4 p-5 m-auto">
      <p><strong>22/05/2021 Primera Etapa (ENTREGA POR CORREO ELECTRÓNICO HASTA LAS 23:59H)</strong><br>
            Diseño e implementación de Base de Datos.
            Mantenedor de Productos.
            Diseño de interfaces propuestas.
            * Para esta entrega se espera:
      <ul>
      <li>El CRUD completo de la entidad producto.</li>

      <li>El diseño de interfaces.</li>

      <li>Las clases implementadas asociadas a la entidad producto y el resto en avance.</li>

      <li>Estructuras de segmentación avanzadas (presentacion/entidades/controladores/persistencia).</li>

      <li>Modelo relacional completo y su script de implementación.</li>
        </ul>
      </p>
    </div>
    <div class="col-lg-4 p-sm m-auto pt-4">
      <p><strong>29/05/2021 Segunda Etapa y final (ENTREGA POR CORREO ELECTRÓNICO HASTA LAS 23:59H)</strong><br>
            Mantenedor de Clientes y Empresa
            Módulo de Administración documentos de venta.
            Módulo de Administración consulta de facturas y Libro de Ventas.
            Implementación de acceso por login según perfil. (opcional)
            * Para esta entrega se espera:
      <ul>
        <strong>El CRUD completo de la entidad producto, clientes y empresa.</strong>

          <li>El diseño de interfaces finalizado.</li>
          <li>Las clases implementadas asociadas a todas las entidades..</li>
          <li>Estructuras de segmentación finalizadas (presentacion/entidades/controladores/persistencia).</li>
          <li>Model relacional completo y su script de implementación.</li>
          <li>Los modulos de administración de venta, consulta y libro de ventas finalizados.</li>
          <li>Inicio de sesión implementado con direccionamiento por perfil (OPCIONAL).</li>

        </ul>
      </p>
    </div>
        <div class="col-lg-2 p-sm pt-5">
            <p><strong>Evaluación:</strong>  <br>        
                <li>Primera Etapa : Nota 2 (40% del promedio EX1)</li>
                <li>Segunda Etapa : Nota 3 (60% del promedio EX1)</li>
                <li>Promedio : Examen de Primera Oportunidad..</li>
            </p>
        </div>
  </div>
  </div>

</body>
    <?php require_once 'footer.php' ?>
</html>

