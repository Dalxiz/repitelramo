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

    //Ahora ponemos los valores a los campos del form
    
    $('#modalEliminar #txtRutEl').val(clRut);
    $('#modalEliminar #txtDvEl').val(clDv);
    $('#modalEliminar #txtRazonEl').val(clRazon);

});

//Habilitar Tooltip de boostrap
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

