<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		header("Location:../controllers/Inicio_Apuestas_controllers.php");
		unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		session_destroy();
	}
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
		<h1 class="text-center">Registro Apostante</h1>
			<div class="form-group">
					
			<h2>Error de registro</h2><br>
			<form method='POST' action='../controllers/RegistroApostante_controllers.php'>
				<input type='submit' name='accion' value='Volver' class="btn btn-warning disabled"/>
			</form>
			</div>						
	</body>
</html>
