<?php
// session_start();

// if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
		// header("Location:../index.php");
		// unset($_SESSION['id']);
		// unset($_SESSION['usuario']);
		// session_destroy();
		// setcookie ("PHPSESSID", "", time() - 3600);
// }
// var_dump($_SESSION);
include_once '../db/db.php';
include_once '../models/Menu_Pasajero_model.php';
include_once '../views/Menu_Pasajero_views.php';
?>
