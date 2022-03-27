<?php
if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		header("Location:../index.php");
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
		
			<div class="form-group">
					<h1 class="text-center">Resultado Pasarela</h1>
					<h2>Te has registrado en el sistema</h2><br>
			<form method='POST' action='../controllers/RegistroApostante_controllers.php'>
				<input type='submit' name='accion' value='Volver' class="btn btn-warning disabled"/>
			</form>
								
	</body>
</html>
