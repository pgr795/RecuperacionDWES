<?php
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
	unset($_SESSION['id']);
	unset($_SESSION['usuario']);
	session_destroy();
	header("Location:../index.php");
}

include_once '../db/db.php';
include_once '../models/ConsultarApuestas_model.php';
include_once '../views/ConsultarApuestas_views.php';

$conexion=conexion();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		var_dump($_POST);
		$id=$_SESSION['id'];
		$accion=$_POST["accion"];
		$sorteo=$_POST["idSorteo"];
		if($accion=="Consultar Apuestas"){
			$datos=recopilarDatos($conexion,$sorteo,$id);
			//var_dump($datos);
			mostrarInformacion($conexion,$datos);
		}
		else if($accion=="Atras"){
			header("Location:Inicio_Apuestas_controllers.php");
		}
	}
var_dump($_SESSION);
?>