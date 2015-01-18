<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['contrasenia'])||empty($_POST['nombre'])||empty($_POST['apellido'])){
  		echo "Error. Campos obligatorios vacios.";
  		exit();

  	}

  	require_once("../../conexionBD.php");

  	//Se obtienen los datos a guardar
  	$nombre = $_POST['nombre'];
  	$apellido = $_POST['apellido'];
  	$usuario = $_POST['usuario'];
  	$contrasenia = $_POST['contrasenia'];
  	$tipo = "admin";
  	$telefono = $_POST['telefono'];
  	$direccion = $_POST['direccion'];
  	$email = $_POST['email'];
  	if($_POST['activo']=="on"){
  		$activo=1;
  	}else{
  		$activo=0;
  	}

  	//Se realiza el insert en la BD

  	$query = "
  			insert into Usuarios(
  				nombre,
  				apellido,
  				usuario,
  				contrasenia,
  				telefono,
  				direccion,
  				tipo,
  				email,
  				activo)
  			values(
  				'$nombre',
  				'$apellido',
  				'$usuario',
  				'$contrasenia',
  				'$telefono',
  				'$direccion',
  				'$tipo',
  				'$email',
  				'$activo')";

	$coneccion = establecerConexion();
	if(!$coneccion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		echo "OK_".mysql_insert_id(); //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
	}

	mysql_close($coneccion);
?>