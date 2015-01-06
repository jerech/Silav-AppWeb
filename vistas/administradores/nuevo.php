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
		<script type="text/javascript" src="administradores/formularioNuevo.js"></script>
	</head>
	<body>
	<div class="content">
		<div class="header">
		    <h1 class="page-title">Crea un Nuevo Administrador</h1>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=VerAdministradores">Administradores</a>
		        </li>
		        <li>
		            <a>Nuevo Administrador</a>
		        </li>
		    </ul>
		</div>
		<div class="main-content">
			<ul class="nav nav-tabs">
  				<li class="active"><a href="#perfil" data-toggle="tab">Perfil</a></li>
  				<li><a href="#profile" data-toggle="tab">Password</a></li>
			</ul>

			<div class="row">
			<br>

				<!--Contenedor de los tabs-->
				<div id="myTabContent" class="tab-content">

					<!--Tab con formulario de perfil-->
					<div class="tab-pane active in" id="perfil">
						<div class="row">
    						<div class="col-md-8">
        						<h2> Información General</h2>
    						</div>
						</div>
						<form id="formulario-perfil">
							<div class="col-md-4">
								<div class="form-group">
								<label>Nombre</label><input type="text" value="" id="nombre" name="nombre" class="form-control">
								</div>

								<div class="form-group">
								<label>Apellido</label><input type="text" value="" id="apellido" name="apellido" class="form-control">
								</div>

								<div class="form-group">
								<label>Usuario</label><input type="text" value="" id="usuario" name="usuario" class="form-control">
								</div>

								<div class="form-group">
								<label>Password</label><input type="text" value="" id="password" name="password" class="form-control">
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Tel&eacute;fono</label><input type="text" value="" id="telefono" name="telefono" class="form-control">
								</div>
								<div class="form-group">
								<label>Direcci&oacute;n</label><input type="text" value="" id="direccion" name="direccion" class="form-control">
								</div>
								<div class="form-group">
								<label>Email</label><input type="text" value="" id="email" name="email" class="form-control">
								</div>
								<div class="form-group">
								<label>Activo</label><br><input type="checkbox" checked id="activo" name="activo" class="form-control">
								</div>
								
							</div>

							<div class="col-md-8">
								<div class="row">
									<h2>Permisos</h2>
								</div>																	
								<div id="secciones">

								</div>									
							</div>

													
						</form>

						<div class="col-md-8">
							<div class="btn-toolbar list-toolbar">
      							<button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      								<a href="panelSitio.php?seccion=Inicio" class="btn btn-danger">Cancelar</a>
    						</div>
    					</div>
					</div>

					<!--Tab con formulario cambio de password-->
					<div class="tab-pane fade" id="profile">
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
            $("[name='activo']").bootstrapSwitch();

            NuevoAdministrador.init();
        });
	</script>
	</body>
</html>