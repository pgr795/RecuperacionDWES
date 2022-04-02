<?php
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
		header("Location:../index.php");
}

include_once '../views/CargarSaldo_views.php';

//4548810000000003
//12/49 	
//123
var_dump($_SESSION);

?>