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
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../recursos/plugins/lib/font-awesome/css/font-awesome.css">

    <script src="../recursos/plugins/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/noty.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/md5.js" type="text/javascript"></script>

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
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-taxi"></span> SiLAV</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span><?php echo $_SESSION['sesion_usuario'] ?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="./">Panel Admin</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Admin</li>
                <li><a href="./">Usuarios</a></li>
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
                    <li <?php if($subSeccion=='NuevoAdministrador'){echo "class='active'";}?>><a href="panelSitio.php?subSeccion=NuevoAdministrador" ><span class="fa fa-caret-right"></span>Nuevo</a></li>
                    <li><a href="#" ><span class="fa fa-caret-right"></span>Ver Lista</a></li>
                </ul></li>

            <?php }?>
            <?php if(in_array('Operadores', $_SESSION['sesion_permisos'])){ ?> 
                <li data-popover="false" rel="popover" data-placement="left"><a href="#" data-target=".operadores-menu" class="nav collapsed" data-toggle="collapse"><i class="fa"></i><span class="fa fa-caret-down"></span> Operadores<i class="fa fa-collapse"></i></a></li>
                <li><ul <?php 
                        if($seccion=='Opreadores'){ 
                            echo "class='operadores-menu nav nav-list collapse in'";
                        }else{
                            echo "class='operadores-menu nav nav-list collapse'";
                        } ?>
                >
                    <li><a href="#" ><span class="fa fa-caret-right"></span>Nuevo</a></li>
                    <li><a href="#" ><span class="fa fa-caret-right"></span>Ver Lista</a></li>
                </ul></li>
            <?php }?>
            </ul></li>
            <!-- Fin seccion usuarios -->

            <?php if(in_array('Choferes', $_SESSION['sesion_permisos'])){ ?>
                <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".choferes-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-male"></i> Choferes<i class="fa fa-collapse"></i></a></li>
                <li><ul class="choferes-menu nav nav-list collapse">
                <li ><a href="premium-profile.html"><span class="fa fa-caret-right"></span> Nuevo</a></li>
                <li ><a href="premium-blog.html"><span class="fa fa-caret-right"></span> Ver Lista</a></li>
                </ul></li>

                <!-- Fin seccion Cohefes-->
            <?php } ?>
            <?php if(in_array('Moviles', $_SESSION['sesion_permisos'])){ ?>
            <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".moviles-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-automobile"></i> M&oacute;viles <i class="fa fa-collapse"></i></a></li>
            <li><ul class="moviles-menu nav nav-list collapse">
            <li ><a href="sign-in.html"><span class="fa fa-caret-right"></span> Nuevo</a></li>
            <li ><a href="sign-up.html"><span class="fa fa-caret-right"></span> Ver Lista</a></li>
            </ul></li>
            <!-- Fin seccion Moviles-->
            <?php } ?>
            <li><a href="help.html" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Ayuda</a></li>
        </ul>
    </div>



    <script src="../recursos/plugins/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });

        // "op" puede estar valuada en "error", "info" o "success"
        function notificacion(op,msg,time){
            if(time == undefined)
                time = 5000;
            var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});

        }
    </script>
    
  
</body></html>
    
    

    