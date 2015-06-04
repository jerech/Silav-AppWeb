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
    <script src="../recursos/plugins/lib/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="../recursos/plugins/lib/noty.js" type="text/javascript"></script>

    

    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="../recursos/plugins/stylesheets/premium.css">

</head>
<body class=" theme-blue">

    <!-- Demo page code -->

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

    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>



    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-taxi"></span> SiLAV</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
    </div>
    


        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Iniciar Sesi&oacute;n</p>
        <div class="panel-body">
            <form id="formInicio" name="formInicio">
                <div class="form-group">
                    <label>Usuario</label>
                    <input id="usuario" name="usuario" type="text" class="form-control span12">
                </div>
                <div class="form-group">
                <label>Contraseña</label>
                    <input id="contrasenia" name="contrasenia" type="password" class="form-control span12">
                </div>
                <button id="btnIniciar" type="submit" class="btn btn-primary pull-right">Iniciar</button>
                <label class="remember-me"><input type="checkbox"> Recordar</label>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    
</div>



    <script src="../recursos/plugins/lib/bootstrap/js/bootstrap.js"></script>
    <script src="../recursos/plugins/lib/md5.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            //Validacion de formulario con bootstrapValidation
            var formulario = $("#formInicio");

            formulario.bootstrapValidator({
                message: 'El valor no es valido.',
                fields: {
                    usuario:{
                        validators:{
                            notEmpty:{
                                message: 'El campo es requerido.'
                            }
                        }
                    },
                    contrasenia:{
                        validators:{
                            notEmpty:{
                                message: 'El campo es requerido.'
                            }
                        }
                    }

                },
                submitHandler: function(validator, form, submitButton){
                    var usuario = $("#usuario").val();
                    var contrasenia = $("#contrasenia").val();
                    try{
                        var contraseniaEncriptada = hex_md5(contrasenia); 
                        contrasenia = contraseniaEncriptada; 

                        
                    }catch(e){
                        alert(e+".Error al encriptar contraseña.");
                    }
                  
                    $.ajax({
                        type: 'POST',
                        url: '../controladores/inicioSesion.php',
                        data:{
                            'usuario': usuario,
                            'contrasenia': contrasenia
                        },
                        dataType: 'html',
                        success: function(data){
    
                            if (data !== "OK") {

                                notificacion("error","Error al intentar ingresar al sistema. "+data+contrasenia);
                                $("#contrasenia").val("");
                            }else{
                                window.location.replace("../index.php");
                            }

                        },
                    });
                }
            });

        });
        
        // "op" puede estar valuada en "error", "info" o "success"
        function notificacion(op,msg,time){
            if(time == undefined)
                time = 5000;
            var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});

        }

    </script>

    
  
</body></html>