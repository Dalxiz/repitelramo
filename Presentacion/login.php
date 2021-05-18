<?php
    //Require a atribos de conexión.
    require_once "../persistencia/parametrosBD.php"; //Para que nos de los attributos de conexión.

    //Try catch apra control de excepciones
    try{
        //Objeto de conexion, que vien de la clase PDO, que es un objeto BASE de php, que nos permite conectarno a la bbdd
        //mysql:host=$parametroHost;
        $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);
        echo "Por fin estoy coenctado a mi base de datos";

    }catch(PDOException $pe){ 
        echo "No se conectó por la ....!!!". $pe->getMessage();
    }

?>