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
		<script type="text/javascript" src="choferes/formularioNuevo.js"></script>
		<script type="text/javascript" src="choferes/cargarDatos.js"></script>
	</head>
	<body>

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
		            <a href="panelSitio.php?subSeccion=NuevoChofer">Choferes</a>
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
								<label>Nombre</label><input type="text" id="nombre" name="nombre" class="form-control">
								</div>

								<div class="form-group">
								<label>Apellido</label><input type="text" id="apellido" name="apellido" class="form-control">
								</div>

								<div class="form-group">
								<label>Usuario</label><input type="text" id="usuario" name="usuario" class="form-control">
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
								<label>Vencimiento de licencia</label><input type="text" id="venc_licencia" name="venc_licencia" class="form-control">
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
					<!--<div class="tab-pane fade" id="automovil">
						<form id="formulario-automovil" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>Aire Acondicionado</label><br><input type="checkbox" checked id="aa" name="aa" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>GNC</label><br><input type="checkbox" id="gnc" name="gnc" class="form-control">
								</div>
							</div>
						</form>
					</div>-->

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
            
				           
            
            NuevoChofer.init();
            
            if(_id != 0){
        			CargarDatos.init();
      		}
        });
	</script>
	</body>
</html>