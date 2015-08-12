<?php
    session_start(); 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistema SiLAV - Coordenadas</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="http://openlayers.org/api/OpenLayers.js"></script>
	<link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../recursos/plugins/lib/font-awesome/css/font-awesome.css">
	<script src="../recursos/plugins/lib/bootstrap/js/bootstrap.js"></script>
	
	<script src="../recursos/plugins/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="../recursos/plugins/lib/noty.js" type="text/javascript"></script>
   <script src="../recursos/plugins/lib/md5.js" type="text/javascript"></script>
   <script src="../recursos/plugins/lib/jquery.blockui.js" type="text/javascript"></script>
   <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/theme.css">
   <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/premium.css">
    
	<script type="text/javascript" src="marcador.js"></script>

    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>
    
	<style type="text/css">
    	.smallmap {
    		width: 100%;
    		height: 80%;
   		}
	</style>

</head>
<body class=" theme-blue" onLoad="iniciar()">
<div class="main-content" style="width:600px; height:500px; background: #eee;">

	<div id="contenedorMapa" class="smallmap">
	
	</div>
	<div style="width:100%; height:20%; border: 1px solid #ccc;">                          
   	<div style="text-align: center; width:100%; height:20%; margin-top: 5%;">
      	<button id="btnAceptar" name="btnAceptar" class="btn btn-primary" style="width: 100px;">Aceptar</button>
      </div>
   </div>

   </div>
   
<script type="text/javascript">
	$("#btnAceptar").click(function(){
 		window.opener.document.getElementById('coordenadas').value = coordenadasMarcador;
 
 		window.close();
	});
</script>
</body>
</html>