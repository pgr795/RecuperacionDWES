<?php
session_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
	unset($_SESSION['id']);
	unset($_SESSION['usuario']);
	session_destroy();
	header("Location:../index.php");
}

include_once '../db/db.php';
include_once '../models/ConsultarSorteo_model.php';
include_once '../views/ConsultarSorteo_views.php';

$conexion=conexion();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		var_dump($_POST);
		$accion=$_POST["accion"];
		$sorteo=$_POST["idSorteo"];
		if($accion=="Consultar Sorteos"){
			$datos=recopilarDatos($conexion,$sorteo);
			//var_dump($datos);
			mostrarInformacion($conexion,$datos);
		}
		else if($accion=="Atras"){
			header("Location:Inicio_Hacienda_controllers.php");
		}
	}
var_dump($_SESSION);
?>