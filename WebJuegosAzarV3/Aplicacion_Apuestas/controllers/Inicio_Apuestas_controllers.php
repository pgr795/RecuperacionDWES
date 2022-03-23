<?php
session_start();
unset($_SESSION['numeros']);//Funcion

if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		header("Location:../index.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
var_dump($_SESSION);

include_once '../views/Inicio_Apuestas_views.php';

?>
