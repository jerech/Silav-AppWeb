<?php   
    if(!defined('acceso')){
        exit();
    }
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Sistema SiLAV</title>
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
    <script src="../recursos/plugins/lib/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/jquery.blockui.js" type="text/javascript"></script>
    <script type="text/javascript" src="../recursos/plugins/lib/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="../recursos/plugins/lib/jquery.dataTables.css">

    <script src="../recursos/plugins/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
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
    </style>
    

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="panelSitio.php?seccion=Inicio"><span class="navbar-brand"><span class="fa fa-taxi"></span> SiLAV<?php echo ' - '.$_SESSION['sesion_nombreEmpresa'] ?></span></a></div>

        <div id="div-main-menu" class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span><?php echo $_SESSION['sesion_usuario'] ?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="panelSitio.php?seccion=Configuracion">Configuración</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="../controladores/cierreSesion.php">Salir</a></li>
              </ul>
            </li>
          </ul>

        </div>
      
    </div>
    

    <div class="sidebar-nav">
        <ul>
            <?php if(in_array('Inicio', $_SESSION['sesion_permisos'])){?>
                <li><a href="panelSitio.php?seccion=Inicio" class="nav-header"><i class="fa fa-fw fa-home"></i> Inicio</a></li>
            <?php } ?>

            <!--Fin seccion inicio-->

            <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".usuarios-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Usuarios<i class="fa fa-collapse"></i></a></li>
            <li><ul <?php 
                        if($seccion=='Administradores' || $seccion=='Operadores'){ 
                            echo "class='usuarios-menu nav nav-list collapse in'";
                        }else{
                            echo "class='usuarios-menu nav nav-list collapse'";
                        } ?>
                >
            <?php if(in_array('Administradores', $_SESSION['sesion_permisos'])){ ?>
                <li data-popover="false" rel="popover" data-placement="left"><a href="#" data-target=".administradores-menu" class="nav collapsed" data-toggle="collapse"><i class="fa"></i><span class="fa fa-caret-down"></span> Administradores<i class="fa fa-collapse"></i></a></li>
                <li><ul <?php 
                        if($seccion=='Administradores'){ 
                            echo "class='administradores-menu nav nav-list collapse in'";
                        }else{
                            echo "class='administradores-menu nav nav-list collapse'";
                        } ?>
                >
                    <li <?php if($subSeccion=='NuevoAdministrador' || $subSeccion=='ModificarAdministrador'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=NuevoAdministrador" ><span class="fa fa-caret-right"></span>Nuevo</a></li>
                    <li <?php if($subSeccion=='VerAdministradores'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=VerAdministradores" ><span class="fa fa-caret-right"></span>Ver Lista</a></li>
                </ul></li>

            <?php }?>
            <?php if(in_array('Operadores', $_SESSION['sesion_permisos'])){ ?> 
                <li data-popover="false" rel="popover" data-placement="left"><a href="#" data-target=".operadores-menu" class="nav collapsed" data-toggle="collapse"><i class="fa"></i><span class="fa fa-caret-down"></span> Operadores<i class="fa fa-collapse"></i></a></li>
                <li><ul <?php 
                        if($seccion=='Operadores'){ 
                            echo "class='operadores-menu nav nav-list collapse in'";
                        }else{
                            echo "class='operadores-menu nav nav-list collapse'";
                        } ?>
                >
                    <li <?php if($subSeccion=='NuevoOperadores' || $subSeccion=='ModificarOperador'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=NuevoOperador" ><span class="fa fa-caret-right"></span>Nuevo</a></li>
                    <li <?php if($subSeccion=='VerOperadores'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=VerOperadores" ><span class="fa fa-caret-right"></span>Ver Lista</a></li>
                </ul></li>
            <?php }?>
            </ul></li>
            <!-- Fin seccion usuarios -->

            <?php if(in_array('Choferes', $_SESSION['sesion_permisos'])){ ?>
                <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".choferes-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-male"></i> Choferes<i class="fa fa-collapse"></i></a></li>
                <li><ul <?php 
                        if($seccion=='Choferes'){ 
                            echo "class='choferes-menu nav nav-list collapse in'";
                        }else{
                            echo "class='choferes-menu nav nav-list collapse'";
                        } ?>
                >
                <li <?php if($subSeccion=='NuevoChofer'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=NuevoChofer"><span class="fa fa-caret-right"></span> Nuevo</a></li>
                <li <?php if($subSeccion=='VerChoferes'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=VerChoferes"><span class="fa fa-caret-right"></span> Ver Lista</a></li>
                </ul></li>

                <!-- Fin seccion Cohefes-->
            <?php } ?>
            <?php if(in_array('Moviles', $_SESSION['sesion_permisos'])){ ?>
            <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".moviles-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-automobile"></i> M&oacute;viles <i class="fa fa-collapse"></i></a></li>
            <li><ul <?php 
                        if($seccion=='Moviles'){ 
                            echo "class='moviles-menu nav nav-list collapse in'";
                        }else{
                            echo "class='moviles-menu nav nav-list collapse'";
                        } ?>
            >
            <li <?php if($subSeccion=='NuevoMovil'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=NuevoMovil" ><span class="fa fa-caret-right"></span>Nuevo</a></li>
            <li <?php if($subSeccion=='VerMoviles'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=VerMoviles"><span class="fa fa-caret-right"></span> Ver Lista</a></li>
            </ul></li>
            <!-- Fin seccion Moviles-->
            <?php } ?>
            <li><a href="panelSitio.php?seccion=Ayuda" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Ayuda</a></li>
        </ul>
    </div>



    <script type="text/javascript">

    $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });

        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });

        //Funciones de la notificacion
        // "op" puede estar valuada en "error", "info" o "success"
        function notificacion(op,msg,time){
            if(time == undefined)
                time = 8000;
            var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});

        }


        //Funciones del blockUI
        function blockUI(el, centerY) {
            var el = jQuery(el); 
            el.block({
                    message: '<img src="../recursos/imagenes/cargando4.gif" align=""/><br><h3><font color="#454545"><b>Cargado...</font></h3>',
                    centerY: centerY != undefined ? centerY : true,
                    css: {
                        top: '30%',
                        border: 'none',
                        padding: '5px',
                        backgroundColor: '#FFF',
                        opacity: 0.80
                    },
                    overlayCSS: {
                        backgroundColor: '#000',
                        opacity: 0.25,
                        cursor: 'wait'
                    }
                });
        }
        function unblockUI(el) {          
            jQuery(el).unblock({
                    onUnblock: function () {
                        jQuery(el).removeAttr("style");
                    }
                });
        }

        function initDataTable(tb) {
            jQuery(tb).dataTable({
                    "bProcessing": true,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "aLengthMenu": [
                        [5, 10, 20, -1],
                        [5, 10, 20, "Todos"] // change per page values here
                    ],
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    "bInfoEmpty": true,
                    "bInfo": true,
                    "sInfoFiltered": true,
                    "oLanguage": {
                            "sLengthMenu": "Mostrar _MENU_ registros por página",
                            "sSearch": "Buscar: ",
                            "sZeroRecords": "Sin registros",
                            "sInfo": "Mostrando _START_ - _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 - 0 de 0 registros",
                            "sInfoFiltered": "(Filtrado de _MAX_ registros)",
                            "oPaginate": {
                                "sPrevious": "Pre",
                                "sNext": "Sig",
                                "sFirst": "<<",
                                "sLast": ">>"

                            }
                        }
            }); 
        }

    </script>
    
  
</body></html>
    
    

    