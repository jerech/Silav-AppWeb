<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<script type="text/javascript" src="estadisticas/mostrarTablaPasajes.js"></script>
		
	</head>
	<body>   
            
    
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
  <tbody>

  </tbody>
</table>

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