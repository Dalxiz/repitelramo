<?php 

    require_once 'encabezadoDocumento.php';
    require_once 'producto.php';

    class DetalleDocumento{

        private $idDetalle;
        private $encabezadoDocumento;
        private $producto;
        private $precioUnitario;
        private $cantUnitaria;
        private $descuento;
        private $valor;

        function __construct($idDetalle, EncabezadoDocumento $encabezadoDocumento, Producto $producto,$precioUnitario,$cantUnitaria,$descuento,$valor){
            $this->idDetalle=$idDetalle;
            $this->encabezadoDocumento=$encabezadoDocumento;
            $this->producto=$producto;
            $this->precioUnitario=$precioUnitario;
            $this->cantUnitaria=$cantUnitaria;
            $this->descuento=$descuento;
            $this->valor=$valor;
        }        

        function getIdDetalle(){
            return $this->idDetalle;
        }

        function getEncabezadoDocumento(){
            return $this->encabezadoDocumento;
        }

        function getProducto(){
            return $this->producto;
        }

        function getPrecioUnitario(){
            return $this->precioUnitario;
        }

        function getCantUnitaria(){
            return $this->cantUnitaria;
        }

        function getDescuento(){
            return $this->descuento;
        }

        function getValor(){
            return $this->valor;
        }
    }

?>