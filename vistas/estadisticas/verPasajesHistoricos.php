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
            background-color: #69FF69;
        }

        .label-info {
            background-color: #FFBF00;
        }
    </style>
            
    
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
    <div class="col-sm-6 col-md-6">
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
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-default">
            <a href="#widget1container" class="panel-heading" data-toggle="collapse">Collapsible </a>
            <div id="widget1container" class="panel-body collapse in">
                <h2>Here's a Tip</h2>
                <p>This template was developed with <a href="http://middlemanapp.com/" target="_blank">Middleman</a> and includes .erb layouts and views.</p>
                <p>All of the views you see here (sign in, sign up, users, etc) are already split up so you don't have to waste your time doing it yourself!</p>
                <p>The layout.erb file includes the header, footer, and side navigation and all of the views are broken out into their own files.</p>
                <p>If you aren't using Ruby, there is also a set of plain HTML files for each page, just like you would expect.</p>
            </div>
        </div>
    </div>
</div>



            <footer>
                <hr>

                <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                <p>© 2014 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            </footer>
        </div>
    </div>

	<script>
		jQuery(document).ready(function() {
            
            mostrarDatos.init();

      });      
	</script>
	</body>
</html>