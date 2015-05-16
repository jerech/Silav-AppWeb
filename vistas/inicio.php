<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<script type="text/javascript" src="inicio/accionesInicio.js"></script>

	</head>
	<body>
	<div class="content">
		<div class="header">

		    <div class="stats">
		        <p class="stat">
		            <span class="label label-info" id="conectados">25</span>Conectados
		        </p>
		        <p class="stat">
		            <span class="label label-success" id="pasajes">27</span>Pasajes en Curso
		        </p>
		        <p class="stat">
		            <span class="label label-danger" id="choferes">15</span>Choferes
		        </p>
		    </div>
		    <h1 class="page-title">Inicio</h1>
		    <ul class="breadcrumb">
		        <li>
		            <a href="#">Inicio</a>
		        </li>
		    </ul>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="col-sm-6 col-md-6">
			        <div class="panel panel-default">
			            <a href="#widget2container1" class="panel-heading" data-toggle="collapse">M&oacute;viles </a>
			            <div id="widget2container1" class="panel-body collapse in">
			                <h2>Geolocalizaci&oacute;n</h2>
			                <table cellspacing="7" width="95%">
			                	<tr>
			                		<td valign="top"><p>
			                			<ul>
			                				<li>Monitor de M&oacute;viles</li>
			                				<li>Visualizaci&oacute;n de Ciudad</li>
			                				<li>Mapa Interactivo</li>
			                			</ul>
			                		</p></td>
			                		<td><p><img class="img-polaroid" src="../recursos/imagenes/geolocalizacion.jpeg"></img></p></td>
			                	</tr>
			                </table>			            
			                <p>Forma sencilla de monitorear la distribución de Móviles situados en la ciudad. También podrá visualizar como se asignan los pasajes automáticamente.</p>
			                <?php if(in_array('Geolocalizacion',$_SESSION['sesion_permisos'])){ ?>
			                <p><button class="btn btn-primary" name="btnGeolocalizacion" id="btnGeolocalizacion">Ver »</button></p>
			                <?php } ?>
			            </div>
			        </div>
    			</div>
    			<div class="col-sm-6 col-md-6">
			        <div class="panel panel-default">
			            <a href="#widget2container2" class="panel-heading" data-toggle="collapse">Pasajes </a>
			            <div id="widget2container2" class="panel-body collapse in">
			                <h2>Control de Pasajes</h2>
			                <table cellspacing="7" width="95%">
			                	<tr>
			                		<td valign="top"><p>
			                			<ul>
			                				<li>Monitor de Pasajes</li>
			                				<li>Creaci&oacute;n de Pasajes</li>
			                				<li>Asignaci&oacute;n de M&oacute;viles</li>
			                			</ul>
			                		</p></td>
			                		<td><p><img class="img-polaroid" src="../recursos/imagenes/semaforo.jpeg"></img></p></td>
			                	</tr>
			                </table>
			                <p>Ingresar nuevos pasajes al sistema y ver los que est&aacute;n en curso.</p><br><br>
			                <?php if(in_array('ControlDePasajes',$_SESSION['sesion_permisos'])){ ?>
			                <p><button class="btn btn-primary" name="btnControlDePasajes" id="btnControlDePasajes">Ver »</button></p>
			                <?php } ?>
			            </div>
			        </div>
    			</div>
			</div>
			<div class="row">
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
		var usuarioNombre = '<?php echo $_SESSION["sesion_usuario"]; ?>';

		Modulo.init();
		MostrarInformacionResumen.init();
	</script>
	</body>
</html>