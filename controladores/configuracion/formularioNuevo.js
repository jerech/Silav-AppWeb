var NuevaConfiguracion = {

	init: function(){
   
   	urlNuevo = "configuracion/nuevo.php";
   	urlModificar = "configuracion/modificar.php";  

    $("#formulario-configuracion").bootstrapValidator({
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
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'El nombre es requerido'
                        }
                    }
                },
                direccion: {
                    validators: {
                        notEmpty: {
                            message: 'La direccion es requerida'
                        }
                    }
                  },
                pais: {
                    validators: {
                        notEmpty: {
                            message: 'El pais es requerido'
                        }
                    }
                  },
                  departamento: {
                    validators: {
                        notEmpty: {
                            message: 'El departamento es requerido'
                        }
                    }
                  },
                  provincia: {
                    validators: {
                        notEmpty: {
                            message: 'La provincia es requerida'
                        }
                    }
                  },
                  ciudad: {
                    validators: {
                        notEmpty: {
                            message: 'La ciudad es requerida'
                        }
                    }
                }
              }
              });

    $("#btnGuardar").click(function(){
        $("#formulario-configuracion").data('bootstrapValidator').validate();
        if($("#formulario-configuracion").data('bootstrapValidator').isValid() == true){
          guardarDatos();
        }

     });
       
    /*$("#btnModificar").click(function(){
      $("#formulario-automovil").data('bootstrapValidator').validate();
        if($("#formulario-automovil").data('bootstrapValidator').isValid() == true){
          guardarDatos();
        }
                
    });*/

   
    function guardarDatos(){
        var url;
        var form = $(".form").serialize();
  
        url = urlModificar;
        form += "&id=1";//Aca va el numero de la agencia
        

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
                notificacion("success", "Configuracion guardada correctamente");
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