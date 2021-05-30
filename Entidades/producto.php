<?php 

    require_once 'unidadMedida.php';
    class Producto{

        private $codProd;
        private $descripcion;
        private $unidadMedida;
        private $precioUnitario;

        function __construct($codProd,$descripcion,UnidadMedida $unidadMedida,$precioUnitario){
            $this->codProd=$codProd;
            $this->descripcion=$descripcion;
            $this->unidadMedida=$unidadMedida;
            $this->precioUnitario=$precioUnitario;
        }

        function getCodProd(){
            return $this->codProd;
        }

        function getDescripcion(){
            return $this->descripcion;
        }

        function getUnidadMedida(){
            return $this->unidadMedida;
        }

        function getPrecioUnitaro(){
            return $this->precioUnitario;
        }
    }

?>