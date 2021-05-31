$('#consulta').click(function(){
        
       var fecha=$("#fecha").val();
        // AJAX request
        $.ajax({
            url: '/repitelramo/controlador/controladorEncabezadoDocumento.php',
            type: 'post',
            data: {consulta: "consulta", fecha:fecha},
            success: function(response){ 
                // Add response in Modal body
                $('#resultado').html(response);
            
            }
        });
    });