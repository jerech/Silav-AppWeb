<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['direccionCalle'])||empty($_POST['direccionNumero']) 
          || empty($_POST['lon'])
          || empty($_POST['lat'])){
  
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}

  	require_once("../conexionBD.php");

  	//Se obtienen los datos a guardar
  	$calle = $_POST['direccionCalle'];
  	$numero = $_POST['direccionNumero'];
  	$chofer = $_POST['listaChoferes'];
  	$movil = $_POST['movil'];
  	$cliente = $_POST['cliente'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
  	
  	$direccion = $calle . " " . $numero;
  	$fecha = date("Y-m-d H:i:s");
  	//Se realiza el insert en la BD
  	$query = "
  			insert into PasajesEnCurso(
  				direccion,
  				fecha,
  				usuarioChofer,
  				nombreCliente,
  				numeroMovil,
          latDireccion,
          lonDireccion)
  			values(
  				'$direccion',
  				'$fecha',
  				'$chofer',
  				'$cliente',
  				'$movil',
          $lat,
          $lon)";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		echo "OK_".mysql_insert_id(); //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
	}

	mysql_close($conexion);
	
?>