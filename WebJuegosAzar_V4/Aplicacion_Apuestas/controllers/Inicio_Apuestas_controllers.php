<?php
session_start();
unset($_SESSION['numeros']);//Funcion

include_once '../db/db.php';
include_once '../models/Inicio_Apuestas_model.php';
/* $conexion=conexion();
$sorteo=sorteos2($conexion,$idUsuario)
		


foreach($sorteo as $indice => $consulta){
		$idSorteo=$consulta['NSORTEO'];
		unset($_SESSION[$idSorteo]);
}	 */			
	
	
if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		header("Location:../index.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
		
var_dump($_SESSION);

include_once '../views/Inicio_Apuestas_views.php';

?>
