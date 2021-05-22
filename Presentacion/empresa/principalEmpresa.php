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
        .contenedor{
                width: 40%;
                height: 50%;
                padding-top: 2rem;
                padding-bottom: 2rem;
                border: 1px solid silver;
                border-radius: 5px;
            }
            h3{
                color: white;
            }
            .contenedorH3{
                background-color: #343A40;
                height: 3rem;
                padding-top: 5px;
            }
            .contenedorBoton{
                padding-top: 7px;
                margin-bottom: 40px;
                margin-left: -1rem;
            }
            .contenedorTabla{
                padding-top: 15px;
                width: 100%;
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
    </style>
    <title>Empresa</title>
</head>
<body>
    
    <?php require_once '../menu.php' ?>

    <div class="container-fluid contenedorH3"> 
            <h3>Mantenedor Empresa</h3>
    </div>
    
</body>
    <?php require_once '../footer.php' ?>
</html>