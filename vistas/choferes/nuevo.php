<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap-switch.css">
		<script type="text/javascript" src="../recursos/plugins/lib/bootstrap/js/bootstrap-switch.js"></script>
		<script type="text/javascript" src="../recursos/plugins/lib/bootstrap/js/bootstrap-switch2.js"></script>
		<script type="text/javascript" src="../recursos/plugins/lib/jquery.dataTables.js"></script>
		<script type="text/javascript" src="choferes/formularioNuevo.js"></script>
		<script type="text/javascript" src="choferes/cargarMoviles.js"></script>
		<script type="text/javascript" src="choferes/cargarDatos.js"></script>
	</head>
	<body>
	
<script type="text/javascript">
var parametro = new Array();

	function cargarTabla() {
		var movilesSeleccionados = new Array();
		var contador = 0;
		var movilesEnTabla = new Array();

		$('.checks:checked').each(
    function() {
    	  movilesSeleccionados[contador] = $(this).prop("id");
    	  contador = contador + 1;
    });
    
	idMovilesSeleccionados = movilesSeleccionados;    
    
    if ($('#tabla >tbody >tr').length != 0) {
    	contador = 0;
    	$("#tabla tr").find('td:eq(1)').each(function () {
 				numeroMovil = $(this).html();
 				movilesEnTabla[contador] = numeroMovil;
 				contador = contador + 1;
		});
    }
    	contador = $("#tabla tr:last").children('td').eq(0).text();
    	if (contador == "") {
    		contador = 0;
    	}
    	else {
    		contador = parseInt(contador);
    	}
		
		for (i=0 ; i < movilesSeleccionados.length; i++) {
			for (j=0 ; j < registrosMoviles.moviles.length; j++) {
				if (registrosMoviles.moviles[j].id == movilesSeleccionados[i]) {
						movilEncontrado = false;
						if (movilesEnTabla.length != 0) {
							for (k=0 ; k < movilesEnTabla.length ; k++) {
								if (movilesEnTabla[k] == registrosMoviles.moviles[j].numero) {
									movilEncontrado = true;
								}
							}
						}
						
						if (movilEncontrado == false) {
							
							parametro[0] = registrosMoviles.moviles[j].id;
							parametro[1] = registrosMoviles.moviles[j].numero;

							var nuevaFila = "<tr>";
                           contador = contador + 1;
                           
                           nuevaFila += "<td>"+contador+"</td>";

									nuevaFila += "<td>"+registrosMoviles.moviles[j].numero+"</td>";
									nuevaFila += "<td>"+registrosMoviles.moviles[j].patente+"</td>";
									nuevaFila += "<td>"+registrosMoviles.moviles[j].modelo+"</td>";
									nuevaFila += "<td>"+registrosMoviles.moviles[j].marca+"</td>";
									
									nuevaFila += "<td id='"+registrosMoviles.moviles[j].id+"'>";
									nuevaFila += " <a href='#myModal' onclick='guardarIdyNumero(this);' class='boton_eliminar' id='tabla-"+registrosMoviles.moviles[j].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";								
									nuevaFila += "</td>";
									
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);
						}
						
					}
					
				}
			}
			$(".checks").prop("checked", "");
	}
</script>

<script type="text/javascript">
var fila;
function guardarIdyNumero(t) {
	fila = t;
	idDeMovil = parametro[0];
	
	numeroDeMovil = parametro[1];
}

function eliminarRegistro() {

	var urlEliminarDatos = "choferes/eliminarMovil.php";
	var parametro = "id_movil="+idDeMovil;
	
	if (_id != 0) {
		parametro += "&id_chofer="+_id;
		$.ajax({
					type: 'post',
                    url: urlEliminarDatos, 
                    data: parametro,           
                    dataType: 'html',
                    beforeSend: function(){
                        
                    },   
                    success: function(data) {
								          
                    	notificacion("success", "Móvil borrado correctamente");
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});
	}

		 var td = fila.parentNode;
var tr = td.parentNode;
var table = tr.parentNode;
table.removeChild(tr);

var cont = 0;
$("#tabla tr").find('td:eq(0)').each(function () {
	cont = cont + 1;
 	$(this).text(cont);

		});

}

function eliminarRegistroParaModificar() {
	var td = fila.parentNode;
var tr = td.parentNode;
var table = tr.parentNode;
table.removeChild(tr);

var cont = 0;
$("#tabla tr").find('td:eq(0)').each(function () {
	cont = cont + 1;
 	$(this).text(cont);

		});
}
</script>

	<div class="content">
		<div class="header">
		<?php if($subSeccion == 'NuevoChofer'){
		     echo '<h1 class="page-title">Crea un Nuevo Chofer</h1>';
		    }else{
		    echo '<h1 class="page-title">Modifica un Chofer</h1>';
		    }?>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=VerChoferes">Choferes</a>
		        </li>
		        <li>
		        	<?php if($subSeccion == 'NuevoChofer'){
		             	echo '<a>Nuevo Chofer</a>';
		             }else{
		             	echo '<a>Modificar Chofer</a>';
		             }?>
		        </li>
		    </ul>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-md-8">
					<div class="btn-toolbar list-toolbar">
							<?php if($subSeccion == 'NuevoChofer'){
								echo '<button id="btnGuardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>';
							}else{
								echo '<button id="btnModificar" class="btn btn-primary"><i class="fa fa-save"></i> Modificar</button>';
							}?>
							
								<a href="panelSitio.php?seccion=Inicio" class="btn btn-danger">Cancelar</a>
					</div>
    			</div>
    		</div>
			<ul class="nav nav-tabs">
  				<li class="active"><a href="#perfil" data-toggle="tab">Perfil</a></li>
  				<li><a href="#password" data-toggle="tab">Password</a></li>
  				<li><a href="#automovil" data-toggle="tab">Autom&oacute;vil</a></li>
  				<li><a href="#habilitacion" data-toggle="tab">Habilitaci&oacute;n</a></li>
			</ul>

			<div class="row">
			<br>

				<!--Contenedor de los tabs-->
				<div id="myTabContent" class="tab-content">

					<!--Tab con formulario de Perfil-->
					<div class="tab-pane active in" id="perfil">
						
						<form id="formulario-perfil" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>Nombre</label><span>*</span><input type="text" id="nombre" name="nombre" class="form-control">
								</div>

								<div class="form-group">
								<label>Apellido</label><span>*</span><input type="text" id="apellido" name="apellido" class="form-control">
								</div>

								<div class="form-group">
								<label>Usuario</label><span>*</span><input type="text" id="usuario" name="usuario" class="form-control">
								</div>
			
								<div class="form-group">
								<label>Sexo</label><br><input type="checkbox" checked id="sexo" name="sexo" class="form-control">
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Tel&eacute;fono</label><input type="text" id="numero_telefono" name="numero_telefono" class="form-control">
								</div>
								<div class="form-group">
								<label>Vencimiento de licencia</label><input type="text" id="venc_licencia" name="venc_licencia" placeholder="dd/mm/yyyy" class="form-control">
								</div>
								
								
							</div>

													
						</form>

						
					</div>

					<!--Tab con formulario Password-->
					<div class="tab-pane fade" id="password">
						<form id="formulario-password" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>Password</label><input type="password" id="contrasenia" name="contrasenia" class="form-control">
								</div>
								<input type="hidden" id="contrasenia-encriptada" name="contrasenia-encriptada" class="form-control">
							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Re-Password</label><input type="password" id="re-contrasenia" name="re-contrasenia" class="form-control">
								</div>
								<input type="hidden" id="re-contrasenia-encriptada" name="re-contrasenia-encriptada" class="form-control">
							</div>
						</form>
					</div>
					

					<!--Tab con formulario Automovil-->
					<div class="tab-pane fade" id="automovil">
						<form id="formulario-automovil" name="form" class="form">
							<div style="margin: auto 1em;">
							
<div class="btn-toolbar list-toolbar">
    <a class="btn btn-primary" data-toggle="modal" href="#ModaldeTabla"><i class="fa fa-plus"></i> </a>
    
  <div class="btn-group">
  </div>
</div> 							
							
								<table id="tabla" class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>N&uacute;mero</th>
      <th>Patente</th>
      <th>Modelo</th>
      <th>Marca</th>
      <th style="width: 3.5em;"></th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
							
<div class="modal fade" id="ModaldeTabla">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                               <h4 class="modal-title">Lista de M&oacute;viles</h4>
                        </div>
                        
  <div class="modal-body" style="height: 400px; overflow: auto;">
   <table id="tablaModal" class="table">
  <thead>
    <tr>
      <th style="width: 4em;"></th>
      <th>N&uacute;mero</th>
      <th>Patente</th>
      <th>Modelo</th>
      <th>Marca</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
  </div>
                         <div class="modal-footer">
                              <button type="button" onClick="cargarTabla()" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                         </div>
                </div>
        </div>
</div>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Confirmar eliminaci&oacute;n</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-warning modal-icon"></i>¿Esta seguro que quiere borrar el m&oacute;vil?<br></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <?php if($subSeccion == 'NuevoChofer'){
		     				echo '<button class="btn btn-danger" onclick="eliminarRegistro()" data-dismiss="modal">Borrar</button>';
		    			}else{
		    				echo '<button class="btn btn-danger" onclick="eliminarRegistroParaModificar()" data-dismiss="modal">Borrar</button>';
		    	}?>
            
        </div>
      </div>
    </div>
</div>						
							
							</div>
						</form>
					</div>

					<!--Tab con formulario Habilitacion-->
					<div class="tab-pane fade" id="habilitacion">
						<form id="formulario-habilitacion" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>Habilitado</label><br><input type="checkbox" checked id="habilitado" name="habilitado" class="form-control">
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</div>




		</div>
		
		

		<footer>
		    <hr></hr>
		    <!--

		     Purchase a site license to remove this link from …

		    -->
		    <p class="pull-right">
		        A 
		        <a target="_blank" href="http://www.portnine.com/bootstrap-themes">
		            Free Bootstrap Theme
		        </a>
		         by 
		        <a target="_blank" href="http://www.portnine.com">
		            Portnine
		        </a>
		    </p>
		    <p>
		        © 2014 
		        <a target="_blank" href="http://www.portnine.com">
		            Portnine
		        </a>
		    </p>
		</footer>
	</div>

	<script>
		jQuery(document).ready(function() {
			_id = '<?php if(!empty($_GET["id"])){ echo $_GET["id"];} else { echo 0;} ?>'; 			
					
            $("[name='sexo']").bootstrapSwitch2();
            $("[name='habilitado']").bootstrapSwitch();
            
            var idDeMovil;
				var registrosMoviles;
				var numeroDeMovil;
				var idMovilesSeleccionados;	
				var movilesAsignadosBD;
				
				NuevoChofer.init();
            CargarMoviles.init();
            
            
            if(_id != 0){
        			CargarDatos.init();
      		}
        });
	</script>
	</body>
</html>