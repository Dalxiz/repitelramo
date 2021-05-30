<?php  
    //Si se ha cerrado sesión se destruye la sesión
    if(isset($_GET['msj']) && strpos($_GET['msj'],"logout") === 0){
    session_start();
    session_destroy();
    }

    //If para ver si la session esta activa o no, si no esta activa se comienza
    if(session_status() !== 2  || session_id() === ""){
        session_start();
    } 

    //Si hay usuario logeado redirige a principal
    if(isset($_SESSION['usuario'])){
        header ("Location: /repitelramo/presentacion/principal.php");
    }

?>

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

    <link rel="stylesheet" href="/repitelramo/presentacion/dist/css/login.css">
    <!-- script de jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Js boostrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <title>Inicio Sesión</title>
</head>
    <body class="justify-content-center">
    <div class="justify-content-center">
    
        <?php if(isset($_GET['msj']) && $_GET['msj'] == "err") { //Error autenticación ?>
                
                <div class='alert alert-danger alert-dismissible'>
                        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>¡Autenticación incorrecta!</strong> Usario y/o contraseña inválidos
                </div>
            
            <?php } elseif(isset($_GET['msj']) && strpos($_GET['msj'],"err") === 0) { //Error tipo excepción ?>
                    
                <div class='alert alert-danger alert-dismissible'>
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>A ocurrido un error: </strong>  <?php echo $_GET['msj'] ?> 
                </div>
            
            <?php } elseif(isset($_GET['msj']) && strpos($_GET['msj'],"inc") !== false) { //Si intenta acceder a una página sin iniciar sesión ?>
                    
                <div class='alert alert-warning alert-dismissible'>
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>¡Debe iniciar sesión para acceder y navegar por el sitio!</strong> 
                </div>
            
            <?php } elseif(isset($_GET['msj']) && strpos($_GET['msj'],"logout") !== false) { //Si cierra sesión?>
                    
                    <div class='alert alert-success alert-dismissible'>
                        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>¡Ha cerrado sesión correctamente!</strong> 
                    </div>
                
                <?php    } ?>

            
        <form action="/repitelramo/controlador/controladorUsuario.php" class="form-signin form-color" method="POST">
      
            <center>
                <img class="mb-4" src="/repitelramo/presentacion/dist/img/logo.png" alt="" width="150" height="150">
                <h1 class="h3 mb-3 font-weight-normal">Registro</h1>
            </center>
                <label for="txtUsuario" class="sr-only">Usuario</label>
                <input type="text" id="txtUsuario" name="Usuario" class="form-control" placeholder="Usuario" required autofocus><br>
                <label for="txtPassword" class="sr-only">Password</label>
                <input type="password" id="txtPassword" name="Password" class="form-control" placeholder="Contraseña" required>
            <div class="checkbox mb-3">
                <label><input type="checkbox" value="remember-me"> Recuerdame</label>
            </div>
                <button class="btn btn-lg btn-dark btn-block" name="validar" type="submit">Ingresar</button>
            <center>
                <p class="mt-5 mb-3 text-muted">&copy; 2021 Repi Telramo. Desarrollado por The Vapers</p>
            </center>
        </form>
        </div>
    </body>
</html>