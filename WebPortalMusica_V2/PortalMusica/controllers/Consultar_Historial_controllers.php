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
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
		$fechadesde = $_POST["fechadesde"];
		$fechahasta = $_POST["fechahasta"];
		$accion=$_POST["accion"];
		$idUsuario=$_SESSION['id'];
		$datos=datosHistorial($conexion,$idUsuario,$fechadesde,$fechahasta);
		if($accion=="Consultar Historial"){
			if(!empty($fechadesde) && !empty($fechahasta)){
				mostrarDatos($datos);
			}
			else{
				echo "<br>";
				echo "<h2 style='color:gray;padding-left: 6rem;'>No has seleccionado ninguna fecha </h2>";
				echo "<br>";
			}
		}
		else if($accion=="Volver"){
			header("location: Welcome_controllers.php");
		}		
}
?>