<?php 

	session_start();

	if(empty($_SESSION['sesion_usuario']))	
            header("Location: ../index.php");

    define("acceso", "autorizado");

    $seccionesURL = array(
		'Inicio' => '../vistas/inicio.php',
		'Configuracion' => '../vistas/configuracion/nueva.php',
		'Ayuda' => '../vistas/ayuda/ayuda.php', //Esta seccion no necesita permisos
      	'Administradores' => '#',
      	'Operadores'=> '#',
		'Choferes' => '#',
		'Moviles' => '#',
		'Estadisticas' => '#');
		
	$subSeccionesSeccion = array(
		'GeolocalizacionMoviles' => 'Inicio',
		'PasajesHistoricos' => 'Estadisticas',
		'ControlDePasajes' => 'Inicio',

		'NuevoAdministrador' => 'Administradores',
		'VerAdministradores' => 'Administradores',
		'ModificarAdministrador' => 'Administradores',
        'ModificarPassword' => 'Administradores',

        'NuevoOperador' => 'Operadores',
        'VerOperadores' => 'Operadores',
        'ModificarOperador' => 'Operadores',
        'ModificarPassword' => 'Operadores',

        'NuevoChofer' => 'Choferes',
        'VerChoferes' => 'Choferes',
        'ModificarChofer' => 'Choferes',

        'NuevoMovil' => 'Moviles',
        'VerMoviles' => 'Moviles',
        'ModificarMoviles' => 'Moviles'
        );
		
	$subSeccionesURL = array(		
		'GeolocalizacionMoviles' => '#',
		'PasajesHistoricos' => '../vistas/estadisticas/verPasajesHistoricos.php',
		'ControlDePasajes' => '#',
		
		'NuevoAdministrador' => '../vistas/administradores/nuevo.php',
		'VerAdministradores' => '../vistas/administradores/verTodos.php',
		'ModificarAdministrador' => '../vistas/administradores/nuevo.php',
        'ModificarPassword' => '#',

        'NuevoOperador' => '../vistas/operadores/nuevo.php',
        'VerOperadores' => '../vistas/operadores/verTodos.php',
        'ModificarOperador' => '../vistas/operadores/nuevo.php',
        'ModificarPassword' => '#',

        'NuevoChofer' => '../vistas/choferes/nuevo.php',
        'VerChoferes' => '../vistas/choferes/verTodos.php',
        'ModificarChofer' => '../vistas/choferes/nuevo.php',

        'NuevoMovil' => '../vistas/moviles/nuevo.php',
        'VerMoviles' => '../vistas/moviles/verTodos.php',
        'ModificarMovil' => '../vistas/moviles/nuevo.php');
	
	if(!empty ($_GET['seccion'])){
		
		$seccion = $_GET['seccion'];
		$subSeccion = "";
		
		include_once("../vistas/paginaPrincipal.php");

		if(array_key_exists($seccion, $seccionesURL)){
			
			if(in_array($seccion, $_SESSION['sesion_permisos']) || $seccion == 'Ayuda'){
				include_once $seccionesURL[$seccion];
			
			}else{				
				include_once("../vistas/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vistas/seccionNoEncontrada.php");
			die();
		}
			
	}elseif(!empty ($_GET['subSeccion'])){
			
		$subSeccion = $_GET['subSeccion'];
		
		if(array_key_exists($subSeccion, $subSeccionesSeccion)){
			$seccion = $subSeccionesSeccion[$subSeccion];
		}else{
			$seccion = NULL;
		}
		
		include_once("../vistas/paginaPrincipal.php");
		

		if(array_key_exists($subSeccion, $subSeccionesURL)){
			
			if(in_array($subSeccion, $_SESSION['sesion_permisos'])
				|| $subSeccion == "PasajesHistoricos"){
				include_once $subSeccionesURL[$subSeccion];
			
			}else{				
				include_once("../vistas/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vistas/seccionNoEncontrada.php");
			die();
		}
		
	}else{
		$seccion = 'Inicio';
		$subSeccion = "";
		
		include_once("../vistas/paginaPrincipal.php");	
		
		if(array_key_exists($seccion, $seccionesURL)){
			
			if(in_array($seccion, $_SESSION['sesion_permisos'])){
				include_once $seccionesURL[$seccion];
			
			}else{				
				include_once("../vistas/accesoNoAutorizado.php");
				die();
			}
			
		}else{			
			include_once("../vistas/seccionNoEncontrada.php");
			die();
		}
	}
?>

