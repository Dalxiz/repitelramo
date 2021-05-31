<?php 

    function registrarCliente(Cliente $nuevoCliente){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO CLIENTE (RUTCLIENTE,DVCLIENTE,NOMB_RAZONSOCIAL,GIRO,DIRECCION,COMUNA,CIUDAD,TELEFONO,EMAIL)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $query->execute([$nuevoCliente->getRutCliente(),
                                        $nuevoCliente->getDvCliente(),
                                        $nuevoCliente->getNombRazonSocial(),
                                        $nuevoCliente->getGiroCliente(),
                                        $nuevoCliente->getDireccion(),
                                        $nuevoCliente->getComuna(),
                                        $nuevoCliente->getCiudad(),
                                        $nuevoCliente->getTelefono(),
                                        $nuevoCliente->getEmail()]);    

            if ($result) {
                return 'ok'  . " - Cliente con RUT: " . $nuevoCliente->getRutCompleto() . " - " . $nuevoCliente->getNombRazonSocial()  . " Registrado Correctamente!";

            }else {
                return 'err';
            }
            
        } catch (PDOException $pe) {
            
            if(strpos($pe->getMessage(),"violation: 1062")){
                return "err : El Cliente con RUT: '" . $nuevoCliente->getRutCompleto() ."' ya se encuentra registrado. El RUT debe ser único.";
            }
            return "err : ". $pe->getMessage();
        }
    }

    
    function modificarCliente(Cliente $nuevoClientes){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryUpdate = $conn->prepare("UPDATE CLIENTE SET dvCliente=:dvCliente, nomb_RazonSocial=:nombRazonSocial,
                                                         giro=:giroCliente, direccion=:direccion, comuna=:comuna,
                                                         ciudad=:ciudad, telefono=:telefono, email=:email WHERE rutCliente=:rutCliente");

            $queryUpdate->bindValue("rutCliente",$nuevoClientes->getRutCliente());
            $queryUpdate->bindValue( "dvCliente",$nuevoClientes->getDvCliente());
            $queryUpdate->bindValue("nombRazonSocial",$nuevoClientes->getNombRazonSocial());
            $queryUpdate->bindValue("giroCliente",$nuevoClientes->getGiroCliente());
            $queryUpdate->bindValue("direccion",$nuevoClientes->getDireccion());
            $queryUpdate->bindValue("comuna",$nuevoClientes->getComuna());
            $queryUpdate->bindValue("ciudad",$nuevoClientes->getCiudad());
            $queryUpdate->bindValue("telefono",$nuevoClientes->getTelefono());
            $queryUpdate->bindValue("email",$nuevoClientes->getEmail());    

            $resultado = $queryUpdate->execute();

            if ($resultado) {
                return 'ok'  . " - Cliente con RUT: " . $nuevoClientes->getRutCompleto() . " - Modificado Correctamente!";
            }else {
                return 'err';
            }

        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

    function eliminarCliente($rutCliente){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);            

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryDelete=$conn->prepare("DELETE FROM CLIENTE WHERE rutCliente=:rutCliente");

            $queryDelete->bindValue("rutCliente",$rutCliente->getRutCliente());

            $res=$queryDelete->execute();

            if ($res) {
                return 'ok'  . " - Cliente con RUT: " . $rutCliente->getRutCompleto() . " - Eliminado Correctamente!";
            }else{
                return 'err';
            }
        } catch (PDOException $pe) {

            if(strpos($pe->getMessage(),"violation: 1451")){
                return "err : El cliente con RUT: '" . $rutCliente->getRutCompleto() ."' esta siendo utilizado por documentos, no es posible eliminarlo. Contáctese con el administador del sistema si desea eleminarlo del sistema";
            }

            return 'Ocurrio un error:' . $pe->getMessage();
        }
    }

    function consultarCliente(){

        require 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listarClientes=[];

            $querySelect = $conn->query("SELECT * FROM CLIENTE");

            foreach ($querySelect->fetchAll() as $tablaClienteBBDD) {
                
                $clienteSelect = new cliente($tablaClienteBBDD['rutCliente'],
                                             $tablaClienteBBDD['dvCliente'],
                                             $tablaClienteBBDD['nomb_razonSocial'],
                                             $tablaClienteBBDD['giro'],
                                             $tablaClienteBBDD['direccion'],
                                             $tablaClienteBBDD['comuna'],
                                             $tablaClienteBBDD['ciudad'],
                                             $tablaClienteBBDD['telefono'],
                                             $tablaClienteBBDD['email']);

                $listarClientes[]=$clienteSelect;
            }

            if (count($listarClientes) > 0) {
                return $listarClientes;
            }else{
                return ($lista=[]);
            }
        } catch (PDOException $pe) {
            return $pe->getMessage();
        }
    }

    function consultarClientePorRut($rutCliente){

        require 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listarClientes=[];

            $querySelect = $conn->query("SELECT * FROM CLIENTE WHERE rutCliente = " . $rutCliente);

            foreach ($querySelect->fetchAll() as $tablaClienteBBDD) {
                
                $clienteSelect = new Cliente($tablaClienteBBDD['rutCliente'],
                                             $tablaClienteBBDD['dvCliente'],
                                             $tablaClienteBBDD['nomb_razonSocial'],
                                             $tablaClienteBBDD['giro'],
                                             $tablaClienteBBDD['direccion'],
                                             $tablaClienteBBDD['comuna'],
                                             $tablaClienteBBDD['ciudad'],
                                             $tablaClienteBBDD['telefono'],
                                             $tablaClienteBBDD['email']);

                $listarClientes[]=$clienteSelect;
            }

            if (count($listarClientes) > 0) {
                return $listarClientes[0];
            }else{
                return "La consulta no devuelve registros";
            }
        } catch (PDOException $pe) {
            return $pe->getMessage();
        }
    }


?>