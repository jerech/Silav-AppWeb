<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

    $idAgencia = $_SESSION['sesion_idAgencia'];

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['nombre'])||empty($_POST['direccion']) ||empty($_POST['departamento']) ||
          empty($_POST['pais']) ||empty($_POST['provincia']) || empty($_POST['ciudad'])){
  		echo "Error. Campos obligatorios vacios.";
  		exit();
  	}

  	require_once("../../conexionBD.php");

  	//Se obtienen los datos a guardar
  	$nombre = $_POST['nombre'];
  	$email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $cuit = $_POST['cuit'];
    $pais = $_POST['pais'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
  

  	//Se realiza el update en la BD
  	$query = "
  			UPDATE  
              Agencias
        SET
  				    nombre='$nombre',
  				    email='$email',
  				    telefono='$telefono',
  				    cuit='$cuit',
  				    provincia='$provincia',
  				    pais='$pais',
  				    departamento='$departamento',
              direccion='$direccion',
              ciudad = '$ciudad'
        WHERE 
              id=$idAgencia";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
    $_SESSION['sesion_ciudad'] = $ciudad;
    $_SESSION['sesion_provincia'] = $provincia;
    $_SESSION['sesion_departamento'] = $departamento; 
		echo "OK"; //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
	}

	mysql_close($conexion);

?>