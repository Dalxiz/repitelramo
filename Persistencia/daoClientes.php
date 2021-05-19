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
                return 'ok';
            }else {
                return 'err';
            }
            
        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

    
    function modificarCliente(Cliente $nuevoCliente){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("UPDATE CLIENTES SET dvCliente=:dvCliente, nombRazonSocial=:nombRazonSocial,
                                                         giroCliente=:giroCliente, direccion=:direccion, comuna=:comuna,
                                                         ciudad=:ciudad, telefono=:telefono, email=:email WHERE rutCliente=:rutCliente");
                                                         
            $queryUpdate->bindValue("rutCliente",$nuevoCliente->getRutCliente());
            $queryUpdate->bindValue( "dvCliente",$nuevoCliente->getDvCliente());
            $queryUpdate->bindValue("nombRazonSocial",$nuevoCliente->getNombRazonSocial());
            $queryUpdate->bindValue("giroCliente",$nuevoCliente->getGiroCliente());
            $queryUpdate->bindValue("direccion",$nuevoCliente->getDireccion());
            $queryUpdate->bindValue("comuna",$nuevoCliente->getComuna());
            $queryUpdate->bindValue("ciudad",$nuevoCliente->getCiudad());
            $queryUpdate->bindValue("telefono",$nuevoCliente->getTelefono());
            $queryUpdate->bindValue("email",$nuevoCliente->getEmail());    

            $resultado = $queryUpdate->execute();

            if ($resultado) {
                return 'ok';
            }else {
                return 'err';
            }

        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

?>