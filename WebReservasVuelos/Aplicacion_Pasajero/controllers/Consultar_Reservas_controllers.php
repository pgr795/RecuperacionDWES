<?php
	// if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		// header("Location:../index.php");
		// unset($_SESSION['id']);
		// unset($_SESSION['usuario']);
		// session_destroy();
	// }
	
include_once '../db/db.php';
include_once '../models/Consultar_Reservas_model.php';
include_once '../views/Consultar_Reservas_views.php';
?>