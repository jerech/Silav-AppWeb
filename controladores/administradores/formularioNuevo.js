var NuevoAdministrador = function(){
	return{


		init: function(){

			urlSecciones = "secciones/obtenerTodas.php";

			$.ajax({
					type: 'post',
                    url: urlSecciones, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        $("#secciones").text("");
                    },   
                    success: function(data) {
                    	var htmlPermisos = "";
                    	$(data.secciones).each(function(index){
                    		if(parseInt(data.secciones[index].idPadre) === 0){
                                htmlPermisos += '<br>';
                    			htmlPermisos += '<div class="row">';        			
                    			htmlPermisos += '<div class="col-md-4">';
                    			htmlPermisos += '<label><b>';
                    			htmlPermisos += data.secciones[index].nombre;
                    			htmlPermisos += '</b></label>';
                    			htmlPermisos += '</div>';
                    			htmlPermisos += '<div class="col-md-4">'
                    			htmlPermisos += '<input type="checkbox" class="checkbox-permiso" checked id="'+data.secciones[index].id+'" name="permisos">';
                    			htmlPermisos += '</div>';
                    		    htmlPermisos += '<div class="row" name="subpermisos">';
                                htmlPermisos += '<div class="col-md-4">';
                    		}else{   			
                                htmlPermisos += '<input type="checkbox" name="subpermiso[]">';
                    			htmlPermisos += '<label>';
                    			htmlPermisos += '&nbsp;'+data.secciones[index].nombre;
                    			htmlPermisos += '</label>';       			

                    		}
                            htmlPermisos += '</div>';
                    		htmlPermisos += '</div>';
                    		htmlPermisos += '</div>';
                    		htmlPermisos += '<br>';
                    		

                    	});
                        $("#secciones").html(htmlPermisos);	 
                        $("[name=permisos]").bootstrapSwitch();      

                        inicializarSwitchPermisos();     	            			
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});

            inicializarSwitchPermisos = function(){ 
                $('input[name="permisos"]').on('switchChange.bootstrapSwitch', function () {
                    var idSeccion = $(this).attr("id");
                    alert(idSeccion);
                    $("div[name=subpermisos]").hide();
                });
            }

		}
	};
}();