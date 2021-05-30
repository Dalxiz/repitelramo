<?php 


                    
                        if (isset( $_SESSION['libro'])) {
                            foreach ( $_SESSION['libro'] as $encabezado) {
                                

                    ?>
                    <tr>
                        <td><?php echo $encabezado->getFolioDoc();?></td>
                        <td><?php echo $encabezado->getTipoDoc()->getNombreTipoDoc(); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($encabezado->getFechaEmision())); //Formatear fecha ?></td>
                        <td><?php echo $encabezado->getCliente()->getNombRazonSocial() ?></td>
                        <td><?php echo number_format ($encabezado->getNeto(), 0, ",", ".")//number_format para poner separador de miles ?></td>
                        <td><?php echo str_replace(",00", "", number_format ($encabezado->getIva(), 2, ",", "." ) ) //str_replace para no mostrar ,00 innceesarios?></td> 
                        <td><?php echo number_format ( $encabezado->getTotal(), 0, ",", "." ) ?></td>          


                        <td>
                            <div style="min-width : 136px">
                            <button type="button" class="btn btn-success facturainfo" data-folio='<?php echo $encabezado->getFolioDoc();?>' data-tipo-doc='<?php echo $encabezado->getTipoDoc()->getIdTipoDoc(); ?>'><i class="bi bi-eye-fill"></i></button>                                
                            </div>
                        </td>
                    </tr>

                
                    <?php   }
                    $_SESSION['libro']=null;
                        }else{ ?>
                        <tr><td colspan=8 class='text-center'><span class='glyphicon glyphicon-plus'></span>&nbsp;No existen facturas registradas</td></tr> 
<?php   } ?>    