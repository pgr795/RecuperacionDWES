<?php
session_start();
if(!isset($_SESSION["dni"])){
		header("Location:../controllers/Inicio_Apuestas_controllers.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
	}
include_once '../db/db.php';
include_once '../models/RegistroApostante_model.php';
$conexion=conexion();
$dni=$_SESSION["dni"];
$nombre=$_SESSION["nombre"];
$apellido=$_SESSION["apellido"];
$email=$_SESSION["email"];
$saldo=$_SESSION["saldo"];
registroApostante($conexion,$dni,$nombre,$apellido,$email,$saldo);
unset($_SESSION["dni"]);
unset($_SESSION["nombre"]);
unset($_SESSION["apellido"]);
unset($_SESSION["email"]);
unset($_SESSION["saldo"]);
var_dump($_SESSION);
?>
<html>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Resultado Pasarela</title>
    </head>
      
    <body>
			<div class="form-group">
					<h1 class="text-center">Registro Apostante</h1>
					<h2>Te has registrado en el sistema</h2><br>
			<form method='POST' action='../controllers/RegistroApostante_controllers.php'>
			<input type='submit' name='accion' value='Volver' class="btn btn-warning disabled"/>
			</form>
			</div>				
	</body>
</html>
