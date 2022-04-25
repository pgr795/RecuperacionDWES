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
	include_once '../models/Check_In_model.php';
	include_once '../views/Check_In_views.php';
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$idVuelo=$_POST["idVuelo"];
		$fecha=date('Y-m-d H:i:s');
		$idUsuario=$_SESSION['id'];
	
		if(!empty($idVuelo)){
			$asiento=asientos();
			$idBooking=idBooking($conexion,$idVuelo,$idUsuario);
			if($idBooking!=null){
				$idBooking=$idBooking[0];
				var_dump($idBooking);
				asignarAsientos($conexion,$idBooking,$idUsuario,$asiento);
				echo "Check In Realizado";
			}
		}
		else{
			echo "No hay vuelos para realizar la operacion";
		}
	}
// var_dump($_POST);
function asientos(){
	$asiento=rand(1,80);
	return $asiento;
}	
?>



