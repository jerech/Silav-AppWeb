<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap-switch.css">
		<script src="../recursos/plugins/lib/bootstrapValidator.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../recursos/plugins/lib/bootstrap/js/bootstrap-switch.js"></script>
		<script type="text/javascript" src="administradores/formularioNuevo.js"></script>
		<script type="text/javascript" src="administradores/cargarDatos.js"></script>
		
	</head>
	<body>
	<div class="content">
		<div class="header">
			<?php if($subSeccion == 'NuevoAdministrador'){
		     echo '<h1 class="page-title">Crea un Nuevo Administrador</h1>';
		    }else{
		    echo '<h1 class="page-title">Modifica un Administrador</h1>';
		    }?>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=VerAdministradores">Administradores</a>
		        </li>
		        <li>
		        	<?php if($subSeccion == 'NuevoAdministrador'){
		             	echo '<a>Nuevo Administrador</a>';
		             }else{
		             	echo '<a>Modificar Administrador</a>';
		             }?>
		        </li>
		    </ul>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-md-8">
					<div class="btn-toolbar list-toolbar">
							<?php if($subSeccion == 'NuevoAdministrador'){
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
  				<li><a href="#permisos" data-toggle="tab">Permisos</a></li>
			</ul>

			<div class="row">
			<br>

				<!--Contenedor de los tabs-->
				<div id="myTabContent" class="tab-content">

					<!--Tab con formulario de perfil-->
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
								<label>Activo</label><br><input type="checkbox" checked id="activo" name="activo" class="switch form-control">
								</div>
			

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Tel&eacute;fono</label><input type="text" id="telefono" name="telefono" class="form-control">
								</div>
								<div class="form-group">
								<label>Direcci&oacute;n</label><input type="text" id="direccion" name="direccion" class="form-control">
								</div>
								<div class="form-group">
								<label>Email</label><input type="email" id="email" name="email" class="form-control">
								</div>
								
								
							</div>

													
						</form>

						
					</div>

					

					<!--Tab con formulario cambio de password-->
					<div class="tab-pane fade" id="password">
						<form id="formulario-contrasenia" name="form" class="form">

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
							</div>
							<?php if($subSeccion == 'ModificarAdministrador'){
								echo '<div class=row><div class="col-md-6"><font color="red">&nbsp;Para modificar, escriba el nuevo password.</font></div></div>';
							}?>
						</form>
					</div>

					<!--Tab con formulario cambio de password-->
					<div class="tab-pane fade" id="permisos">
						<form id="formulario-permisos" name="form" class="form">
							<div class="col-md-8">
																		
								<div id="secciones">

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

		_id = '<?php if(!empty($_GET["id"])){ echo $_GET["id"];} else{echo 0;}  ?>';

        $("[name='activo']").bootstrapSwitch();
        NuevoAdministrador.init();

        if(_id != 0){
        	CargarDatos.init();
      	}
       
        
	</script>
	</body>
</html>