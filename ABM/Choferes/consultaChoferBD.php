<?php
	include("../../conexionBD.php");
	
	$conectar = establecerConexion();
	$id=$_POST["id"];
    $sql = "SELECT nombre,apellido,usuario,contrasenia,numero_telefono,venc_licencia,habilitado,sexo FROM Choferes where id=".$id;
    $select = mysql_query($sql,$conectar);
    $sqlmoviles = "SELECT Moviles.numero FROM Moviles INNER JOIN AsignacionesMovil ON Moviles.id = AsignacionesMovil.id_movil INNER JOIN Choferes ON AsignacionesMovil.id_chofer = Choferes.id WHERE Choferes.id='$id' order by Moviles.numero";
    $select2 = mysql_query($sqlmoviles, $conectar);
    if($select && $select2){
    	$resultado = mysql_fetch_row($select);
    	$nombre=$resultado[0];
    	$apellido=$resultado[1];
    	$usuario=$resultado[2];
    	$contrasenia=$resultado[3];
    	$numero_telefono=$resultado[4];
    	$venc_licencia=$resultado[5];
    	$habilitado=$resultado[6];
    	$sexo=$resultado[7];
    	
    	$moviles="";
		$flagPrimerEntrada = true;
    	while($arrayMoviles=mysql_fetch_array($select2)){
				if($flagPrimerEntrada){
						$moviles=$arrayMoviles[0];
						$flagPrimerEntrada = false;
						}else {
							$moviles=$moviles."-".$arrayMoviles[0];						
							}
		}
    	
    	echo $nombre."&&".$apellido."&&".$usuario."&&".$contrasenia."&&".$numero_telefono."&&".$venc_licencia."&&".$habilitado."&&".$sexo."&&".$moviles;
    	
    	mysql_close($conectar);
    }else {
    	mysql_close($conectar);
    }
    
 ?>