<?php
	session_start();

	$usuario;
	$nombre;
	$idUsuario;
	$permisos;

	$error = "ERROR";

	if((!empty($_POST['usuario'])) && (!empty($_POST['contrasenia']))){
		include '../conexionBD.php';

		$usuarioLogin = $_POST['usuario'];
		$contraseniaLogin = $_POST['contrasenia'];

		$query = "SELECT
						u.id,
						u.usuario,
						u.nombre,
						u.tipo
					FROM
						Usuarios as u
					WHERE
						u.usuario = '$usuarioLogin' AND
						u.contrasenia = '$contraseniaLogin'";

		$coneccion = establecerConexion();

		if ($coneccion) {

			$resultado = mysql_query($query);
			if (mysql_num_rows($resultado) == 1) {

				$array = mysql_fetch_row($resultado, MYSQL_ASSOC);
				$usuario = $array['usuario'];
				$nombre = $array['nombre'];
				$idUsuario = $array['id'];
				$tipo = $array['tipo'];

				//Se buscan los permisos del usuario
				$query2 = "SELECT
								s.nombre
							FROM
								Secciones as s,
								Permisos as p
							WHERE
								p.Usuarios_id = $idUsuario and
								p.Secciones_id = s.id";

				$resultado2 = mysql_query($query2);

				if(mysql_num_rows($resultado2) > 0){
					while ($array = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
						$permisos[] = $array['nombre'];
					}
				
					$_SESSION['sesion_reg'] = true;
                	$_SESSION['sesion_usuario'] = $usuario;
                	$_SESSION['sesion_nombre'] = $nombre;
                	$_SESSION['sesion_idUsuario'] = $idUsuario;
                	$_SESSION['sesion_tipoUsuario'] = $tipo;
               		$_SESSION['sesion_permisos'] = $permisos;
				}

				
			}

			mysql_close($coneccion);		

		}


	}

	if ($_SESSION['sesion_usuario']!="") {
		exit("OK");
	}else{
		exit($error);
	}


?>