<?php
	if(!isset($_SESSION['id']) && !isset($_SESSION['usuario'])){
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
	<link rel="stylesheet" href="../views/css/bootstrap.min.css">
	<title>Realizar Sorteo</title>
</head>
<body>
	<div class="card-header"><h2>Realizar Sorteo</h2></div>
		<div class="card-body">

		<B>Bienvenido/a:</B><?php echo $_SESSION['usuario']; ?> <BR><BR>
		<B>Identificador Empleado:</B><?php echo $_SESSION['id']; ?>  <BR>
		
	
	<form method="post" action="RealizarSorteo_controllers.php">
			<p>
			Sorteos Activos:
			<?php
				mostrarSelect($_SESSION['id']);
			?>
			</p>
			<div>
			<input type='submit' name='accion' value='Generar combinacion ganadora'/>
			<?php
				function mostrarCombinacionGanadora($combinacionSorteo){
				echo "<h2 style='color:gray;'>"."Loteria Primitiva de España"." /Sorteo  </h2>";
				foreach ($combinacionSorteo as $indice => $valor) {
					if($indice!=8 && $indice!=7 && $indice!=6)
						echo "<img src=../views/bolas/".$valor.".png width=70px height=70px>"." ";
					if($indice==6){
						echo "<br>";
						echo "<br>";
						echo "Complementario: "."<img src=../views/bolas/".$valor.".png width=70px height=70px> "." ";
						echo "<br>";
					}	
					if($indice==7){
						echo "<br>";
						echo "Reintegro: "."<img src=../views/bolas/rbola".$valor.".PNG width=70px height=70px> "." ";
						echo "<br>";
						echo "<br>";
					}
				}
			}
			?>
			</div>
			<br><br>
			<div>
				<input type='submit' name='accion' value='Realizar Sorteo'/>
				<input type='submit' name='accion' value='Atras'/>
			</div>
	</form>
</body>
</html>	
