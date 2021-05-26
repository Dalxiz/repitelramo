<?php
    if(isset($_POST['registrar']))
        { 
            require_once '../entidades/empresa.php';
            require_once '../persistencia/daoEmpresa.php';

            $rutEmp = $_POST['rutEmp'];
            $dvEmpresa = $_POST['dvEmpresa'];
            $razonSocial = $_POST['razonSocial'];
            $giroEmpresa = $_POST['giroEmpresa'];

            $nuevaEmpresa = new Empresa($rutEmp, $dvEmpresa,  $razonSocial, $giroEmpresa);

            //header("Location: ../presentacion/alumno/registrar.php?msj=" . registrarAlumno($nuevoAlumno) . " [Alumno: " . $nuevoAlumno->getNombreCompleto() . "]");
            $mensaje = insertarEmpresa($nuevaEmpresa);
            echo $mensaje;

            die();    
        }
        elseif(isset($_POST['actualizar']))
        { 
            require_once '../entidades/empresa.php';
            require_once '../persistencia/daoEmpresa.php';

            $rutEmp = $_POST['rutEmp'];
            $dvEmpresa = $_POST['dvEmpresa'];
            $razonSocial = $_POST['razonSocial'];
            $giroEmpresa = $_POST['giroEmpresa'];

            $nuevaEmpresa = new Empresa($rutEmp, $dvEmpresa,  $razonSocial, $giroEmpresa);

            //header("Location: ../presentacion/alumno/actualizar.php?msj=" . actualizarAlumno($nuevoAlumno) . " [Alumno: " . $nuevoAlumno->getNombreCompleto() . "]");
            $mensaje = actualizarEmpresa($nuevaEmpresa);
            echo $mensaje;

            die();    
        }

        function getTodasLasEmpresas(){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/persistencia/daoEmpresa.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/repitelramo/entidades/empresa.php";
    
            $lista = consultarEmpresa();
            
            return $lista;
    }

    ?>