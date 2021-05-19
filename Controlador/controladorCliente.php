<?php 

    if (isset($_POST['registrar'])) {
        
        require_once '../Entidades/clientes.php';
        require_once '../Persitencia/daoClientes.php';

        $rutCliente = $_POST[''];
        $dvcliente = $_POST[''];
        $nombRazonSocial = $_POST[''];
        $giroCliente = $_POST[''];
        $direccion = $_POST[''];
        $comuna = $_POST[''];
        $ciudad = $_POST[''];
        $telefono = $_POST[''];
        $email = $_POST[''];

        $nuevoCliente = new cliente($rutCliente,$dvcliente,$nombRazonSocial,$giroCliente,$direccion,$comuna,$ciudad,$telefono,$email);

        $mensaje = registrarCliente($nuevoCliente);

        echo $mensaje;

        die();
    }elseif (isset($_POST['modificar'])) {

        require_once '../Entidades/clientes.php';
        require_once '../Persitencia/daoClientes.php';

        $rutCliente = $_POST[''];
        $dvcliente = $_POST[''];
        $nombRazonSocial = $_POST[''];
        $giroCliente = $_POST[''];
        $direccion = $_POST[''];
        $comuna = $_POST[''];
        $ciudad = $_POST[''];
        $telefono = $_POST[''];
        $email = $_POST[''];

        $nuevoCliente = new cliente($rutCliente,$dvcliente,$nombRazonSocial,$giroCliente,$direccion,$comuna,$ciudad,$telefono,$email);

        $mensaje = modificarCliente($nuevoCliente);

        echo $mensaje;
    }

    

?>