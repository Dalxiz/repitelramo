//Función que se ejecuta al mostar el modal.
$('#modalProd').on('show.bs.modal', function (e) {
    var opener=e.relatedTarget;//Esta var tiene el elemento que llamó al modal (osea el botón correspondiente)

    //Obtenemos los valores de los atributos definidos con data-*

    /* MANERA 1:
    var prodId=$(opener).attr('data-prod-id');
    var prodDesc=$(opener).attr('data-prod-des');
    var prodUM=$(opener).attr('data-prod-um');
    var prodPrecio=$(opener).attr('data-prod-precio');
    */

    /* MANERA 2: */
    var prodId=$(opener).data('prod-id');
    var prodDesc=$(opener).data('prod-des');
    var prodUM=$(opener).data('prod-um');
    var prodPrecio=$(opener).data('prod-precio');
    var txtTituloModal=$(opener).data('prod-accion')

    //Ahora ponemos los valores de la fila a los campos del form del modal
    $('#formProd #txtCodProd').val(prodId);
    $('#formProd').find('[id="txtDescripcion"]').val(prodDesc);
    $('#formProd').find('[id="cbxUnidadMedida"]').val(prodUM);
    $('#formProd').find('[id="txtPrecioUnitario"]').val(prodPrecio);
    $('#txtTituloModal').text(txtTituloModal);

    //Segun el modal abierto, los atributos cambian:
    if(txtTituloModal == "Nuevo Producto"){
        //Condición de disabled o readonly
        $('#txtCodProd').attr("readonly", false);
        $('#txtDescripcion').attr("readonly", false);
        $('#cbxUnidadMedida').attr("disabled", false);
        $('#txtPrecioUnitario').attr("readonly", false);

        $('#btnAccion').attr("name", "registrar");  //name para Post
        $('#cbxUnidadMedida').val('') //ComboBox se selecciona opción con valor vacío
        $('#btnAccion').text("Registrar"); //Texto Botón
        $('#formProd label').attr("hidden",true); 
        $('#btnAccion').attr("class", "btn btn-dark col-lg-12");

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-bookmark-plus-fill"); 
    }

    else if (txtTituloModal == "Actualizar Producto"){
        $('#txtCodProd').attr("readonly", true);
        $('#txtDescripcion').attr("readonly", false);
        $('#cbxUnidadMedida').attr("disabled", false);
        $('#txtPrecioUnitario').attr("readonly", false);
        
        $('#btnAccion').attr("name", "actualizar");
        $('#btnAccion').text("Actualizar");
        $('#btnAccion').attr("class", "btn btn-dark col-lg-12");
        $('#formProd label').removeAttr('hidden'); 

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-pencil-square"); 

        $('#formProd #lblEliminar').attr("hidden",true); 
    }

    else if (txtTituloModal == "Eliminar Producto"){
        $('#txtCodProd').attr("readonly", true);
        $('#txtDescripcion').attr("readonly", true);
        $('#cbxUnidadMedida').attr("disabled", true);
        $('#txtPrecioUnitario').attr("readonly", true);

        $('#btnAccion').attr("name", "eliminar");
        $('#btnAccion').text("Eliminar");
        $('#btnAccion').attr("class", "btn btn-danger col-lg-12");
        $('#formProd label').removeAttr('hidden'); 

        //Icono del modal
        $('#iconoModal').attr("class","bi bi-x-octagon-fill"); 

        $('#formProd #lblEliminar').removeAttr("hidden"); 
    }

    });