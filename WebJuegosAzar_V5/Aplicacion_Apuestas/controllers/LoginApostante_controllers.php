<?php
session_start();

if(isset($_SESSION['id']) || isset($_SESSION['usuario'])){
	unset($_SESSION['usuario']);
	unset($_SESSION['id']);
	session_destroy();
}
var_dump($_SESSION);

include_once '../db/db.php';
include_once '../models/LoginApostante_model.php';
include_once '../views/LoginApostante_views.php';

$conexion=conexion();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$usuario=$_POST["dni"];
	$password=$_POST["password"];
	$respuesta=login($conexion,$usuario,$password);
	var_dump($respuesta);
	if(isset($respuesta)){
		if($respuesta!=null){
			foreach($respuesta as $consulta){
				$_SESSION['id']=$consulta['dni'];
				$_SESSION['usuario']=$consulta['nombre']." ".$consulta['apellido'];	
				}
			header("Location:Inicio_Apuestas_controllers.php");
		}
	}
}

?>