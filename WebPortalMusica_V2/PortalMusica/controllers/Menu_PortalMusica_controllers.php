<?php
	session_start();
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
	// if(isset($_SESSION['precio'])){
		// unset($_SESSION['precio']);
	// }
	// if(isset($_SESSION['VuelosReservados'])){
		// unset($_SESSION['VuelosReservados']);
	// }	
	include_once '../db/db.php';
	include_once '../views/Menu_PortalMusica_views.php';

?>
