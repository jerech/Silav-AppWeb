<?php
    session_start(); 

    if(in_array('ControlDePasajes', $_SESSION['sesion_permisos'])){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sistema SiLAV - Control De Pasajes</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sebastian" >

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../recursos/plugins/lib/font-awesome/css/font-awesome.css">
    <script src="http://openlayers.org/api/OpenLayers.js"></script>

    <script src="../recursos/plugins/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/noty.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/md5.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap-switch.css">
    <script type="text/javascript" src="../recursos/plugins/lib/bootstrap/js/bootstrap-switch.js"></script>
    <script src="../recursos/plugins/lib/jquery.blockui.js" type="text/javascript"></script>

    <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    
    <script src="cargarChoferes.js" type="text/javascript"></script>
    <script src="enviarPasaje.js" type="text/javascript"></script>
    <script src="cargarPasajesEnCurso.js" type="text/javascript"></script>
    <script src="cargarDatos.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>

    <script type="text/javascript">
	  var usuarioNombre = '<?php echo $_SESSION["sesion_usuario"]; ?>';
        function cerrar() {
        	
        	$.ajax({
                        type: 'POST',
                        url: '../controladores/usuarios/cerrarControlPasajesActivo.php',
                        data:{
									usuario: usuarioNombre
                        },
                        dataType: 'html',
                        success: function(data){
 
                        },
                        error: function(a,b,c){
                        }
                    });    	  
          
          window.close();
        }
        
    </script>
    
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/premium.css">

</head>
<body class=" theme-blue">

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
        html, body {
        	height: 100%;
        }
 
        #contenedor {
        	width: 60%;
        	position: absolute; 
        	top: 40%; 
        	left: 50%; 
        	transform: translate(-50%, -50%);
        }
        
        #contenedorFormulario	{

			 width: 100%;
			 height: 30%;		  	 
			margin: 0 auto;

        }
        .centrar {
				text-align:center;
				width: 16.5%;        
        }

    </style>

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-taxi"></span> SiLAV</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a onclick="cerrar();" href="#">
                    <b>Salir</b>      
                </a>

            
            </li>
          </ul>

        </div>
      
    </div>
    <div class="main-content">
                <div id="div-block">
			        <div class="panel panel-default" style="margin: 0 auto; width: 60%;">
			            <a href="#widget2container2" class="panel-heading" data-toggle="collapse">Despacho Pasajes </a>
			            <div id="widget2container2" class="panel-body collapse in" style=" width: 100%;margin:0 auto;">

			             <form id="formulario-pasajes" name="form" class="form">
                            <!--Fila donde va el switch-->                         
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="checkbox" checked id="tipo" name="tipo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

                            <!--Fila donde va la calle, lon, lat, y lbel con la info-->
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Dirección</label><input type="text" id="calle" onKeydown="Javascript: if(event.keyCode==18)EnviarPasaje.buscarCoordenadas();" placeholder="Calle Nro" name="calle" autocomplete="on" class="form-control">
                                        <br><label id="lbl-info-direccion" style="color:#2E64FE;" class="lbl-asignacion"></label><br>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                    <br><label>Lat: </label><label style="color:#2E64FE;" id="lbl-lat" class="lbl-asignacion"></label><br>
                                    <label>Lon: </label><label style="color:#2E64FE;" id="lbl-lon" class="lbl-asignacion"></label><br>
                                    <label><a id="abrirModalEdicionCoordenadas" href="javascript:;">Editar</a></label>
                                </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                        
                            </div>

                            <!--Fila donde va el chofer, movil, cliente-->
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Chofer</label>                    
                                        <input type="text" id="listaChoferes" name="listaChoferes" class="form-control">                  
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>M&oacute;vil</label><input style="width: 45px" type="text" readOnly id="movil" name="movil" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Cliente</label><input type="text" id="cliente" name="cliente" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

                            

			

										
						</form>
                        <!--Fila donde va el boton enviar-->
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-5">
                                    <div class="btn-toolbar list-toolbar">
                                        <button id="btnAsignar" name="btnAsignar" class="btn btn-primary" style="float: right; width: 100px;">Asignar</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

						
			            </div>
			            
			        </div>
                </div>
			        
    <div  style="margin: 2% auto; width: 90%;">

    <div class="panel panel-default">
    
        <div class="panel-heading" style="text-align:center;">Pasajes En Curso</div>
        <table class="table table-bordered table-first-column-check table-hover" id="tablaPasajes">
            <thead>
                <tr>
                    <th class="centrar">Fecha</th>
                    <th class="centrar">Direcci&oacute;n</th>
                    <th class="centrar">Cliente</th>
                    <th class="centrar">Chofer</th>
                    <th class="centrar">M&oacute;vil</th>
                    <th class="centrar">Estado</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>

</div>    
    			
    			</div>	
<div class="modal fade" id="ModaldeTabla">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                               <h4 class="modal-title">Lista de Choferes</h4>
                        </div>
                        
  <div class="modal-body" style="height: 400px; overflow: auto;">
   <table id="tablaModal" class="table">
  <thead>
    <tr>
      <th style="width: 4em;"></th>
      <th>Chofer</th>
      <th>M&oacute;vil</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
  </div>
                         <div class="modal-footer">
                              <button type="button" onclick="SeleccionarChofer.init()" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         </div>
                </div>
        </div>
</div>   

<!--<div class="modal fade" id="ModalEdicionCoordenadas">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                               <h3 class="modal-title">Edición de Coordenadas</h3>
                        </div>
                        
                          <div class="modal-body" style="height: 120px; overflow: auto;">
                            <p>Atención! A esta ubicación será enviado el pasaje.</p><br>
                           <input type="text" id="coordenadas" placeholder="Latitud,Longitud" style="width=350px;" name="coordenadas" class="form-control">
                          </div>
                         <div class="modal-footer">
                              <button type="button" onclick="EnviarPasaje.editarCoordenadas()" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         </div>
                </div>
        </div>
</div> 	-->
<!-- Seleccionar un punto en el mapa -->
<div class="modal fade" id="ModalEdicionCoordenadas">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                               <h3 class="modal-title">Edición de Coordenadas</h3>
                        </div>
                        
                          <div class="modal-body" style="height: 500px; width:590px;" id="contenedorMapa">
                            
                          </div>
                         <div class="modal-footer">
                                <label id="latlon" align="left"></label>
                              <button type="button" onclick="EnviarPasaje.editarCoordenadas()" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         </div>
                </div>
        </div>
</div>  

<div class="modal fade" id="ModalSeleccionDireccion">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                               <h3 class="modal-title">Direcciones</h3>
                        </div>
                        
                          <div class="modal-body" style="overflow: auto;">
                            <p>Selecciona una dirección.</p><br>
                           <div id="direccionesEncontradas">
                           </div>
                          </div>
                </div>
        </div>
</div> 

<script>
    var lonlat = "";
        function registrarClick(){
            if (typeof(map) === "undefined") {

                initalizeMap();
            }


            map.events.register('click', map, handleMapClick);

            function handleMapClick(e){
               lonlat = map.getLonLatFromViewPortPx(e.xy);
               // use lonlat

               // If you are using OpenStreetMap (etc) tiles and want to convert back 
               // to gps coords add the following line :-
               lonlat.transform( map.projection,map.displayProjection);

               // Longitude = lonlat.lon
               // Latitude  = lonlat.lat
               $("#latlon").html("Latitud: "+lonlat.lat.toFixed(6)+", Longitud: "+lonlat.lon.toFixed(6));
            } 

        }
        

        function initalizeMap() {

            map = new OpenLayers.Map ("contenedorMapa", {
                    controls:[
                        new OpenLayers.Control.Navigation(),
                        new OpenLayers.Control.PanZoomBar(),
                        new OpenLayers.Control.LayerSwitcher(),
                        new OpenLayers.Control.Attribution()],
                    maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
                        maxResolution: 156543.0399,
                    numZoomLevels: 18,
                    units: 'm',
                    projection: new OpenLayers.Projection("EPSG:900913"),
                    displayProjection: new OpenLayers.Projection("EPSG:4326")
                 });
                    
            layerMapnik = new OpenLayers.Layer.OSM();
           map.addLayer(layerMapnik);
           layerMarkers = new OpenLayers.Layer.Markers("Markers");
           map.addLayer(layerMarkers);
                
           var initLonLat = new OpenLayers.LonLat(-62.086, -31.430).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
           map.setCenter (initLonLat, 15);
                
            size = new OpenLayers.Size(30,30);
           offset = new OpenLayers.Pixel(-(size.w/2), -size.h);     
        }
    
</script>

<script type="text/javascript">
    //Funciones de la notificacion
        // "op" puede estar valuada en "error", "info" o "success"
        function notificacion(op,msg,time){
            if(time == undefined)
                time = 8000;
            var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});

        }


        //Funciones del blockUI
        function blockUI(el, centerY) {
            var el = jQuery(el); 
            el.block({
                    message: '<img src="../recursos/imagenes/cargando4.gif" align=""/><br><h3><font color="#454545"><b>Cargado...</font></h3>',
                    centerY: centerY != undefined ? centerY : true,
                    css: {
                        top: '30%',
                        border: 'none',
                        padding: '5px',
                        backgroundColor: '#FFF',
                        opacity: 0.80
                    },
                    overlayCSS: {
                        backgroundColor: '#000',
                        opacity: 0.25,
                        cursor: 'wait'
                    }
                });
        }
        function unblockUI(el) {          
            jQuery(el).unblock({
                    onUnblock: function () {
                        jQuery(el).removeAttr("style");
                    }
                });
        }

</script>		
    			
<script type="text/javascript">
	jQuery(document).ready(function() {	
                ciudadEmpresa = '<?php echo $_SESSION["sesion_ciudad"];?>';
                departamentoEmpresa = '<?php echo $_SESSION["sesion_departamento"];?>';
                provinciaEmpresa = '<?php echo $_SESSION["sesion_provincia"];?>';

 				var choferesConectados;		
                var latDireccion;
                var lonDireccion;
                var direccionCalle="";
                var direccionNumero="";	
                $("#tipo").bootstrapSwitch('onText', 'Manual');
                $("#tipo").bootstrapSwitch('offText', 'Automático');
                $("#tipo").focus();
                
				EnviarPasaje.init();
                $("#tipo").bootstrapSwitch('state', false, true);
				CargarPasajesEnCurso.init();
				
        });
</script>

<script type="text/javascript">
	$("#listaChoferes").change(function() {
		
	var usuario = $(this).val();
	for (i=0 ; i<choferesConectados.choferes.length ; i++) {
		if (choferesConectados.choferes[i].usuario == usuario) {
			
			$("#movil").val(choferesConectados.choferes[i].numero_movil);
		}
	}		

    });
    
  
    
	$("#listaChoferes").focus(function () {
		
   	CargarTablaModal.init();
		$('#ModaldeTabla').modal();
   });
</script>
<script type="text/javascript">
	function seleccionar(check) {
		$('.checks:checked').each(function(){
    		$(this).prop("checked", "");
    	});
    	$(check).prop("checked", "checked");
	}
</script>
</body>
</html>

<?php
}else{
     header("Location: ../index.php");
}
?>