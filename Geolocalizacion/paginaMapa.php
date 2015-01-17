<?php
    session_start(); 

    if(in_array('Geolocalizacion', $_SESSION['sesion_permisos'])){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sistema SiLAV - Geolocalización</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sebastian" >

	<link rel="stylesheet" href="css/estiloMapa.css"/>
	<script src="http://openlayers.org/api/OpenLayers.js"></script>
	<script type="text/javascript" src="prototype.js"></script>
	<script type="text/javascript" src="common.js"></script>
	<script type="text/javascript" src="funcionesMapa.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../recursos/plugins/lib/font-awesome/css/font-awesome.css">

    <script src="../recursos/plugins/lib/jquery-1.11.1.min.js" type="text/javascript"></script>

    <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>

    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/premium.css">

</head>
<body class=" theme-blue" onload="iniciar()">

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
        html, body {
        	height: 100%;
        }
        #contenedorMapa {
        		width:100%;
        		height:90%;        
        }
    </style>

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-taxi"></span> SiLAV</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#">
                    <b>Salir</b>      
                </a>

            
            </li>
          </ul>

        </div>
      
    </div>
     
     <div id="contenedorMapa">
     
     </div>
     
</body>
</html>

<?php
}
?>