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
include_once '../models/Consultar_Reservas_model.php';
include_once '../views/Consultar_Reservas_views.php';

$conexion=conexion();
	
if($_SERVER["REQUEST_METHOD"] == "POST") {	
		$idBooking=$_POST["idBooking"];
		$idUsuario=$_SESSION['id'];
		if(!empty($idBooking)){
			$datos=consultarDatos($conexion,$idBooking,$idUsuario);
			mostrarDatos($conexion,$datos);
		}
}	
?>