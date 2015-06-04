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
    $id = $_POST['id'];
  	$nombre = $_POST['nombre'];
  	$apellido = $_POST['apellido'];
  	$usuario = $_POST['usuario'];
  	$contrasenia = $_POST['contrasenia-encriptada'];
  	$tipo = "operador";
  	$telefono = $_POST['telefono'];
  	$direccion = $_POST['direccion'];
  	$email = $_POST['email'];
  	$permisos = $_POST['chkPermiso'];
  	if($_POST['habilitado']=="on"){
  		$habilitado=1;
  	}else{
  		$habilitado=0;
  	}

  	//Se realiza el insert en la BD
  	$query = "
  			UPDATE  
              Usuarios
        SET
  				    nombre='$nombre',
  				    apellido='$apellido',
  				    usuario='$usuario',
  				    telefono='$telefono',
  				    direccion='$direccion',
  				    email='$email',
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
		guardarPermisos($id, $permisos);
		echo "OK_"; //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
	}

  if(!empty($_POST['contrasenia-encriptada']) && $_POST['contrasenia-encriptada'] != "" && $_POST['contrasenia-encriptada'] != "d41d8cd98f00b204e9800998ecf8427e"){
    $contrasenia = $_POST['contrasenia-encriptada'];
    modificarContrasenia($id, $contrasenia);
  }

	mysql_close($conexion);


	function guardarPermisos($idUsuario, $permisos){
		if(!empty($permisos)){
      $queryBorrarPermisos = "DELETE FROM 
                                Permisos
                              WHERE
                                Usuarios_id = $idUsuario";
      mysql_query($queryBorrarPermisos);
                    foreach ($permisos as $permiso) {
                        $idSeccion = $permiso;
                        /*
                         * ESTABLECER CONSULTA
                         */
                        $query = "
                                INSERT INTO Permisos(
                                        Usuarios_id,
                                        Secciones_id
                                )VALUES(
                                        $idUsuario,
                                        $idSeccion)";

                        $respuesta = mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
                        
                     		
                    }	
                }

	}

  function modificarContrasenia($id, $contrasenia){
    
    $query = "UPDATE
                Usuarios
              SET
                contrasenia='$contrasenia'
              WHERE
                id=$id";
    mysql_query($query)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
  } 
?>