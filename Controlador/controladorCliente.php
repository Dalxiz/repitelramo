<?php 

    if (isset($_POST['registrar'])) {
        
        require_once '../entidades/clientes.php';        
        require_once '../persistencia/daoClientes.php';

        $rutCliente = $_POST['Rut'];
        $dvcliente = $_POST['Dv'];
        $nombRazonSocial = $_POST['Razon'];
        $giroCliente = $_POST['Giro'];
        $direccion = $_POST['Direccion'];
        $comuna = $_POST['Comuna'];
        $ciudad = $_POST['Ciudad'];
        $telefono = $_POST['Telefono'];
        $email = $_POST['Email'];

        $nuevoCliente = new cliente($rutCliente, $dvcliente, $nombRazonSocial, $giroCliente, $direccion, $comuna, $ciudad, $telefono, $email);

        $mensaje = registrarCliente($nuevoCliente);

        header("Location: ../presentacion/cliente/principalCliente.php?msj=". $mensaje);

        die();

    }elseif (isset($_POST['modificar'])) {

        require_once '../entidades/clientes.php';
        require_once '../persistencia/daoClientes.php';

        $rutCliente = $_POST['Rut'];
        $dvcliente = $_POST['Dv'];
        $nombRazonSocial = $_POST['Razon'];
        $giroCliente = $_POST['Giro'];
        $direccion = $_POST['Direccion'];
        $comuna = $_POST['Comuna'];
        $ciudad = $_POST['Ciudad'];
        $telefono = $_POST['Telefono'];
        $email = $_POST['Email'];

        $nuevoCliente = new cliente($rutCliente,$dvcliente,$nombRazonSocial,$giroCliente,$direccion,$comuna,$ciudad,$telefono,$email);

        $mensaje = modificarCliente($nuevoCliente);

        header("Location: ../presentacion/cliente/principalCliente.php?msj=". $mensaje);

    }elseif (isset($_POST['eliminar'])) {
        
        require_once '../entidades/clientes.php';
        require_once '../persistencia/daoClientes.php';

        $rutCliente = $_POST['Rut'];
        $dvcliente = $_POST['Dv'];
        $nombRazonSocial = $_POST['Razon'];
        $giroCliente = $_POST['Giro'];
        $direccion = $_POST['Direccion'];
        $comuna = $_POST['Comuna'];
        $ciudad = $_POST['Ciudad'];
        $telefono = $_POST['Telefono'];
        $email = $_POST['Email'];

        $cliente = new cliente($rutCliente,$dvcliente,$nombRazonSocial,$giroCliente,$direccion,$comuna,$ciudad,$telefono,$email);

        $mensaje=eliminarCliente($cliente);
        
        header("Location: ../presentacion/cliente/principalCliente.php?msj=". $mensaje);

        die();
    }

    function getTodosLosClientes(){
        require_once '../../persistencia/daoClientes.php';
        require_once '../../entidades/clientes.php';

        $lista = consultarCliente();

        return $lista;
    }

    

?>