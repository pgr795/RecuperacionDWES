<?php
	session_start();
	
	if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	
	if(isset($_SESSION['precio'])){
		unset($_SESSION['precio']);
	}
	
// var_dump($_SESSION);
include_once '../db/db.php';
include_once '../models/Menu_Pasajero_model.php';
include_once '../views/Menu_Pasajero_views.php';

?>
