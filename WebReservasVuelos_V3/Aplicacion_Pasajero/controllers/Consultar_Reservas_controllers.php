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
		
		$idVuelo=$_POST["idVuelo"];
		$fecha=date('Y-m-d H:i:s');
		$idUsuario=$_SESSION['id'];
	
		if(!empty($idVuelo)){
			$datos=consultarDatos($conexion,$idVuelo,$idUsuario);
			mostrarDatos($conexion,$datos);
			// var_dump($datos);
		}
	}
	// var_dump($_POST);
?>