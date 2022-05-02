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
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>CONSULTAR RESERVA</title>
</head>
<body>
		<div class="container ">
		<h1>PORTAL DE RESERVA VUELOS</h1> 
		<br>
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Pasajero - CONSULTAR RESERVA </div>
		<div class="card-body">
		
		<B>Bienvenido/a: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Identificador Pasajero: </B><?php echo $_SESSION['email']; ?>  <BR><BR>
		
       <!--Formulario con botones -->
	<form method="post" action="Consultar_Reservas_controllers.php">
			<?php
				vuelos($_SESSION['id']);
			?>
			<br>
			<br>
				<input type='submit' name='accion' value='Consultar Reserva' class="btn btn-warning disabled"/>
				<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_Pasajero_controllers.php'" class="btn btn-warning disabled">
	</form>
		</div>
		</div>
		</div>
			<?php
				function mostrarDatos($conexion,$datos){
					echo "<table border='1px' class='container'> ";
						echo "<thead class='card-header'>";
							echo "<tr class='card-body'>";
								echo "<td style='text-align:center'><b>NOMBRE</b></td>";
								echo "<td style='text-align:center'><b>EMAIL</b></td>";
								echo "<td style='text-align:center'><b>PAIS</b></td>";
								echo "<td style='text-align:center'><b>NUMERO DE CONTACTO</b></td>";
								echo "<td style='text-align:center'><b>VUELO</b></td>";
								echo "<td style='text-align:center'><b>ASIENTO</b></td>";
								echo "<td style='text-align:center'><b>ORIGEN</b></td>";
								echo "<td style='text-align:center'><b>SALIDA</b></td>";
								echo "<td style='text-align:center'><b>DESTINO</b></td>";
								echo "<td style='text-align:center'><b>LLEGADA</b></td>";
								echo "<td style='text-align:center'><b>PRECIO DE VUELO<b></td>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							foreach($datos as $indice => $consulta){
								echo "<tr>";
								foreach($consulta as $indice2 => $datos){
									echo "<td style='padding:10px; text-align:center;'>".$datos."</td>";
								}
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
				}
			?>
</body>
</html>