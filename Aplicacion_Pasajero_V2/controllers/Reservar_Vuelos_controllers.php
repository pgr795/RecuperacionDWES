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

var_dump($_POST);
	include_once '../db/db.php';
	include_once '../models/Reservar_Vuelos_model.php';
	include_once '../views/Reservar_Vuelos_views.php';
?>
