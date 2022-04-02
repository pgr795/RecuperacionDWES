<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		header("Location:../controllers/Inicio_Apuestas_controllers.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
}
include_once '../db/db.php';
include_once '../models/CargarSaldo_model.php';
$conexion=conexion();
$dni=$_SESSION['id'];
$saldo=$_SESSION['saldo'];
actualizarSaldo($conexion,$dni,$saldo);
if(isset($_SESSION['saldo'])){
	unset($_SESSION['saldo']);
}
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
		<h1 class="text-center">Cargar Saldo</h1>
			<div class="form-group">
			<h2>Saldo Actualizado</h2><br>
			<form method='POST' action='../controllers/CargarSaldo_controllers.php'>
				<input type='submit' name='accion' value='Volver' class="btn btn-warning disabled"/>
			</form>	
			</div>
	</body>
</html>
