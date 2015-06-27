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
		<script type="text/javascript" src="configuracion/formularioNuevo.js"></script>
		<script type="text/javascript" src="configuracion/cargarDatos.js"></script>
	</head>
	<body>

	<div class="content">
		<div class="header">
		<?php if($seccion == 'Configuracion'){
		     echo '<h1 class="page-title">Configuraciones</h1>';
		    }else{
		    echo '<h1 class="page-title"></h1>';
		    }?>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?seccion=Configuracion">Configuraci&oacute;n</a>
		        </li>
		        
		    </ul>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-md-8">
					<div class="btn-toolbar list-toolbar">
							<?php if($seccion == 'Configuracion'){
								echo '<button id="btnGuardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>';
							}else{
								echo '<button id="btnModificar" class="btn btn-primary"><i class="fa fa-save"></i> Modificar</button>';
							}?>
							
								<a href="panelSitio.php?seccion=Inicio" class="btn btn-danger">Cancelar</a>
					</div>
    			</div>
    		</div>
			<ul class="nav nav-tabs">
  				<li class="active"><a href="#configuracion-empresa" data-toggle="tab">Empresa</a></li>
			</ul>

			<div class="row">
			<br>

				<!--Contenedor de los tabs-->
				<div id="myTabContent" class="tab-content">

					<!--Tab con formulario de configuracion-empresa-->
					<div class="tab-pane active in" id="configuracion-empresa">
						
						<form id="formulario-configuracion" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>Nombre</label><span>*</span><input type="text" id="nombre" name="nombre" class="form-control">
								</div>

								<div class="form-group">
								<label>Teléfono</label><input type="text" id="telefono" name="telefono" class="form-control">
								</div>

								<div class="form-group">
								<label>E-mail</label><input type="email" id="email" name="email" class="form-control">
								</div>

								<div class="form-group">
								<label>Cuit</label><input type="text" id="cuit" name="cuit" class="form-control">
								</div>
			

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Dirección</label><span>*</span><input type="text" id="direccion" name="direccion" class="form-control">
								</div>

								<div class="form-group">
								<label>Departamento</label><span>*</span><input type="text" id="departamento" name="departamento" class="form-control">
								</div>

								<div class="form-group">
								<label>Provincia</label><span>*</span><input type="text" id="provincia" name="provincia" class="form-control">
								</div>

								<div class="form-group">
								<label>País</label><span>*</span><input type="text" id="pais" name="pais" class="form-control">
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
           		           
            
            NuevaConfiguracion.init();
             
        	CargarDatos.init();
      		
        });
	</script>
	</body>
</html>