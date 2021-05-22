$(document).ready(function() {
    $('#example').DataTable({
        "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
            }
    });
    });

    $('#modalEditar').on('show.bs.modal', function (e) {
        //A penas se habrá el modal la infomraicon se carga
        var opener=e.relatedTarget;//Esto tiene el elemento que llamó al modal (osea el botón correspondiente)
        
        //Obtenemos los valores de los atributos definidos
               
        /* MANERA 2: */
        var clRut=$(opener).data('rut');
        var clDv=$(opener).data('dv');
        var clRazon=$(opener).data('razon');        
        var clGiro=$(opener).data('giro');
        var clDireccion=$(opener).data('direccion');
        var clComuna=$(opener).data('comuna');
        var clCiudad=$(opener).data('ciudad');
        var clTelefono=$(opener).data('telefono');
        var clEmail=$(opener).data('email');

        //Ahora ponemos los valores a los campos del form
        $('#txtRut').val(clRut);
        $('#txtDv').val(clDv);
        $('#txtRazon').val(clRazon);
        $('#txtGiro').val(clGiro);
        $('#txtDireccion').val(clDireccion);
        $('#txtComuna').val(clComuna);
        $('#txtCiudad').val(clCiudad);
        $('#txtTelefono').val(clTelefono);
        $('#txtEmail').val(clEmail);        
    });

    $('#modalEliminar').on('show.bs.modal', function (e) {
        //A penas se habrá el modal la infomraicon se carga
        var opener=e.relatedTarget;//Esto tiene el elemento que llamó al modal (osea el botón correspondiente)
        
        //Obtenemos los valores de los atributos definidos
               
        /* MANERA 2: */
        var clRut=$(opener).data('rut');
        var clDv=$(opener).data('dv');
        var clRazon=$(opener).data('razon');        
        var clGiro=$(opener).data('giro');
        var clDireccion=$(opener).data('direccion');
        var clComuna=$(opener).data('comuna');
        var clCiudad=$(opener).data('ciudad');
        var clTelefono=$(opener).data('telefono');
        var clEmail=$(opener).data('email');

        //Ahora ponemos los valores a los campos del form
        
        $('#modalEliminar #txtRut').val(clRut);
        $('#modalEliminar #txtDv').val(clDv);
        $('#modalEliminar #txtRazon').val(clRazon);
        $('#modalEliminar #txtGiro').val(clGiro);
        $('#modalEliminar #txtDireccion').val(clDireccion);
        $('#modalEliminar #txtComuna').val(clComuna);
        $('#modalEliminar #txtCiudad').val(clCiudad);
        $('#modalEliminar #txtTelefono').val(clTelefono);
        $('#modalEliminar #txtEmail').val(clEmail);        
    });
