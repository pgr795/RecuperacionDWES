<?php
//luisg@embraer.com.br
//Gonzalves
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['company'])){
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['company']);
	session_destroy();
	setcookie ("PHPSESSID", "", time() - 3600);
}

include_once '../db/db.php';
include_once '../models/Login_PortalMusica_model.php';
include_once '../views/Login_PortalMusica_views.php';

$conexion=conexion();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST);
	$usuario=$_POST["usuario"];
	$password=$_POST["password"];
	$respuesta=login($conexion,$usuario,$password);
	var_dump($respuesta);
	if(isset($respuesta)){
		if($respuesta!=null){
			foreach($respuesta as $consulta){
				$_SESSION['id']=$consulta["CustomerId"];	
				$_SESSION['nombre']=$consulta["FirstName"];
				$_SESSION['company']=$consulta["Company"];	
			}
			header("Location:../controllers/Menu_PortalMusica_controllers.php");
		}
	}
	else{
		header("Location:../index.php");
	}
}

var_dump($_SESSION);
?>