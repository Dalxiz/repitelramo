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

    <style>
        
        html,body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #211E1C;
        }
        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        background-color: whitesmoke;
        border-radius: 5px;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }

        
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <title>Inicio Sesión</title>
</head>
    <body>
        <form action="../Controlador/controladorUsuario.php" class="form-signin form-color" method="POST">
            <center>
                <img class="mb-4" src="../img/logo.png" alt="" width="150" height="150">
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
    </body>
</html>