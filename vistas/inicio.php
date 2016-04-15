<?php   
    if(!defined('acceso')){
        exit();
    }


    //
    require_once("inicio/datosParaInicio.php");
?>

<!doctype html>
<html lang="en">
	<head>
		<script type="text/javascript" src="inicio/accionesInicio.js"></script>

	</head>
	<body>
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
    </style>
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
			<div class="panel panel-default">
        <a href="#page-stats" class="panel-heading" data-toggle="collapse">Pasajes Hoy</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in">

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="<?=$arrayDatos['canPasajes'] ;?>" data-displayPrevious="true" value="<?=$arrayDatos['canPasajes'] ;?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Total</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="<?=$arrayDatos['canPasajes'] ;?>" data-displayPrevious="true" value="<?=$arrayDatos['canAsignados'] ;?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Asignados</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="<?=$arrayDatos['canPasajes'] ;?>" data-displayPrevious="true" value="<?=$arrayDatos['canRechazados'] ;?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">Rechazados</h3>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="knob-container">
                                <input class="knob" data-width="200" data-min="0" data-max="<?=$arrayDatos['canPasajes'] ;?>" data-displayPrevious="true" value="<?=$arrayDatos['canEnEspera'] ;?>" data-fgColor="#92A3C2" data-readOnly=true;>
                                <h3 class="text-muted text-center">En Espera</h3>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
			
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
			                		<td><p><img class="img-polaroid" src="../recursos/imagenes/mapa.png"></img></p></td>
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
			                		<td><p><img class="img-polaroid" src="../recursos/imagenes/pasajes.png"></img></p></td>
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