function validarCampos(){
    var rutEmp = document.getElementById("txtRutEmp").value;
    var dvEmp = document.getElementById("txtDvEmpresa").value;
    var razonSocialEmp = document.getElementById("txtRazonSocial").value;
    var giroEmp = document.getElementById("txtGiroEmpresa").value;
    var accion = document.getElementById("btnAccion").getAttribute("name");

    if(rutEmp === "" || dvEmp === "" || razonSocialEmp === "" || giroEmp == ""){
        if( accion == "registrar"){
            alert("¡Debe rellenar todos los campos antes de ingresar una Empresa!");
        }
        else{
            alert("¡Debe rellenar todos los campos antes de actualizar una Empresa!");
        }
    }
}

  
//Función que se ejecuta al mostar el modal.
$('#modalEmp').on('show.bs.modal', function (e) {
    var opener=e.relatedTarget;//Esta var tiene el elemento que llamó al modal (osea el botón correspondiente)

    //Obtenemos los valores de los atributos definidos con data-*
    var rutEmp=$(opener).data('emp-rut'); 
    var dvEmp=$(opener).data('emp-dvemp');  
    var razonEmp=$(opener).data('emp-razonsocial'); 
    var giroEmp=$(opener).data('emp-giro');
    var accion=$(opener).data('emp-accion'); 
    var tituloModal=$(opener).data('emp-accion'); 

    //Ahora ponemos los valores de la fila a los campos del form del modal
    $('#formEmp #txtRutEmp').val(rutEmp);
    $('#formEmp #txtDvEmpresa').val(dvEmp);
    $('#formEmp #txtRazonSocial').val(razonEmp);
    $('#formEmp #txtGiroEmpresa').val(giroEmp);
    $('#tituloModal').text(tituloModal);

    //Segun el modal abierto, los atributos cambian:
    if(accion == "nueva"){
        //Condición de disabled o readonly
        $('#txtRutEmp').attr("readonly", false);
        $('#txtDvEmpresa').attr("readonly", false);
        $('#txtRazonSocial').attr("disabled", false);
        $('#txtGiroEmpresa').attr("readonly", false);

        $('#btnAccion').attr("name", "registrar");  //name para Post
        $('#tituloModal').text("Nueva Empresa");
        $('#cbxUnidadMedida').val('') //ComboBox se selecciona opción con valor vacío
        $('#btnAccion').text("Registrar"); //Texto Botón
        $('#formEmp label').attr("hidden",true); 
        $('#btnAccion').attr("class", "btn btn-dark col-lg-12");

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-bookmark-plus-fill"); 

        $('#formEmp .labelForm').attr("hidden",true); 
    }
    else if (accion == "actualizar"){
        $('#txtRutEmp').attr("readonly", true);
        $('#txtDvEmpresa').attr("readonly", false);
        $('#txtRazonSocial').attr("disabled", false);
        $('#txtGiroEmpresa').attr("readonly", false);
        
        $('#btnAccion').attr("name", "actualizar");
        $('#tituloModal').text("Actualizar Empresa");
        $('#btnAccion').text("Actualizar");
        $('#btnAccion').attr("class", "btn btn-dark col-lg-12");
        $('#formEmp label').removeAttr('hidden'); 

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-pencil-square"); 

    }
    else if (accion == "eliminar"){
        $('#txtRutEmp').attr("readonly", true);
        $('#txtDvEmpresa').attr("readonly", true);
        $('#txtRazonSocial').attr("disabled", true);
        $('#txtGiroEmpresa').attr("readonly", true);

        $('#btnAccion').attr("name", "eliminar");
        $('#tituloModal').text("Eliminar Empresa");
        $('#btnAccion').text("Eliminar");
        $('#btnAccion').attr("class", "btn btn-danger col-lg-12");
        $('#formEmp label').removeAttr('hidden'); 

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-x-octagon-fill"); 

    }

    });