var NuevoAdministrador = {
 
		
    init: function(){

			urlSecciones = "secciones/obtenerTodas.php";
            urlNuevo = "administradores/nuevo.php";
            urlModificar = "administradores/modificar.php";

            //Se declaran las caracteristicas del validador de formulario
            $("#formulario-perfil").bootstrapValidator({
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
                            apellido: {
                                validators: {
                                    notEmpty: {
                                        message: 'El apellido es requerido'
                                    }
                                }
                              },
                            usuario: {
                                validators:{
                                    notEmpty: {
                                        message: 'El usuario es requerido'
                                    }
                                }
                            }
                        }
                    });

            setSeccionesPadreListener = function(){
                $(".control-label input:checkbox").click(function(e){
                    if($(this).is(':checked')){                     
                        $(this).closest(".control-group").find(".control").show();
                    }else{                      
                        $(this).closest(".control-group").find(".control").hide();
                        $(this).closest(".control-group").find(".control input:checkbox").each(function(i,v){
                            if($(this).is(':checked')){
                                $(this).click();                                
                            }
                        });                 
                    }                   
                }); 
            };  

			$.ajax({
					type: 'post',
                    url: urlSecciones, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        $("#secciones").text("");
                    },   
                    success: function(data) {

                    	var grupo = "";
                        $(data.secciones).each(function(index){
                            if(parseInt(data.secciones[index].idPadre) === 0){
                                if(grupo !== ""){
                                        grupo += '</div>';
                                        grupo += '</div>';
                                        grupo += '</div>';
                                        grupo += '</div>';
                                }
                                grupo += '<div class="row">';
                                grupo += '<div class="col-md-4">';
                                grupo += '<div class="control-group">';
                                grupo += '<label class="control-label"><b>';
                                grupo += data.secciones[index].nombre;
                                grupo += ' </b><input name="chkPermiso[]" type="checkbox" id="'+data.secciones[index].id+'" value="' + data.secciones[index].id + '"/>';
                                grupo += '</label>';
                                grupo += '<div class="control">';  
                            }else{
                                grupo += '<label class="control-label">';
                                grupo += '<input name="chkPermiso[]" id="'+data.secciones[index].id+'" type="checkbox" value="' + data.secciones[index].id + '"/> ';
                                grupo += '&nbsp;'+data.secciones[index].nombre;
                                grupo += '</label>';    
                            }                                               
                        });

                        grupo += '</div>';
                        grupo += '</div>';
                        grupo += '</div>';
                        grupo += '</div>';
                        
                        $("#secciones").append(grupo);                  
                    

                        $("#secciones .control").each(function(i,v){                           
                            $(this).hide();                         
                        });     
                        setSeccionesPadreListener();        	            			
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});

            

            $("#btnGuardar").click(function(){
                    $("#formulario-perfil").data('bootstrapValidator').validate();
                    if($("#formulario-perfil").data('bootstrapValidator').isValid() == true){
                      guardarDatos();
                    }
                    

                });

            $("#btnModificar").click(function(){
                    $("#formulario-perfil").data('bootstrapValidator').validate();
                    if($("#formulario-perfil").data('bootstrapValidator').isValid() == true){
                      guardarDatos();
                    }

                });


            function guardarDatos(){

                var contrasenia = $("#contrasenia").val();
                    var reContrasenia = $("#re-contrasenia").val();

                    var contraseniaEncriptada = hex_md5(contrasenia);
                    $("#contrasenia-encriptada").val(contraseniaEncriptada);
                    var reContraseniaEncriptada = hex_md5(reContrasenia);
                    $("#re-contrasenia-encriptada").val(reContraseniaEncriptada);

                    $("#contrasenia").val("");
                    $("#re-contrasenia").val("");

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
                            var datos = data.split("_");
                            if(datos[0] != "OK"){
                                notificacion("error",data);      
                            }else{
                                notificacion("success", "Administrador guardado correctamente");
                                $(".form-control").val('');
                                $(".control-group input:checkbox").prop("checked",false);
                                $(".control").hide()
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