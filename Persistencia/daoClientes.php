<?php 

    function registrarCliente(Clientes $nuevoClientes){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("INSERT INTO CLIENTE (RUTCLIENTE,DVCLIENTE,NOMB_RAZONSOCIAL,GIRO,DIRECCION,COMUNA,CIUDAD,TELEFONO,EMAIL)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $query->execute([$nuevoClientes->getRutCliente,
                                        $nuevoClientes->getDvCliente,
                                        $nuevoClientes->getNombRazonSocial,
                                        $nuevoClientes->getGiroCliente,
                                        $nuevoClientes->getDireccion,
                                        $nuevoClientes->getComuna,
                                        $nuevoClientes->getCiudad,
                                        $nuevoClientes->getTelefono,
                                        $nuevoClientes->getEmail]);    

            if ($result) {
                return 'ok';
            }else {
                return 'err';
            }
            
        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

    
    function actualizaCliente(Clientes $nuevoClientes){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("UPDATE CLIENTES SET dvCliente=:dvCliente, nombRazonSocial=:nombRazonSocial,
                                                         giroCliente=:giroCliente, direccion=:direccion, comuna=:comuna,
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
                return 'ok';
            }else {
                return 'err';
            }

        } catch (PDOException $pe) {
            return "err : ". $pe->getMessage();
        }
    }

?>