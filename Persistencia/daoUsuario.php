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

    function consultarUSuario(){
        require_once 'parametrosBD.php';
        require_once 'daoTipoUsuario.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaUsuarios=[];

            $querySelect=$conn->query("SELECT * FROM");

            foreach ($querySelect->fetchAll() as $tablaUsuBBDD) {
                
                $tipoUsuario = consultarTUPorId($tablaUsuBBDD['idTipoUsu']);
                $usuarioSel=new TipoUsuario($tablaUsuBBDD['idUsu'],
                                            $tablaUsuBBDD['nombreUsu'],
                                            $tablaUsuBBDD['passUsu'],
                                            $tablaUsuBBDD['correoUsu']);
            $listaUsuarios[]=$usuarioSel;

            }

            if(count($listaUsuarios) > 0){
                return $listaUsuarios;
            }else{
                return ($lista=[]);
            }

        } catch (PDOException $pe) {
            return $pe->getMessage();
        }
    }

    function validarUsuario(Usuario $nuevoUsuario){

        require_once 'parametrosBD.php';
        require_once 'daoTipoUsuario.php';
        
        //Coroborar si la sesion se ha iniciado
        if(session_status() !== 2  || session_id() === ""){
            session_start();
        } 

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryValidar=$conn->query("SELECT * FROM USUARIO WHERE nombreUsu='".$nuevoUsuario->getNombreUsu()."' and passUsu='".$nuevoUsuario->getPassUsu()."'");

            $listaUsuarios=[];

            foreach ($queryValidar->fetchAll() as $tablaUsuBBDD) {
                
                $tipoUsuario = consultarTUPorId($tablaUsuBBDD['idTipoUsu']);

                $usuarioSel=new Usuario($tablaUsuBBDD['idUsu'],
                                        $tipoUsuario,
                                        $tablaUsuBBDD['nombreUsu'],
                                        $tablaUsuBBDD['passUsu'],
                                        $tablaUsuBBDD['correoUsu']);
            $listaUsuarios[]=$usuarioSel;

            }

            if(count($listaUsuarios) > 0){
                $_SESSION['usuario'] = $listaUsuarios[0];
                /*echo $listaUsuarios[0]->getNombreUsu();
                echo $_SESSION['usuario']->getNombreUsu();
                $_SESSION['nombre'] = $listaUsuarios[0]->getNombreUsu();
                echo $_SESSION['nombre']; */
                //die();
                return 'ok';
            }else{
                return 'err';
            }

        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

?>