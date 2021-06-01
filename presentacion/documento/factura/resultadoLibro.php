<?php 
    if (isset( $_SESSION['libro']) && count($_SESSION['libro']) > 0) {
        $totalMes = 0;
        foreach ( $_SESSION['libro'] as $encabezado) {
            $totalMes += $encabezado->getTotal();

?>
    <tr>
        <td><?php echo $encabezado->getFolioDoc();?></td>
        <td><?php echo $encabezado->getTipoDoc()->getNombreTipoDoc(); ?></td>
        <td style="min-width: 100px"><?php echo date("d-m-Y", strtotime($encabezado->getFechaEmision())); //Formatear fecha ?></td>
        <td><?php echo $encabezado->getCliente()->getNombRazonSocial() ?></td>
        <td><?php echo number_format ($encabezado->getNeto(), 0, ",", ".")//number_format para poner separador de miles ?></td>
        <td><?php echo str_replace(",00", "", number_format ($encabezado->getIva(), 2, ",", "." ) ) //str_replace para no mostrar ,00 innceesarios?></td> 
        <td><?php echo number_format ( $encabezado->getTotal(), 0, ",", "." ) ?></td>          

    </tr>

                
<?php   } ?>
    <tr>
    <td  class="text-right" colspan=6><strong>Total del mes</strong></td>   
    <td> <?php echo number_format ( $totalMes, 0, ",", ".") ?></td>
    </tr>

    
    <?php $_SESSION['libro']=null;
    }else{ ?>
    <tr><td colspan=7 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen facturas emitidas para el mes seleccionado</td></tr> 
<?php   } ?>    
