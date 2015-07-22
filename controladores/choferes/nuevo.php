<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

    $idAgencia = $_SESSION['sesion_idAgencia'];

	//Se verifica que los campos obligatorios no esten vacios
  	if(empty($_POST['contrasenia-encriptada'])||empty($_POST['nombre'])||empty($_POST['apellido']) ||empty($_POST['usuario'])){
  		
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
  	$contrasenia = $_POST['contrasenia-encriptada'];
  	$numero_telefono = $_POST['numero_telefono'];
  	$venc_licencia = $_POST['venc_licencia'];
  	$moviles = $_POST['idMovilesSeleccionados'];

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
  	
  	//Se realiza el insert en la BD
  	$query = "
  			insert into Choferes(
  				nombre,
  				apellido,
  				usuario,
  				contrasenia,
  				numero_telefono,
  				venc_licencia,
  				habilitado,
  				sexo,
  				id_agencia,
          activo)
  			values(
  				'$nombre',
  				'$apellido',
  				'$usuario',
  				'$contrasenia',
  				'$numero_telefono',
  				'$venc_licencia',
  				'$habilitado',
  				'$sexo',
  				'$idAgencia',
          1)";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		asignarMoviles(mysql_insert_id(), $moviles);
		echo "OK_".mysql_insert_id(); //Con la funcion mysql_insert_id() se obtiene el id del elemento insertado
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
?>