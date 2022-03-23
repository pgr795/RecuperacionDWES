<?php	

include_once '../db/db.php';
include_once '../models/RegistroApostante_model.php';
include_once '../views/RegistroApostante_views.php';
	
$conexion=conexion();	
	
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$dni=$_POST["dni"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$email=$_POST["email"];
	$accion=$_POST["accion"];
	
	if($accion=="Registro Empleado"){
	/* 	$existe=comprobarDNI($conexion,$dni);
		insertEmpleado($conexion,$dni,$nombre,$apellido,$email); */
	}
	else if($accion=="Atras"){
		header("Location:../index.php");
	}
	var_dump($_POST);
}
?>