<?php 

    function insertarEmpresa(Empresa $newEmpresa){

        require_once 'parametrosBD.php';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos",$usuario,$password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query=$conn->prepare("INSERT INTO EMPRESA (RUTEMP,DVEMP,RAZONSOCIALEMP,GIROEMP)
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

    function actualizarEmpresa(Empresa $newEmpresa){

        require_once 'parametrosBD.php';


       try{
           $conn = new PDO("mysql:host=$host;dbname=$nombreBaseDatos", $usuario,$password);

           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryUpdate = $conn->prepare("UPDATE EMPRESA SET dvEmp=:dvEmp, razonSocialEmp=:razonEmp, giroEmp=:giroEmp
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


    function consultarEmpresa(){

        require 'parametrosBD.php';
        
        try
        {
            $conexion = new PDO("mysql:host=$host;dbname=$nombreBaseDatos;charset=UTF8", $usuario, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $listaEmpresas=[];

            $querySelect = $conexion->query("SELECT * FROM EMPRESA");

            foreach($querySelect->fetchAll() as $tablaEmprBBDD)
            {

                //$unidadMedida = consultarUMPorId($tablaEmprBBDD['idUM']);

                $empresaSel= new Empresa($tablaEmprBBDD['rutEmp'], $tablaEmprBBDD['dvEmp'],
                $tablaEmprBBDD['razonSocialEmp'], $tablaEmprBBDD['giroEmp']);

                $listaEmpresas[]=$empresaSel; //1,2,3,4,5,6,7,
            }

            if(count($listaEmpresas) > 0){
                return $listaEmpresas;
            }else{
                return ($lista=[]);
            }
        }
        catch(PDOException $pe)
        {
            return $pe->getMessage();

        }
    }

?>