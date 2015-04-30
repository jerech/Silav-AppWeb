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
    <script src="../recursos/plugins/lib/bootstrap/js/bootstrap.js"></script>

    <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    
    <script src="cargarChoferes.js" type="text/javascript"></script>
    <script src="enviarPasaje.js" type="text/javascript"></script>
    <script src="cargarPasajesEnCurso.js" type="text/javascript"></script>
    
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
        .centrar {
				text-align:center;
				width: 16.5%;        
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

			        <div class="panel panel-default" style="margin: 0 auto; width: 60%;">
			            <a href="#widget2container2" class="panel-heading" data-toggle="collapse">Pasajes </a>
			            <div id="widget2container2" class="panel-body collapse in" style=" width: 100%;margin:0 auto;">

			             <form id="formulario-pasajes" name="form" class="form">
							
								<div style="width: 50%;float:left;margin:0 0 0 18%;" class="form-group">
								<label>Calle</label><input type="text" id="calle" name="calle" class="form-control">
								</div>
								
								<div style="width: 10%;float:left;margin:0 0 0 3%;" class="form-group">
								<label>N&uacute;mero</label><input type="text" id="numero" name="numero" class="form-control">
								</div>
						
					
								<div style="width: 50%;clear:left;float:left;margin:2% 0 0 18%;" class="form-group">
            				<label>Chofer</label>
            				<select name="listaChoferes" id="listaChoferes" class="form-control">
              
            				</select>
          					</div>
          
          					<div style="width: 10%;float:left;margin:2% 0 0 3%;" class="form-group">
								<label>M&oacute;vil</label><input type="text" id="movil" name="movil" class="form-control">
								</div>
			
          					<div style="width: 50%;float:left;margin:2% 0 0 18%;" class="form-group">
								<label>Cliente</label><input type="text" id="cliente" name="cliente" class="form-control">
								</div>

										
						</form>

					<div style="clear:left;text-align:center;">

					<button style="margin:2% 0 0 0;" id="btnAsignar" class="btn btn-primary"> Asignar</button>
					</div>
						
			            </div>
			            
			        </div>
			        
    <div  style="margin: 2% auto; width: 90%;">

    <div class="panel panel-default">
    
        <div class="panel-heading" style="text-align:center;">Pasajes En Curso</div>
        <table class="table table-bordered table-first-column-check table-hover" id="tablaPasajes">
            <thead>
                <tr>
                    <th class="centrar">Fecha</th>
                    <th class="centrar">Direcci&oacute;n</th>
                    <th class="centrar">Cliente</th>
                    <th class="centrar">Chofer</th>
                    <th class="centrar">M&oacute;vil</th>
                    <th class="centrar">Estado</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>

</div>    
    			
    			</div>	
    			
    			
<script type="text/javascript">
	jQuery(document).ready(function() {	
 				var choferesConectados;			
 				
            CargarChoferes.init();
				EnviarPasaje.init();
				CargarPasajesEnCurso.init();
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