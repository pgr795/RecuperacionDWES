<?php
	// if(!isset($_SESSION['id']) || !isset($_SESSION['usuario'])){
		// header("Location:../index.php");
		// unset($_SESSION['id']);
		// unset($_SESSION['usuario']);
		// session_destroy();
	// }
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
		<div class="card-header">MENÚ PASAJERO</div>
		<div class="card-body">
		
		<B>Bienvenido/a: </B><?php //echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Pasajero: </B><?php //echo $_SESSION['id']; ?>  <BR><BR>
		
       <!--Formulario con botones -->
	
		<input type="button" value="Reserva Vuelos" onclick="window.location.href='Reservar_Vuelos_controllers.php'" class="btn btn-warning disabled">
		<input type="button" value="Check-in Vuelos" onclick="window.location.href='Check_In_controllers.php'" class="btn btn-warning disabled">
		<input type="button" value="Consultar Reserva" onclick="window.location.href='Consultar_Reservas_controllers.php'" class="btn btn-warning disabled">
		</br></br>
	
		<a href="CerrarSesion_controllers.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>
