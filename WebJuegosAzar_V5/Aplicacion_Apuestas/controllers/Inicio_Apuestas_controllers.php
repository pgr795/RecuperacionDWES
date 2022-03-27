<?php
session_start();

include_once '../db/db.php';
include_once '../models/Inicio_Apuestas_model.php';
/* $conexion=conexion();
$sorteo=sorteos2($conexion,$idUsuario)
		


foreach($sorteo as $indice => $consulta){
		$idSorteo=$consulta['NSORTEO'];
		unset($_SESSION[$idSorteo]);
}	 */			
	

if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		header("Location:../index.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
	$conexion=conexion();	
	$id=$_SESSION['id'];
	$saldo=saldo($conexion,$id);

var_dump($_SESSION);

include_once '../views/Inicio_Apuestas_views.php';

?>
