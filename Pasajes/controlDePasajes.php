<?php
    session_start(); 

    if(in_array('ControlDePasajes', $_SESSION['sesion_permisos'])){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sistema SiLAV - Control De Pasajes</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sebastian" >

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../recursos/plugins/lib/font-awesome/css/font-awesome.css">

    <script src="../recursos/plugins/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/noty.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/md5.js" type="text/javascript"></script>

    <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    
    <script src="cargarChoferes.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>

    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/premium.css">

</head>
<body class=" theme-blue">

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
 
        #contenedor {
        	width: 60%;
        	position: absolute; 
        	top: 40%; 
        	left: 50%; 
        	transform: translate(-50%, -50%);
        }
        
        #contenedorFormulario	{

			 width: 100%;
			 height: 30%;		  	 
			margin: 0 auto;

        }
        .col-md-0 {
        	width: 30%;
        	display: inline-block;
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
    <div class="main-content">
	
     <!--<div id="contenedor" class="col-sm-6 col-md-6">-->
			        <div class="panel panel-default" style="margin: 0 auto; width: 80%;">
			            <a href="#widget2container2" class="panel-heading" data-toggle="collapse">Pasajes </a>
			            <div id="widget2container2" class="panel-body collapse in" style="border: 1px solid #000;">

			                <form id="formulario-pasajes" name="form" class="form" >
			                <div style="border: 1px solid #956;">
							<div class="col-md-4">
								<div class="form-group">
								<label>Calle</label><input type="text" id="calle" name="calle" class="form-control">
								</div>

								<div class="form-group">
            <label>Chofer</label>
            <select name="listaChoferes" id="listaChoferes" class="form-control">
              
            </select>
          </div>
          
          <div class="form-group">
								<label>Cliente</label><input type="text" id="cliente" name="cliente" class="form-control">
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>N&uacute;mero</label><input type="text" id="numero" name="numero" class="form-control">
								</div>
								<div class="form-group">
								<label>M&oacute;vil</label><input type="text" id="movil" name="movil" class="form-control">
								</div>
								
								
							</div>

									</div>				
						</form>
<div class="row">
	<div class="col-md-8" style="text-align: center;">
					<div class="btn-toolbar list-toolbar">

					<button id="btnAsignar" class="btn btn-primary"> Asignar</button>
					

					</div>
    			</div>
    	</div>
						
			            </div>
			            
			        </div>
			        
    			<!--</div>-->
    			
    			</div>		
<script type="text/javascript">
	jQuery(document).ready(function() {	
 				var choferesConectados;
 				
            CargarChoferes.init();	

        });
</script>

<script type="text/javascript">
	$("#listaChoferes").change(function() {
		
	var usuario = $(this).val();
	for (i=0 ; i<choferesConectados.choferes.length ; i++) {
		if (choferesConectados.choferes[i].usuario == usuario) {
			
			$("#movil").val(choferesConectados.choferes[i].numero_movil);
		}
	}
			

    });
</script>
</body>
</html>

<?php
}
?>