<?php

if(!isset($_SESSION['email']) && !isset($_SESSION['nombre']) && !isset($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nombre']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header("Location:../index.php");
	}
?>
<html>
   <head>
	   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Resultado Pasarela</title>
    </head>
      
     <body>
		<h1 class="text-center">PORTAL MUSICA</h1>
			<div class="form-group">		
			<h2>Error a pagar las canciones</h2><br>
			<form method='POST' action='../controllers/Menu_PortalMusica_controllers.php'>
				<input type='submit' name='accion' value='Volver' class="btn btn-warning disabled"/>
			</form>
			</div>
				
	</body>
</html>
