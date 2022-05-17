<?php
session_start();
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
	}

include_once '../db/db.php';
include_once '../models/Consultar_Historial_model.php';
include_once '../views/Consultar_Historial_views.php';

$conexion=conexion();
	
// if($_SERVER["REQUEST_METHOD"] == "POST") {	
		// $idBooking=$_POST["idBooking"];
		// $idUsuario=$_SESSION['id'];
		// if(!empty($idBooking)){
			// $datos=consultarDatos($conexion,$idBooking,$idUsuario);
			// mostrarDatos($conexion,$datos);
		// }
// }	
?>