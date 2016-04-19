<?php   
    if(!defined('acceso')){
        exit();
    }

    require_once("estadisticas/obtenerTopUsuarios.php");
?>

<!doctype html>
<html lang="en">
	<head>
		<script type="text/javascript" src="estadisticas/mostrarTablaPasajes.js"></script>
		
	</head>
	<body>   

    <style type="text/css">
        .label-warning {
            background-color: #FF6969;
        }

        .label-success {
            background-color: #7CC50C;
        }

        .label-info {
            background-color: #FFBF00;
        }

    </style>
            
<div id="contenedor">
	<div class="content">
        <div class="header">
		    <h1 class="page-title">Lista de Pasajes</h1>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=PasajesHistoricos">Pasajes</a>
		        </li>
		        <li>
		            <a>Ver Lista</a>
		        </li>
		    </ul>
		</div>
        <div class="main-content">
         <div class="btn-toolbar list-toolbar">
    
  <div class="btn-group">
  </div>
</div>   
<div id="div-tabla">
<table id="tabla" class="dataTable display">
  <thead>
    <tr>
      <th>Id</th>
      <th>Fecha</th>
      <th>Chofer</th>
      <th>N° Móvil</th>
      <th>Cliente</th>
      <th>Dirección</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody id="tBody">

  </tbody>
</table>

</div>

<br><br><br>
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Top 10<span class="label label-info">+10</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Pasajes</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=0; $i < count($datosTopUsuarios); $i++) { 
                   $datos=$datosTopUsuarios[$i];
                   $nombre=$datos['nombre']." ".$datos['apellido'];
                   $pasajes=$datos['can'];
                   $usuario=$datos['usuario'];
                   echo "<tr>
                        <td>$nombre</td>
                        <td>$usuario</td>
                        <td><p class='text-info' style='font-size: 1.2em;' > $pasajes  <i class='fa fa-arrow-circle-o-up'></i></p></td>
                   </tr>";
                  

                  }




                ?>
            
              </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-8 col-md-8">
        <div class="panel panel-default">
            <a href="#widget1container" class="panel-heading" data-toggle="collapse">Gráfico </a>
            <div id="widget1container" class="panel-body collapse in">
                <div id="myChart" style="height: 300px; width: 100%;"></div>

            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="panel panel-default">
            <a href="#widget1container2" class="panel-heading" data-toggle="collapse">Mapa    <span id="can-porasignar" class='label label-info pull-center' style='width:60px;'>3</span>&nbsp;<span id="can-asignados" style='width:60px;' class='label label-success pull-center'>2</span>&nbsp;<span id="can-rechazados" style='width:60px;' class='label label-warning pull-center'>6</span></a>
            <div id="widget1container2" class="panel-body collapse in">
                <div id="mapa" style="height: 450px;">

                </div>
            </div>
        </div>

    </div>
<div>



            <footer>
                <hr>

                <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                <p>© 2014 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            </footer>
        </div>
    </div>
<script src="http://openlayers.org/api/OpenLayers.js"></script>
	<script>
  lonMapa=-62.0851;
      latMapa=-31.4304;
		jQuery(document).ready(function() {

      

           urlIconBlue = "../Geolocalizacion/img/marker.png";
           urlIconRed = "../Geolocalizacion/img/marker-red.png";
           urlIconGreen = "../Geolocalizacion/img/marker2.png";
           urlIconYellow = "../Geolocalizacion/img/marker3.png";

           
            mostrarDatos.init();


      });      
	</script>
	</body>
</html>