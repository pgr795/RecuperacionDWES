<?php
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['nombre']) && isset($_SESSION['id'])){
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['nombre']);
	session_destroy();
	setcookie ("PHPSESSID", "", time() - 3600);
}
//var_dump($_SESSION);

include_once '../db/db.php';
include_once '../models/Login_Pasajero_model.php';
include_once '../views/Login_Pasajero_views.php';

$conexion=conexion();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$usuario=$_POST["usuario"];
	$password=$_POST["password"];
	$respuesta=login($conexion,$usuario,$password);
	var_dump($respuesta);
	if(isset($respuesta)){
		if($respuesta!=null){
			foreach($respuesta as $consulta){
				$_SESSION['id']=$consulta['passenger_id'];	
				$_SESSION['email']=$consulta['emailaddress'];
				$_SESSION['nombre']=$consulta['name'];	
			}
			header("Location:Menu_Pasajero_controllers.php");
		}
	}
}

?>