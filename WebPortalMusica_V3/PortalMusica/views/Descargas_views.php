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

		<B>Nombre Cliente: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Id Cliente: </B><?php echo $_SESSION['id'];?> <BR><BR>
		<B>Compañia: </B><?php echo $_SESSION['company']; ?>  <BR><BR>
	
		<form method="post" action="Descargas_controllers.php">
			<B>Selecciona Cancion:</B>
			<BR>
			<?php
				selectCancion($_SESSION['id']);
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
		function mostrarCanciones($canciones){
			echo "<br>";
			echo "<table border='1px'>";
			echo "<thead>";
					echo "<td class='card-header'><b>Cancion</b></td>";
					echo "<td class='card-header'><b>Precio</b></td>";
			echo"</thead>";
			echo "<tbody>";
					foreach ($canciones as $indice => $valor) {
						echo "<tr>";
						echo "<td class='card-header'>".$valor."</td>";
						echo "<td class='card-header'><b>0.99€</b></td>";
					}
				echo "</tr>";
			echo "<tbody>";
			echo "</table>";
			echo "<br>";
		}
	?>
	</div>
	
</body>
</html>
