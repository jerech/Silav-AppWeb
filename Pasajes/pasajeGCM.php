<?php
$api = 'AIzaSyBRy8ZJ8bpiqg9Dny05p24WsKCDGLQLYSs'; //our api key from Google GCM

// Cabecera
$headers = array('Content-Type:application/json',
                 "Authorization:key=$api");
                 
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$chofer = $_POST['listaChoferes'];
$movil = $_POST['movil'];
$cliente = $_POST['cliente'];

// Datos
$payload = array('mensaje' => utf8_encode($calle." ".$numero),
                 'id' => '20135');


require_once('../conexionBD.php');



$query = "select clave_gcm from Choferes where usuario='$chofer'";

$conexion = establecerConexion();
if(!$conexion){
	echo "Error al conectar con la Base de Datos";
	exit();
}

$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

$array = mysql_fetch_array($resultado, MYSQL_ASSOC);

mysql_close($conexion);
$registrationIdsArray = array($array['clave_gcm']);

$data = array(
   'data' => $payload,
   'registration_ids' => $registrationIdsArray
);

// Petición
$ch = curl_init();
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send" );
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));

// Conectamos y recuperamos la respuesta
$response = curl_exec($ch);

// Cerramos conexión
curl_close($ch);

print_r(json_decode($response));

?>
