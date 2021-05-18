<?php 

    function insertarEmpresa(Empresa $newEmpresa){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query->$conn->prepare("INSERT INTO EMPRESA (RUTEMP,DVEMPRESA,RAZONSOCIALEMP,GIROEMP)
                                 VALUES (?, ?, ?, ?)");

            $result = $query->execute([$newEmpresa->getRutEmp(),
                                       $newEmpresa->getDvEmp(),
                                       $newEmpresa->getRazonEmp(),
                                       $newEmpresa->getGiroEmp()]);

            if ($result) {
                return'ok';
            }else {
                return 'err';
            }
        } catch (PDOException $pe) {
            return "err : " . $pe->getMessage();
        }
    }

    function actualizarAlumno(Alumno $nuevoAlumno){

        require_once 'parametrosBD.php';


        try{
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryUpdate = $conn->prepare("UPDATE EMPRESA SET dvEmp=:dvEmp, razonEmp=:razonEmp, giroEmp=:giroEmp
                                         WHERE rutEmp=:rutEmp");

            $queryUpdate->bindValue("rutEmp", $newEmpresa->getRutEmp());
            $queryUpdate->bindValue("dvEmp", $newEmpresa->getDvEmp());
            $queryUpdate->bindValue("razonEmp", $newEmpresa->getRazonEmp());
            $queryUpdate->bindValue("giroEmp", $newEmpresa->getGiroEmp());


            $resultado = $queryUpdate->execute();
            
            if($resultado)
            {
                return "ok";
            }
            else
            {
                return "err";
            }

        }
        catch(PDOException $pe)
        {
            return "err : " . $pe->getMessage();
        }

    }

?>