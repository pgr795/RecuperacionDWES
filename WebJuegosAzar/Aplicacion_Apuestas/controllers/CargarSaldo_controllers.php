<?php
session_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
		header("Location:../index.php");
}

include_once '../db/db.php';
include_once '../models/CargarSaldo_model.php';
include_once '../views/CargarSaldo_views.php';

var_dump($_SESSION);

$conexion=conexion();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		var_dump($_POST);
		$dni=$_SESSION['id'];
		$fecha=$_POST["fecha"];
		$accion=$_POST["accion"];
		if($accion=="Alta de Sorteo"){
			if(isset($fecha)){
				/* insertSorteo($conexion,$fecha,$dni); */
			}
		}
		else if($accion=="Atras"){
			header("Location:Inicio_Apuestas_controllers.php");
		}
	}
?>