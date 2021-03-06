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
		<script type="text/javascript" src="moviles/formularioNuevo.js"></script>
		<script type="text/javascript" src="moviles/cargarDatos.js"></script>
	</head>
	<body>

	<div class="content">
		<div class="header">
		<?php if($subSeccion == 'NuevoMovil'){
		     echo '<h1 class="page-title">Crea un Nuevo M&oacute;vil</h1>';
		    }else{
		    echo '<h1 class="page-title">Modifica un M&oacute;vil</h1>';
		    }?>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=VerMoviles">M&oacute;viles</a>
		        </li>
		        <li>
		        	<?php if($subSeccion == 'NuevoMovil'){
		             	echo '<a>Nuevo Móvil</a>';
		             }else{
		             	echo '<a>Modificar Móvil</a>';
		             }?>
		        </li>
		    </ul>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-md-8">
					<div class="btn-toolbar list-toolbar">
							<?php if($subSeccion == 'NuevoMovil'){
								echo '<button id="btnGuardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>';
							}else{
								echo '<button id="btnModificar" class="btn btn-primary"><i class="fa fa-save"></i> Modificar</button>';
							}?>
							
								<a href="panelSitio.php?seccion=Inicio" class="btn btn-danger">Cancelar</a>
					</div>
    			</div>
    		</div>
			<ul class="nav nav-tabs">
  				<li class="active"><a href="#automovil" data-toggle="tab">Autom&oacute;vil</a></li>
  				<li><a href="#caracteristicas" data-toggle="tab">Caracter&iacute;sticas</a></li>
			</ul>

			<div class="row">
			<br>

				<!--Contenedor de los tabs-->
				<div id="myTabContent" class="tab-content">

					<!--Tab con formulario de automovil-->
					<div class="tab-pane active in" id="automovil">
						
						<form id="formulario-automovil" name="form" class="form">
							<div class="col-md-4">
								<div class="form-group">
								<label>N&uacute;mero</label><span>*</span><input type="text" id="numero" name="numero" class="form-control">
								</div>

								<div class="form-group">
								<label>Marca</label><input type="text" id="marca" name="marca" class="form-control">
								</div>

								<div class="form-group">
								<label>Vencimiento de Seguro</label><input type="text" placeholder="dd/mm/yyyy" id="vencseguro" name="vencseguro" class="form-control">
								</div>
			

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Patente</label><span>*</span><input type="text" id="patente" name="patente" class="form-control">
								</div>
								<div class="form-group">
								<label>Modelo</label><input type="text" id="modelo" name="modelo" class="form-control">
								</div>
								
								
							</div>

													
						</form>

						
					</div>

					

					<!--Tab con formulario caracteristicas-->
					<div class="tab-pane fade" id="caracteristicas">
						<form id="formulario-caracteristicas" name="form" class="form">
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
			
            $("[name='aa']").bootstrapSwitch();
            $("[name='gnc']").bootstrapSwitch();
            
				           
            
            NuevoMovil.init();
            
            if(_id != 0){
        			CargarDatos.init();
      		}
        });
	</script>
	</body>
</html>