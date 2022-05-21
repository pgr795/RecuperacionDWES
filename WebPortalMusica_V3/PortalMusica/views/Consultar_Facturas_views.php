<?php
	if(!isset($_SESSION['id']) && !isset($_SESSION['nombre']) && !isset($_SESSION['company'])){
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['company']);
		session_destroy();
		setcookie ("PHPSESSID", "", time() - 3600);
	}
?>
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<title>PORTAL DE MUSICA</title>
	</head>
	<body>
		<div class="container ">
		<h1>PORTAL DE MUSICA</h1> 
		<br>
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">MENÚ USUARIO - CONSULTAR FACTURAS </div>
		<div class="card-body">
		
		<B>Nombre Cliente: </B><?php echo $_SESSION['nombre']; ?> <BR><BR>
		<B>Id Cliente: </B><?php echo $_SESSION['id'];?> <BR><BR>
		<B>Compañia: </B><?php echo $_SESSION['company']; ?>  <BR><BR>
		
		
       <!--Formulario con botones -->
		<form method="post" action="Consultar_Facturas_controllers.php">
			<div>
			<?php selectIdFacturas($_SESSION['id']) ?>
			</div>
			<br>
			<input type='submit' name='accion' value='Consultar Facturas' class="btn btn-warning disabled"/>
			<input type="button" value="Atras" onclick="window.location.href='../controllers/Menu_PortalMusica_controllers.php'" class="btn btn-warning disabled">
		</form>
		</div>
		</div>
		</div>
			<?php
				function mostrarDatos($datos){
					echo "<table border='1px' class='container'> ";
						echo "<thead class='card-header'>";
							echo "<tr class='card-body'>";
							echo "<td style='text-align:center'><b>LINEA</b></td>";
							echo "<td style='text-align:center'><b>CANCION</b></td>";
							echo "<td style='text-align:center'><b>COMPOSITOR</b></td>";	
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							foreach($datos as $indice => $consulta){
								echo "<tr>";
								foreach($consulta as $indice2 => $datos2){
									echo "<td style='padding:10px; text-align:center;'>".$datos2."</td>";
								}
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
				}
			?>
	</body>
	</html>