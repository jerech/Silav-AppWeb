<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>

	</head>
	<body>
	<div class="content">
		<div class="header">

		    <div class="stats">
		        <p class="stat">
		            <span class="label label-info">25</span>Choferes
		        </p>
		        <p class="stat">
		            <span class="label label-success">27</span>M&oacute;viles
		        </p>
		        <p class="stat">
		            <span class="label label-danger">15</span>Conectados
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
			                		<td><p><img class="img-polaroid" src="../recursos/imagenes/mapa.jpg"></img></p></td>
			                	</tr>
			                </table>			            
			                <p>Forma sensilla de monitorear la distribución de Móviles situados en la ciudad. También podrá visualizar como se asignan los pasajes automáticamente.</p>
			                <?php if(in_array('Geolocalizacion',$_SESSION['sesion_permisos'])){ ?>
			                <p><a class="btn btn-primary" target="_blank" href="../Geolocalizacion/paginaMapa.php">Quiero Ir »</a></p>
			                <?php } ?>
			            </div>
			        </div>
    			</div>
    			<div class="col-sm-6 col-md-6">
			        <div class="panel panel-default">
			            <a href="#widget2container2" class="panel-heading" data-toggle="collapse">Pasajes </a>
			            <div id="widget2container2" class="panel-body collapse in">
			                <h2>Built with Less</h2>
			                <p>The CSS is built with Less. There is a compiled version included if you prefer plain CSS.</p>
			                <p>Fava bean jícama seakale beetroot courgette shallot amaranth pea garbanzo carrot radicchio peanut leek pea sprouts arugula brussels sprout green bean. Spring onion broccoli chicory shallot winter purslane pumpkin gumbo cabbage squash beet greens lettuce celery. Gram zucchini swiss chard mustard burdock radish brussels sprout groundnut. Asparagus horseradish beet greens broccoli brussels.</p>
			                <p><a class="btn btn-primary">Quiero Ir »</a></p>
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

	</body>
</html>