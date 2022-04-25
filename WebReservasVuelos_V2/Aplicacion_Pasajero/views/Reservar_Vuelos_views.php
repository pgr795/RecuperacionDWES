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
    <div class="container">
        <!--Aplicacion-->
		<h1>PORTAL DE RESERVA VUELOS</h1> 
		<br>
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Pasajero - Vuelos </div>
		<div class="card-body">

		<B>Bienvenido/a: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Identificador Pasajero: </B><?php echo $_SESSION['email']; ?>  <BR><BR>
	
		<form method="post" action="">
		<B>Selecciona Vuelo:</B>
		<BR>
		<?php
			SelectVuelos();
		?>
			<br><br>
			<div>
				<label>El pago de la reserva se hará mediante una pasarela de pago.</label> 
				<input type='submit' name='accion' value='Agregar Vuelo' class="btn btn-warning disabled"/>
				<input type='submit' name='accion' value='Finalizar Reserva' class="btn btn-warning disabled"/>
				<input type='submit' name='accion' value='Borrar Vuelos' class="btn btn-warning disabled"/>
				<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers.php'" class="btn btn-warning disabled">
			</div>
		</form>
	</div>  
   </body>
</html>
