<?php 

    if (isset($_POST['registrar'])) {
        
        require_once '../Entidades/clientes.php';        
        require_once '../Persistencia/daoClientes.php';

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

        echo $mensaje;

        die();

    }elseif (isset($_POST['modificar'])) {

        require_once '../Entidades/clientes.php';
        require_once '../Persistencia/daoClientes.php';

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

        echo $mensaje;

    }elseif (isset($_POST['eliminar'])) {
        
        require_once '../Entidades/clientes.php';
        require_once '../Persistencia/daoClientes.php';

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
        
        echo $mensaje;
    }

    function getTodosLosClientes(){
        require_once '../../Persistencia/daoClientes.php';
        require_once '../../Entidades/clientes.php';

        $lista = consultarCliente();

        return $lista;
    }

    

?>