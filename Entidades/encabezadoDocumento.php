<?php 

    require_once 'usuario.php';
    require_once 'empresa.php';
    require_once 'clientes.php';

    class EncabezadoDocumento{

        private $usuario;//clave foranea de usuario
        private $empresa;// clave foranea empresa
        private $tipoDoc;
        private $folioDoc;
        private $fechaEmision;
        private $cliente;// clave foranea cliente
        private $condPago;
        private $estadoDoc;
        private $neto;
        private $iva;
        private $total;
        private $observaciones;
        private $canceladoPor;
        private $listaDetalles = [];

        function __construct(Usuario $usuario,Empresa $empresa,TipoDocumento $tipoDoc,$folioDoc,$fechaEmision, Cliente $cliente,$condPago,$estadoDoc,$neto,$iva,$total,$observaciones,$canceladoPor){
            $this->usuario=$usuario;
            $this->empresa=$empresa;
            $this->tipoDoc=$tipoDoc;
            $this->folioDoc=$folioDoc;
            $this->fechaEmision=$fechaEmision;
            $this->cliente=$cliente;
            $this->condPago=$condPago;
            $this->estadoDoc=$estadoDoc;
            $this->neto=$neto;
            $this->iva=$iva;
            $this->total=$total;
            $this->observaciones=$observaciones;
            $this->canceladoPor=$canceladoPor;
            $this->listaDetalles = [];
        }

        function getUsuario(){
            return $this->usuario;
        }

        function getEmpresa(){
            return $this->empresa;
        }

        function getTipoDoc(){
            return $this->tipoDoc;
        }

        function getFolioDoc(){
            return $this->folioDoc;
        }

        function getFechaEmision(){
            return $this->fechaEmision;
        }

        function getCliente(){
            return $this->cliente;
        }

        function getCondPago(){
            return $this->condPago;
        }

        function getEstadoDoc(){
            return $this->estadoDoc;
        }

        function getNeto(){
            return $this->neto;
        }

        function getIva(){
            return $this->iva;
        }
        
        function getTotal(){
            return $this->total;
        }

        function getObservaciones(){
            return $this->observaciones;
        }

        function getCanceladoPor(){
            return $this->canceladoPor;
        }

        function getListaDetalles(){
            return $this->listaDetalles;
        }

        function addNuevoDetalle(DetalleDocumento $detalle){
            $this->listaDetalles[]=$detalle;
        }

        function addVariosDetalles(array $detalle){
            $this->listaDetalles=$detalle;
        }
    }

?>