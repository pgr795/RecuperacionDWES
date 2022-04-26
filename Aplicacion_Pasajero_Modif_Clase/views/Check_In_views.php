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
		<title>PORTAL DE RESERVA VUELOS</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>   
 <body>
    <div class="container ">
		<h1>PORTAL DE RESERVA VUELOS</h1>
			<br>
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Pasajero - CHECK IN </div>
		<div class="card-body">

		<B>Bienvenido/a: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Identificador Pasajero: </B><?php echo $_SESSION['email']; ?>  <BR><BR>
	
		<form method="post" action="">
			<?php 
				vuelosReservados($_SESSION['id']);
			?>
		<br>
		<br>
		<input type='submit' name='accion' value='Check In' class="btn btn-warning disabled"/>
		<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers.php'" class="btn btn-warning disabled">
		</form>
	</div>  
   </body>
</html>


