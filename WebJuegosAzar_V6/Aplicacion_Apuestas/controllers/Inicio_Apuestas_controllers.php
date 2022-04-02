<?php
session_start();

include_once '../db/db.php';
include_once '../models/Inicio_Apuestas_model.php';
$conexion=conexion();	
$id=$_SESSION['id'];
$saldo=saldo($conexion,$id);
$sorteo=sorteos($conexion,$id);
var_dump($_SESSION);

foreach($sorteo as $indice => $consulta){	
	$sorteo=$consulta['NSORTEO'];
	if(isset($_SESSION[$sorteo])){	
		unset($_SESSION[$sorteo]);
	}
}


if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		header("Location:../index.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
	

include_once '../views/Inicio_Apuestas_views.php';	





?>
