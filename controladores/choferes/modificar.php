<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['nombre'])||empty($_POST['apellido']) ||empty($_POST['usuario'])){
  		
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}
  	
  	if($_POST['contrasenia-encriptada'] != $_POST['re-contrasenia-encriptada']){
      echo "Error. Las contraseñas no coinciden.";
      exit();
    }

  	require_once("../../conexionBD.php");

  	//Se obtienen los datos a guardar
  	$nombre = $_POST['nombre'];
  	$apellido = $_POST['apellido'];
  	$usuario = $_POST['usuario'];
  	$numero_telefono = $_POST['numero_telefono'];
  	$venc_licencia = $_POST['venc_licencia'];
  	$id = $_POST['id'];
  	$asignacion = $_POST['asignacion'];
  	
  	if($_POST['sexo']=="on"){
  		$sexo="Hombre";
  	}else{
  		$sexo="Mujer";
  	}
  	if($_POST['habilitado']=="on"){
  		$habilitado=1;
  	}else{
  		$habilitado=0;
  	}

	$id_agencia = 0; //CAMBIAR POR VALOR REAL!!

  	//Se realiza el update en la BD
  	$query = "
  			UPDATE  
              Choferes
        SET
  				    nombre='$nombre',
  				    apellido='$apellido',
  				    usuario='$usuario',
  				    numero_telefono='$numero_telefono',
  				    venc_licencia='$venc_licencia',
  				    sexo='$sexo',
  				    habilitado='$habilitado'
        WHERE 
              id=$id";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		//Asignar moviles
		if($asignacion == "agregarAsignaciones"){
			$moviles = $_POST['movilesParaAgregar'];
			asignarMoviles($id, $moviles);
		}else {
			if($asignacion == "borrarAsignaciones") {
				borrarMoviles($id);
			}
			else {
				if($asignacion == "modificarAsignaciones") {
					//agregar y borrar
					$movilesAgregar = $_POST['movilesParaAgregar'];
					$movilesEliminar = $_POST['movilesParaEliminar'];
					modificarMoviles($id, $movilesAgregar, $movilesEliminar);
				}	
			}
		}
		
		echo "OK_"; //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
	}

  if(!empty($_POST['contrasenia-encriptada']) && $_POST['contrasenia-encriptada'] != "" && $_POST['contrasenia-encriptada'] != "d41d8cd98f00b204e9800998ecf8427e"){
    $contrasenia = $_POST['contrasenia-encriptada'];
    modificarContrasenia($id, $contrasenia);
  }

	mysql_close($conexion);

	function asignarMoviles($idChofer, $moviles) {
		if(!empty($moviles)){
                    foreach ($moviles as $movil) {
                        $idMovil = $movil;
                        /*
                         * ESTABLECER CONSULTA
                         */
                        $query = "
                                INSERT INTO AsignacionesMovil(
                                        id_chofer,
                                        id_movil)
                                VALUES(
                                        $idChofer,
                                        $idMovil)";

                        $respuesta = mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());;
	
                    }	
                }
	}
	
	function borrarMoviles($idChofer) {
                    
   	$query = "
  				DELETE FROM AsignacionesMovil 

         	WHERE 
              id_chofer=$idChofer";

      $respuesta = mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());;
             
	}
	
	function modificarMoviles($idChofer, $movilesAgregar, $movilesEliminar) {
		if($movilesAgregar[0] == 0) {
			//no hay elementos para insertar
		}
		else {
			foreach ($movilesAgregar as $movil) {
                        $idMovil = $movil;
                        /*
                         * ESTABLECER CONSULTA
                         */
                        $query = "
                                INSERT INTO AsignacionesMovil(
                                        id_chofer,
                                        id_movil)
                                VALUES(
                                        $idChofer,
                                        $idMovil)";

                        $respuesta = mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());;
	
                    }
		}
		if($movilesEliminar[0] == 0) {
			//no hay elementos para eliminar
		}
		else {
			foreach ($movilesEliminar as $movil) {
                        $idMovil = $movil;
                        /*
                         * ESTABLECER CONSULTA
                         */
                        $query = "
  									DELETE FROM AsignacionesMovil 

         						WHERE 
              						id_movil=$idMovil AND id_chofer=$idChofer" ;

                        $respuesta = mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());;
	
                    }
		}
	}

  function modificarContrasenia($id, $contrasenia){
    $query = "UPDATE
                Choferes
              SET
                contrasenia='$contrasenia'
              WHERE
                id=$id";
    mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
  } 
	
?>