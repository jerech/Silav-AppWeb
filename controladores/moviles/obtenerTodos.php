<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

  	require_once("../../conexionBD.php");
  	
	$query = "select patente,
					numero,
					marca,
					modelo,
					vencseguro,
					aa,
					gnc
				from Moviles";  	
  	
	$coneccion = establecerConexion();
	if(!$coneccion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	while ($registro=mysql_fetch_array($resultado))
	{
  		$patente = $registro['patente'];
  		$numero = $registro['numero'];
  		$marca = $registro['marca'];
  		$modelo = $registro['modelo'];
  		$vencseguro = $registro['vencseguro'];
  		$aa = $registro['aa'];
  		$gnc = $registro['gnc'];
  				
  		$respuesta[] = $patente . "_" . $numero . "_" . $marca . "_" . $modelo . "_" . $vencseguro . "_" . $aa . "_" .  $gnc;

	}
	
	if (empty($respuesta))
	{
 		$respuesta[] = "error";
	}
	
	require_once('json.php');
	$json = new Services_JSON();
	print $json->encode($respuesta);

	mysql_close($coneccion);
?>