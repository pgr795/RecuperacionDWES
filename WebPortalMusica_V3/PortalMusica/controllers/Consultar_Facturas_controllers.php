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
	include_once '../models/Consultar_Facturas_model.php';
	include_once '../views/Consultar_Facturas_views.php';	
	
	$conexion=conexion();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$factura = $_POST["factura"];	
		$accion=$_POST["accion"];
		$idUsuario=$_SESSION['id'];
		$datos=datosFacturas($conexion,$idUsuario,$factura);
		if($accion=="Consultar Facturas"){
			if(!empty($factura)){
				mostrarDatos($datos);
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;'>No has seleccionado factura</h2>";
				echo "<br>";
			}
		}		
	}
?>
