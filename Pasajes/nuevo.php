<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

    $idAgencia = $_SESSION['sesion_idAgencia'];

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['direccionCalle']) 
          || empty($_POST['lon'])
          || empty($_POST['lat'])
          || empty($_POST['calle'])){
  
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}
  	elseif(empty($_POST['listaChoferes']) && $_POST['asignacionAutomatica']==0) {
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}

	if(validateMysqlDate($_POST['fechaDePedido']) == false) {
		echo "Error. Fecha Incorrecta.";
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
  	$asignacionAutomatica = $_POST['asignacionAutomatica'];
   $fechaDePedido = $_POST['fechaDePedido'];
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
          lonDireccion,
          id_agencia,
          asignacionAutomatica,
          fechaDePedido)
  			values(
  				'$direccion',
  				'$fecha',
  				'$chofer',
  				'$cliente',
  				$movil,
          $lat,
          $lon,
          $idAgencia,
          $asignacionAutomatica,
          '$fechaDePedido')";

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
	
	function validateMysqlDate( $date ){ 
   	if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) { 
        if (checkdate($matches[2], $matches[3], $matches[1])) { 
            return true; 
        } 
    	} 
    	return false; 
	} 
?>