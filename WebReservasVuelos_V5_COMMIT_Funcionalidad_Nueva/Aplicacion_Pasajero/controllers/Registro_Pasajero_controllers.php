<?php
include_once '../db/db.php';
include_once '../models/Registro_Pasajero_model.php';
include_once '../views/Registro_Pasajero_views.php';	
$conexion=conexion();
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre=$_POST["nombre"];
	$nacimiento=$_POST["cumple"];
	$sexo=$_POST["sex"];	
	$calle=$_POST["calle"];
	$ciudad=$_POST["ciudad"];	
	$cp=$_POST["codigoPostal"];	
	$pais=$_POST["pais"];
	$email=$_POST["email"];
	$telefono=$_POST["telefono"];	
	//var_dump($_POST);
	$respuesta=comprobarPasajero($conexion,$email,$nacimiento);
	//var_dump($respuesta);
	if($respuesta==null){
				$idParaAsignar=idPasajero($conexion);
				insertPasajero($conexion,$idParaAsignar,$nombre,$nacimiento,$sexo,$calle,$ciudad,$cp,$pais,$email,$telefono);
	}
	else{
		echo "Pasajero ya existe"."<br>";
	}
}
?>
