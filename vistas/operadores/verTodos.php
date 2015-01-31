<?php   
    if(!defined('acceso')){
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		
		<script type="text/javascript" src="operadores/mostrarTabla.js"></script>
    <script type="text/javascript" src="../recursos/plugins/lib/jquery.dataTables.js"></script>
	</head>
	<body>
    <script type="text/javascript">
      function guardarId(id) {  
       idOperador = id;    
              
          }  
      function eliminarRegistro() {
        var urlEliminarDatos = "operadores/eliminar.php";
        var parametro = "id="+idOperador;
        $.ajax({
                type: 'post',
                          url: urlEliminarDatos, 
                          data: parametro,           
                          dataType: 'html',
                          beforeSend: function(){
                              
                          },   
                          success: function(data) {
                                
                            notificacion("success", "Operador borrado correctamente");
                            window.location.replace("panelSitio.php?subSeccion=VerOperadores");
                          },
                          error: function(a,b,c){
                              console.log(a);
                              console.log(b);
                              console.log(c);     
                          }

              });
      }
 
    </script> 

	<div class="content">
		<div class="header">
		    <h1 class="page-title">Administre los Operadores desde aquí</h1>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a href="panelSitio.php?subSeccion=VerOperadores">Operadores</a>
		        </li>
		        <li>
		            <a>Ver Operadores</a>
		        </li>
		    </ul>
		</div>

		<div class="main-content">
            
<div class="btn-toolbar list-toolbar">
    <a class="btn btn-primary" href="panelSitio.php?subSeccion=NuevoOperador"><i class="fa fa-plus"></i> Nuevo</a>
    
  <div class="btn-group">
  </div>
</div>
<table id="tabla" class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Usuario</th>
      <th>Telefono</th>
      <th style="width: 3.5em;"></th>
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>



<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Confirmar eliminaci&oacute;n</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-warning modal-icon"></i>¿Esta seguro que quiere borrar el administrador?<br></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger" onclick="eliminarRegistro();" data-dismiss="modal">Borrar</button>
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