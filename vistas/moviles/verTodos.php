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
	
<script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }

            $('[data-popover="true"]').popover({html: true});
            
        });
    </script>	
    
<script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>    
    
	<div class="content">
        <div class="header">
		    <h1 class="page-title">Lista de M&oacute;viles</h1>
		    <ul class="breadcrumb">
		        <li>
		            <a href="panelSitio.php?seccion=Inicio">Inicio</a>
		        </li>
		        <li>
		            <a>Ver Lista</a>
		        </li>
		    </ul>
		</div>
        <div class="main-content">
            

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>N&uacute;mero</th>
      <th>Patente</th>
      <th>Modelo</th>
      <th>Marca</th>
      <th style="width: 3.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Mark</td>
      <td>Tompson</td>
      <td>the_mark7</td>
      <td>the_mark7</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td>Ashley</td>
      <td>Jacobs</td>
      <td>ash11927</td>
      <td>ash11927</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <tr>
      <td>3</td>
      <td>Audrey</td>
      <td>Ann</td>
      <td>audann84</td>
      <td>audann84</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <tr>
      <td>4</td>
      <td>John</td>
      <td>Robinson</td>
      <td>jr5527</td>
      <td>jr5527</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <tr>
      <td>5</td>
      <td>Aaron</td>
      <td>Butler</td>
      <td>aaron_butler</td>
      <td>aaron_butler</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <tr>
      <td>6</td>
      <td>Chris</td>
      <td>Albert</td>
      <td>cab79</td>
      <td>cab79</td>
      <td>
          <a href="user.html"><i class="fa fa-pencil"></i></a>
          <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
  </tbody>
</table>

<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Confirmation</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete the user?<br>This cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
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
                     
            //NuevoMovil.init();
        });
	</script>
	</body>
</html>