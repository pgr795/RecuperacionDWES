<?php
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
		header();
	}
?>
<html>
 <head>
		<title>PORTAL DE MUSICA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
 <body>
    <div class="container">
        <!--Aplicacion-->
		<h1>PORTAL DE MUSICA</h1> 
		<br>
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">MENÚ USUARIO - DESCARGAS</div>
		<div class="card-body">

		<B>Nombre Cliente: </B><?php echo $_SESSION['id']; ?> <BR><BR>
		<B>Id Cliente: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Compañia: </B><?php echo $_SESSION['company']; ?>  <BR><BR>
	
		<form method="post" action="Reservar_Vuelos_controllers.php">
		<B>Selecciona Cancion:</B>
		<BR>
		<?php
			// SelectVuelos($_SESSION['id']);
			// var_dump($datos);
		?>
			<br><br>
			<div> 
				<input type='submit' name='accion' value='AGREGAR A CESTA' class="btn btn-warning disabled"/>
				<input type='submit' name='accion' value='DESCARGAR' class="btn btn-warning disabled"/>
				<input type='submit' name='accion' value='VACIAR CESTA' class="btn btn-warning disabled"/>
				<input type="button" value="VOLVER" onclick="window.location.href='../controllers/Menu_PortalMusica_controllers.php'" class="btn btn-warning disabled">
			</div>
		</form>
	</div> 
	<div class='card-header' style='color:gray'><h3><b>Canciones en la cesta:</b></h3>
	<?php
		// function mostrarVueloSeleccionado($vuelos){
			// echo "<br>";
			// echo "<table border='1px'>";
			// echo "<thead>";
					// echo "<td class='card-header'><b>Numero de vuelo</b></td>";
					// echo "<td class='card-header'><b>Origen</b></td>";
					// echo "<td class='card-header'><b>Destino</b></td>";
			// echo"</thead>";
			// echo "<tbody>";
				// echo "<tr>";
					// echo "<td class='card-header'>".$vuelos[0]."</td>";
					// echo "<td class='card-header'>".$vuelos[1]."</td>";
					// echo "<td class='card-header'>".$vuelos[2]."</td>";
				// echo "</tr>";
			// echo "<tbody>";
			// echo "</table>";
			// echo "<br>";
		// }
	?>
	</div>
	
</body>
</html>
