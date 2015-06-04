<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['numero'])||empty($_POST['patente'])){
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}

  	require_once("../../conexionBD.php");

  	//Se obtienen los datos a guardar
  	$numero = $_POST['numero'];
  	$patente = $_POST['patente'];
  	$marca = $_POST['marca'];
  	$modelo = $_POST['modelo'];
  	$vencseguro = $_POST['vencseguro'];
  	
  	if($_POST['aa']=="on"){
  		$aa=1;
  	}else{
  		$aa=0;
  	}
  	if($_POST['gnc']=="on"){
  		$gnc=1;
  	}else{
  		$gnc=0;
  	}
  	
  	//Se realiza el insert en la BD
  	$query = "
  			insert into Moviles(
  				patente,
  				numero,
  				marca,
  				modelo,
  				vencseguro,
  				aa,
  				gnc)
  			values(
  				'$patente',
  				'$numero',
  				'$marca',
  				'$modelo',
  				'$vencseguro',
  				'$aa',
  				'$gnc')";

	$coneccion = establecerConexion();
	if(!$coneccion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		echo "OK";
	}

	mysql_close($coneccion);
?>