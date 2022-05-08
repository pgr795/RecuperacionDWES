<?php	
session_start();
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	include_once '../db/db.php';
	include_once '../models/Modificar_Asiento_model.php';
	include_once '../views/Modificar_Asiento_views.php';
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$idVuelo=$_POST["idVuelo"];
		$fecha=date('Y-m-d H:i:s');
		$idUsuario=$_SESSION['id'];
		$valido=true;
		$idAirplane=idAirplane($conexion,$idVuelo);
		$idAirplane=$idAirplane[0];
		$capacidad=capacityVuelo($conexion,$idAirplane);
		$capacidad=intval($capacidad[0]);
		$contador=0;
		// var_dump($capacidad);
		if(!empty($idVuelo)){
			
		}
	}

?>



