        var numFila = 1; //Contador de filas y para asigar un id unico
        var neto = 0; //Almacena el neto

        //Obtener el id del modal correspondiente
        function determinarTipoDeModal(tipoModal){
            if(tipoModal === "registrar"){
                return "#modalFact";
            }

            else if (tipoModal == "info"){
                return "#modalFactInfo";
            }
            else if (tipoModal == "actualizar"){
                return "#modalFactAct";
            }
            else{
                return "";
            }
        }

        //Permite que solo se puedan ingresar numeros y uso de ctrl+c y ctrl+v
        function validarNumeroEntero(e){
            if(!((e.keyCode > 95 && e.keyCode < 106) || (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8 || e.keyCode == 9 
                || e.ctrlKey == true || (e.ctrlKey == true && e.keyCode == 86) || (e.ctrlKey == true && e.keyCode == 67))) {
                return false;
            }
        }

        //Evento para evitar pegar datos no numericos en los textbxo que son exclusivo de numeros
        $('#txtPorcDesc, #txtCantidad').on('paste', function (event) {
            if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) { 
                event.preventDefault();
            }
        });


        //Carga Precio Unitario y Unidad de Medida a los txtbox segun producto elegido
        function cargaPrecioUnitYUM(accion){
            var tipoModal = determinarTipoDeModal(accion);
            var precioUn = $(tipoModal + ' #cbxProducto :selected').data("prod-precio");
            $(tipoModal + ' #txtPrecioUnitario').val(precioUn.toLocaleString("es-CL"));

            var um = $(tipoModal + ' #cbxProducto :selected').data("prod-um");
            $(tipoModal + ' #txtUnidadMedida').val(um);

        }

        //Función para agregar productos a la tabla
        function agregarProd(e){
            var tipoModal = determinarTipoDeModal(e);

            var prodSel = $(tipoModal + " #cbxProducto :selected").text(); 
            var idProdSel = $(tipoModal + " #cbxProducto :selected").val();
            var um = $(tipoModal + " #cbxProducto :selected").data("prod-um");
            var precioUn = $(tipoModal + " #cbxProducto :selected").data("prod-precio");
            var cantUn = parseInt($(tipoModal + " #txtCantidad").val());
            var descuento = parseInt($(tipoModal + " #txtPorcDesc").val());
            var total = (cantUn * precioUn);
            var valorDescuento = (total * descuento/100);
            total = Math.round(total - valorDescuento);

            //Para corroborar si ya existe el producto en la tabla
            var existe = (($(tipoModal + ' #tablaProd [name="idProd[]"]').parent(':contains(' + idProdSel + ')')).length);
            
            if(isNaN(descuento) || !(descuento >=0 && descuento <=100)){
                alert("¡El descuento debe ser entre 0 al 100% del producto!");
            }
            
            else if(idProdSel == "" || isNaN(cantUn) || cantUn <0 ){
                alert ("¡Debe seleccionar un producto y una cantidad para agregarlo!");
            }
            else if (existe >0){
                alert ("¡El producto seleccionado ya esta ingresado en la factura!")
            }

            else{
            //Agregar a la tabla:               
                $(tipoModal).find('tbody')
                .append($('<tr>')
                    .append($('<td class="text-center align-middle">')
                        .text(idProdSel)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'idProd[]')
                                .attr('id', 'idProd'+ numFila)
                                .attr('value', idProdSel)
                            
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(prodSel)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'nomProd[]')
                                .attr('id', 'nomProd'+ numFila)
                                .attr('value', prodSel)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(um)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'um[]')
                                .attr('id', 'um'+ numFila)
                                .attr('value', um)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(cantUn)
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'cantUn[]')
                                .attr('id', 'cantUn'+ numFila)
                                .attr('value', cantUn)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(precioUn.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'precioUn[]')
                                .attr('id', 'precioUn'+ numFila)
                                .attr('value', precioUn)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .text(descuento.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'desc[]')
                                .attr('id', 'desc'+ numFila)
                                .attr('value', descuento)
                        )
                        .append($('<span>')
                            .text("%")
                        )
                        .append($('<br><span>')
                            .text(" (" + valorDescuento.toLocaleString("es-CL") + ")")
                        )
                        
                    )
                    .append($('<td class="text-center align-middle" name="valorparacalculo">')
                        .text(total.toLocaleString("es-CL"))
                            .append($('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'valor[]')
                                .attr('id', 'valor'+ numFila)
                                .attr('value', total)
                        )
                    )
                    .append($('<td class="text-center align-middle">')
                        .append($('<button>')
                            .attr('class', 'btn btn-danger')
                            .attr('type', 'button')
                            .attr('onclick', 'eliminarProd(this, "' + tipoModal + '")')
                                .append($('<span>')
                                    .attr('class', 'bi bi-dash-circle-fill')
                                )
                        )
                    )
                )

                numFila++;

                //Limpiar campos
                $(tipoModal + " #cbxProducto").val('');
                $(tipoModal + " #txtPrecioUnitario").val('-');
                $(tipoModal + " #txtCantidad").val('');
                $(tipoModal + " #txtPorcDesc").val(0);

                //Calcular totales
                calcularTotales(tipoModal);
            }
        
        }

        function eliminarProd(e, tipoModal){
            //Removemos la fila correspondiente al botón de eliminar
            $(e).parent().parent().remove();
            calcularTotales(tipoModal);
        }
        
        //Se llama cada vez que se elmina o agrega un producto, calcula los totales
        function calcularTotales(tipoModal){
            neto=0;

            $(tipoModal + ' #tablaProd [name="valorparacalculo"]').each(function( index ) {
                neto = neto + parseInt($( this ).text().split('.').join("")); //Tomamos el texto, le sacamos los puntos y lo pasamos a numero
            });

            var iva = neto * 0.19;
            //Dejar iva con solo dos decimales cómo máximo
            iva = Math.round (iva * 100) / 100
            
            //Total sin decimales   
            var total = Math.round(iva+neto);

            //Para formatear por miles
            netoFor = neto.toLocaleString("es-CL");
            ivaFor = iva.toLocaleString("es-CL");
            totalFor = total.toLocaleString("es-CL");

            $(tipoModal + ' #txtNeto').val(netoFor);
            $(tipoModal + ' #txtIVA').val(ivaFor);
            $(tipoModal +' #txtTotal').val(totalFor);
        }

        //Enviar valores al modal de cambiar estado, segun sea anulacion o emisión
        $('#modalFactEstado').on('show.bs.modal', function (e) {
            var opener=e.relatedTarget;
            
            var idTipoDoc=$(opener).data('fact-tipodoc');
            var folioDoc=$(opener).data('fact-folio');
            var accion=$(opener).data('fact-accion');
        
            $('#emitirTipoDoc').val(idTipoDoc);
            $('#emitirFolio').val(folioDoc);


            if(accion == 'emitir'){
                $("#iconoModalEstado").attr("class", "bi bi-bookmark-check-fill");
                $("#txtTituloModalEstado").text("Emitir Factura");
                $("#divFechaEmision").removeAttr("hidden");
                $('#spanAccionEstado').text("emitir");
                $('#spanFolioEstado').text(folioDoc);
                $("#btnAccionEstado").text("Emitir");
                $("#btnAccionEstado").val("emitir");
                $("#btnAccionEstado").attr("class", "btn btn-success col-lg-12");
                $("#btnCancelarEstado").attr("class", "btn btn-danger col-lg-12");
                $("#txtNuevaFechaEmision").attr("required", "required");

            }

            else if(accion == 'anular'){
                $("#iconoModalEstado").attr("class", "bi bi-bookmark-x-fill");
                $("#txtTituloModalEstado").text("Anular Factura");
                $("#divFechaEmision").attr("hidden", true);
                $('#spanAccionEstado').text("anular");
                $('#spanFolioEstado').text(folioDoc);
                $("#btnAccionEstado").text("Anular");
                $("#btnAccionEstado").val("anular");
                $("#btnAccionEstado").attr("class", "btn btn-danger col-lg-12");
                $("#btnCancelarEstado").attr("class", "btn btn-info col-lg-12");
                $("#txtNuevaFechaEmision").removeAttr("required");
            }


        });

        //Al momento de hacer submit en nueva fact o actualizar, se saca disabled de combobox para poder enviar los datos correctamente
         $("#formFactNueva, #modalFactAct").submit(function (e){
            $("#formFactNueva #cbxTipoDoc, #modalFactAct #cbxTipoDoc").prop('disabled', false);
            $("#formFactNueva #cbxEstadoDoc, #modalFactAct #cbxEstadoDoc").prop('disabled', false);
            this.submit();
        });



        //Evento click sobre icono de información de factura, toma el folio-tipoDoc y se lo envia por ajax a traves de post al controlador.
        $('.factura-info').click(function(){
        
            var folio = $(this).data('folio');
            var idTipoDoc = $(this).data('tipo-doc');

            // AJAX request
            $.ajax({
                url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
                type: 'post',
                data: {folio: folio, idTipoDoc:idTipoDoc, cargarModal: "informacion"},
                success: function(response){ 
                    // Add response in Modal body
                    $('#modalFactInfo .modal-body').html(response);
                
                    // Display Modal
                    $('#modalFactInfo').modal('show'); 
                }
            });
        });
        
        //Eevnto click sobre actualizar.
        $('.factura-actualizar').click(function(){
        
            var folio = $(this).data('folio');
            var idTipoDoc = $(this).data('tipo-doc');

            // AJAX request
            $.ajax({
                url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
                type: 'post',
                data: {folio: folio, idTipoDoc:idTipoDoc, cargarModal: "actualizar"},
                success: function(response){ 
                    // Add response in Modal body
                    $('#modalFactAct .modal-body').html(response);
                
                    // Display Modal
                    $('#modalFactAct').modal('show'); 
                }
            });
        });
    
        //Evento click sobre libro factura
        $('.factura-libro').click(function(){
            
            // AJAX request
            $.ajax({
                url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
                type: 'post',
                data: {cargarModal: "libro"},
                success: function(response){ 
                    // Add response in Modal body
                    $('#modalLibro .modal-body').html(response);
                
                    // Display Modal
                    $('#modalLibro').modal('show'); 
                }
            });
        });
