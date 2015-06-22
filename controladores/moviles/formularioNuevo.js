var NuevoMovil = {

	init: function(){
   
   	urlNuevo = "moviles/nuevo.php";
   	urlModificar = "moviles/modificar.php";  

    $("#formulario-automovil").bootstrapValidator({
      message: 'Este valor no es valido',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            submitHandler: function(validator, form, submitButton) {
                // Do nothing
            },
            fields: {
                numero: {
                    validators: {
                        notEmpty: {
                            message: 'El numero es requerido'
                        },
                        integer: {
                            message: 'Solo se admiten digitos'
                        }
                    }
                },
                patente: {
                    validators: {
                        notEmpty: {
                            message: 'La patente es requerida'
                        }
                    }
                  },
                vencseguro: {
                    validators:{
                        date:{
                          format: 'DD/MM/YYYY',
                          message: 'El formato es incorrecto'
                        }
                    }
                }
                }
              });

    $("#btnGuardar").click(function(){
        $("#formulario-automovil").data('bootstrapValidator').validate();
        if($("#formulario-automovil").data('bootstrapValidator').isValid() == true){
          guardarDatos();
        }

     });
       
    $("#btnModificar").click(function(){
      $("#formulario-automovil").data('bootstrapValidator').validate();
        if($("#formulario-automovil").data('bootstrapValidator').isValid() == true){
          guardarDatos();
        }
                
    });

   
    function guardarDatos(){
        var url;
        var form = $(".form").serialize();

        if(_id == 0){
          url = urlNuevo;
        }else{
          url = urlModificar;
          form += "&id="+_id;
        }

        $.ajax({
          type: 'post',
          url: url, 
          data: form,           
          dataType: 'html',
          beforeSend: function(){
              blockUI($(".main-content")); 
          },   
          success: function(data) {
              var datos = data;
              if(datos != "OK"){
                notificacion("error",data);      
              }else{
                notificacion("success", "Móvil guardado correctamente");
                $(".form-control").val('');
             }

             unblockUI($(".main-content"));
             

           },
           error: function(a,b,c){
              unblockUI($(".main-content"));
              console.log(a);
              console.log(b);
              console.log(c);         
           }
        });


    }
    

        
	}

  
}