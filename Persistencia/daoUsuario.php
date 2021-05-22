<?php 

    function registrarUsuario(Usuario $nuevoUsuario){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO USUARIO (IDUSU,IDTIPOUSU,NOMBREUSU,PASSUSU,CORREOUSU)
                                     VALUES (?, ?, ?, ?, ?, ?)");

            $result = $query->execute([$nuevoUsuario->getIdUsu(),
                                $nuevoUsuario->getTipoUsuario(),
                                $nuevoUsuario->getNombreUsu(),
                                $nuevoUsuario->getPassUsu(),
                                $nuevoUsuario->getCorreoUsu()]);

            if ($result === true) {
                return 'ok';
            }else {
                return 'err';
            }
        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

    function consultarProducto(){
        require_once 'parametrosBD.php';
        require_once 'daoTipoUsuario.php';

        try {
            $conn = new PDo("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaUsuarios=[];

            $querySelect=$conn->query("SELECT * FROM");

            // foreach ($querySelect->fetchAll() as $tablaUsuBBDD) {
                
            // }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

?>