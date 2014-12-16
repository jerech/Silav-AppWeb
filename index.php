<?php
	session_start();

	if(empty($_SESSION['sesion_usuario'])){

		header('Location: vistas/login.php');
	}
?>